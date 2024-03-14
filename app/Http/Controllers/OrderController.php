<?php

namespace App\Http\Controllers;

use App\Mail\Email;
use App\Models\Order;
use App\Models\Review;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\Customer;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class OrderController extends Controller
{

    public function viewOrderList()
    {
        if(Auth::guard('webvendor')->check()){
            $user = Vendor::where('id',Auth::guard('webvendor')->user()->id)->first();
            $order = Order::where('vendor_id',$user->id)->orderBy('created_at','DESC')->get();
        } else if(Auth::guard('webcustomer')->check()){
            $user = Customer::where('id',Auth::guard('webcustomer')->user()->id)->first();
            $order = Order::where('customer_id',$user->id)->orderBy('created_at', 'DESC')->get();
        }
        //  dd(Auth::guard('webcustomer')->user()->email);
        
        return view('orderList',[
            'order' => $order,
            'user' => $user
        ]);
    }

    #Kalo vendor accept/reject order
    public function editStatus(Request $request, Order $o)
    {
        if($request->status == '1'){
            $status = 'AWAITING PAYMENT';
        } else if ($request->status == '2'){
            $status = 'REJECTED';
        }

        DB::table('orders')->where([
            ['id',$o->id]
            ])->update([ 
            'status' => $status
        ]);
        $order = DB::table('orders')->where('id', $o->id)->first();
        $this->sendEmail($o,$orderDetails,$order->vendor_id,"order status updated");
        return redirect()->back()->with('message','Order status edited successfully!');
    }


    #Sisi vendor accept harga nego


    public function acceptNegoPriceVendor(Request $request, Order $o)
    {
        DB::table('orders')->where([
            ['id',$o->id]
            ])->update([
            'nego_status' => 'ACCEPTED'
        ]);
        $this->sendEmail($o,$orderDetails,$order->vendor_id,"order status updated");
        return redirect()->back()->with('message','Order status edited successfully!');
    }

    #Ga di pake
    public function acceptNegoPrice(Request $req, Order $o){
        DB::table('orders')->where([
            ['id',$o->id]
            ])->update([
            'nego_status' => 'ACCEPTED',
            'status' => 'ON GOING'
        ]);
        return redirect()->back()->with('message','Order status edited successfully!');
    }

    public function rejectNegoPriceVendor(Request $req, Order $o){
        DB::table('orders')->where([
            ['id',$o->id]
            ])->update([
            'nego_status' => 'REJECTED',
            'nego_price' => $req->price
        ]);
        $this->sendEmail($o,$orderDetails,$order->vendor_id,"order status updated");
        return redirect()->back()->with('message','Order status edited successfully!');
    }
    #Customer terima harga nego
    public function acceptVendorPrice(Order $o){
        DB::table('orders')->where([
            ['id',$o->id]
            ])->update([
            'nego_status' => 'ACCEPTED'
        ]);
        $this->sendEmailVendor($o,$o->vendor_id,"order status updated");
        return redirect()->back()->with('message','Order status edited successfully!');
    }

    public function rejectVendorPrice(Order $o){
        DB::table('orders')->where([
            ['id',$o->id]
            ])->update([
            'status' => 'REJECTED'
        ]);
        $this->sendEmailVendor($o,$o->vendor_id,"order status updated");
        return redirect()->back()->with('message','Order status edited successfully!');
    }

    public function finishPayment(Order $o){
        $o->status = "ON GOING";
        $o->save();
        $orderDetails = OrderDetail::where('order_id', $o->id)->get();
        $this->sendEmail($o,$orderDetails,$order->vendor_id,"checkout");
        $this->sendEmailVendor($o,$order->vendor_id,"order status updated");
        return redirect('orderlist');
    }

    public function viewConfirmPayment(Order $o){
        return view('confirmPayment',[
            'order' => $o
        ]);
    }

    public function ConfirmPayment(Request $request, Order $o){

        $request->validate([
            'paymentProof' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if($request->hasFile('paymentProof')){
            $fileImage = $request->file('paymentProof');
            $imageName ='order-'.$o->id.'.'.$fileImage->getClientOriginalExtension();
            Storage::putFileAs('public/images/paymentproof/', $fileImage, $imageName);
            $imageName = 'images/paymentproof/'.$imageName;
        }
        else{
            $imageName = $o->payment_proof;
        }

        $o->payment_proof = $imageName;
        $o->save();

        return redirect('orderlist')->with('message','Payment proof successfully uploaded and will be checked by our admin');
    }

    public function checkout(Request $req){
        $rules = [
            'email' => 'required|email:rfc,dns',
            'cardNumber' => 'required|numeric',
            'expiryDate' => 'required',
            'cvv' => 'required | numeric',
            'address' =>'required'
        ];

        $validator = Validator::make($req->all(), $rules);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $order = new Order();
        $order_detail = new OrderDetail();
        $carts = session()->get('cart');

        $total_quantity = 0; $total_price = 0;
        foreach ($carts as $cart) {
            $total_quantity+=$cart['quantity'];
            if($cart['discounted_price'] != null){
                $total_price+=$cart['discounted_price'] * $cart['quantity'];
            }
            else{
                $total_price+=$cart['price'] * $cart['quantity'];
            }
            $vendor_id = $cart['vendor_id'];
            $product = Product::where('id',$cart['product_id'])->first();
            $product->stock = $product->stock - $cart['quantity'];
            $product->save();
        }
        $customerMembership = Auth::guard('webcustomer')->user()->customer_membership;
            if($customerMembership != null){
                $customerMembership = json_decode($customerMembership, true);
            }

        $order->status = 'OPEN';
        $order->total_price = $total_price;
        $order->total_quantity = $total_quantity;
        $order->customer_id = Auth::guard('webcustomer')->user()->id;
        if($customerMembership != null && $customerMembership['status'] == 'ACTIVE'){
            $order->membership_discount = (double)$customerMembership['discount'] /100;
        }
        $order->vendor_id = $vendor_id;
        $order->address = $req->address;
        $order->due_date = $req->dueDate;
        $order->save();

        $most_recent_order = DB::table('orders')->latest()->first();
        foreach ($carts as $cart) {
            $order_detail = new OrderDetail();
            $order_detail->quantity = $cart['quantity'];
            $order_detail->price = $cart['price'];
            $order_detail->product_name = $cart['name'];
            $order_detail->order_id = $most_recent_order->id;
            $order_detail->product_id = $cart['product_id'];
            if($cart['discounted_price'] != null){
                $order_detail->discount_price = $cart['discounted_price'];
            }
            $order_detail->save();
        }
        $orderDetails = OrderDetail::where('order_id', $most_recent_order->id)->get();


        $this->sendEmail($most_recent_order,$orderDetails,$order->vendor_id);

        session()->put('cart', []);
        return view('succesfulPage');
     }

     public function sendOrderToVendor(Request $req){
        $rules = [
            'address' =>'required',
            'dueDate' => 'required'
        ];

        $validator = Validator::make($req->all(), $rules);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $order = new Order();
        $order_detail = new OrderDetail();
        $carts = session()->get('cart');

        $total_quantity = 0; $total_price = 0;
        foreach ($carts as $cart) {
            $total_quantity+=$cart['quantity'];
            if($cart['discounted_price'] != null){
                $total_price+=$cart['discounted_price'] * $cart['quantity'];
            }
            else{
                $total_price+=$cart['price'] * $cart['quantity'];
            }
            $vendor_id = $cart['vendor_id'];
            $product = Product::where('id',$cart['product_id'])->first();
            $product->save();
        }
        $customerMembership = Auth::guard('webcustomer')->user()->customer_membership;
            if($customerMembership != null){
                $customerMembership = json_decode($customerMembership, true);
            }

        $order->status = 'OPEN';
        $order->total_price = $total_price;
        $order->total_quantity = $total_quantity;
        $order->customer_id = Auth::guard('webcustomer')->user()->id;
        if($customerMembership != null && $customerMembership['status'] == 'ACTIVE'){
            $order->membership_discount = (double)$customerMembership['discount'] /100;
        }
        $order->vendor_id = $vendor_id;
        $order->address = $req->address;
        $order->due_date = $req->dueDate;
        if($req->negoPrice){
            $order->nego_price = $req->negoPrice;
        }
        $order->save();

        $most_recent_order = DB::table('orders')->latest()->first();
        foreach ($carts as $cart) {
            $order_detail = new OrderDetail();
            $order_detail->quantity = $cart['quantity'];
            $order_detail->price = $cart['price'];
            $order_detail->product_name = $cart['name'];
            $order_detail->order_id = $most_recent_order->id;
            $order_detail->product_id = $cart['product_id'];
            if($cart['discounted_price'] != null){
                $order_detail->discount_price = $cart['discounted_price'];
            }
            $order_detail->save();
        }
        $orderDetails = OrderDetail::where('order_id', $most_recent_order->id)->get();
        // $this->sendEmail($most_recent_order,$orderDetails,$order->vendor_id,"checkout");
         $this->sendEmailVendor($most_recent_order,$order->vendor_id,"incoming order");
        session()->put('cart', []);
        return view('succesfulPage');

     }
     
     public function sendEmail($order,$orderDetails,$vendor_id,$type){
        $vendor = Vendor::find($vendor_id);
        $customer = Customer::find($order->customer_id);
        if(strcmp($type,"checkout")==0){
            Mail::to($customer->email)->send(new Email($order,$orderDetails,$vendor,$type));
        }
        else if(strcmp($type,"order status updated")==0){
            Mail::to($customer->email)->send(new Email($order,$orderDetails,$vendor,$type));
        }
        Mail::to($customer->user()->email)->send(new Email($order,$orderDetails,$vendor,$type));
     }

     public function sendEmailVendor($order,$vendor_id,$type){
        $vendor = Vendor::find($vendor_id);
        Mail::to($vendor->email)->send(new Email($order,null,$vendor,$type));
     }

     public function finishWithoutReview(Order $o){
        DB::table('orders')->where([
            ['id',$o->id]
            ])->update([
            'status' => 'FINISHED'
        ]);
        $this->addReporting($o);
        return redirect('orderlist')->with('message','Order status edited successfully!');
    }

    public function finishWithReview(Request $request, Order $o){
        $reviewController = new ReviewController();
        $reviewController->addReview($request,$o);

        DB::table('orders')->where([
            ['id',$o->id]
            ])->update([
            'status' => 'FINISHED'
        ]);
        $this->addReporting($o);
        return redirect('orderlist')->with('message','Order status edited successfully!');
    }

    public function addReporting(Order $o){
        $vendor = DB::table('vendor_reportings')->where('vendor_id', $o->vendor_id)->first();
        if($vendor == null ){
            DB::table('vendor_reportings')->insert([
                'vendor_id' => $o->vendor_id,
                'number_of_transaction' => 1
            ]);
        }
        else{
            $numTransaction = $vendor->number_of_transaction;
            $numTransaction = $numTransaction + 1;
            DB::table('vendor_reportings')->where([
                ['vendor_id',$o->vendor_id]
                ])->update([
                'number_of_transaction' => $numTransaction
            ]);
        }
        $orderDetails = OrderDetail::where('order_id', $o->id)->get();
        foreach($orderDetails as $od){
            $product = DB::table('product_reportings')->where('product_id', $od->product_id)->first();
            
            if($product == null){
                DB::table('product_reportings')->insert([
                    'vendor_id' => $o->vendor_id,
                    'product_id' => $od->product_id,
                    'number_of_transaction' => $od->quantity
                ]);
            }
            else{
                $numTransaction = $product->number_of_transaction;
                $numTransaction = $numTransaction + $od->quantity;
                DB::table('product_reportings')->where([
                    ['product_id',$od->product_id]
                    ])->update([
                    'number_of_transaction' => $numTransaction
                ]);
            }
        }

    }
}
