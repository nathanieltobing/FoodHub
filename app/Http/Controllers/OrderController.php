<?php

namespace App\Http\Controllers;

use App\Mail\Email;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use App\Models\Vendor;
use App\Models\Customer;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


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
        return redirect()->back()->with('message','Order status edited successfully!');
    }

    public function editNegoStatus(Request $request, Order $o)
    {
        DB::table('orders')->where([
            ['id',$o->id]
            ])->update([
            'nego_status' => 'ACCEPTED'
        ]);
        return redirect()->back()->with('message','Order status edited successfully!');
    }

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
        return redirect()->back()->with('message','Order status edited successfully!');
    }

    public function acceptVendorPrice(Order $o){
        DB::table('orders')->where([
            ['id',$o->id]
            ])->update([
            'nego_status' => 'ACCEPTED'
        ]);
        return redirect()->back()->with('message','Order status edited successfully!');
    }

    public function rejectVendorPrice(Order $o){
        DB::table('orders')->where([
            ['id',$o->id]
            ])->update([
            'status' => 'REJECTED'
        ]);
        return redirect()->back()->with('message','Order status edited successfully!');
    }

    public function finishPayment(Order $o){
        $o->status = "ON GOING";
        $o->save();
        return redirect('orderlist');
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
        // $this->sendEmail($most_recent_order,$orderDetails,$order->vendor_id);
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
        // $this->sendEmail($most_recent_order,$orderDetails,$order->vendor_id);
        session()->put('cart', []);
        return view('succesfulPage');

     }

     public function sendEmail($order,$orderDetails,$vendor_id){
        $vendor = Vendor::find($vendor_id);
        Mail::to(Auth::guard('webcustomer')->user()->email)->send(new Email($order,$orderDetails,$vendor));
     }

     public function finishWithoutReview(Order $o){
        DB::table('orders')->where([
            ['id',$o->id]
            ])->update([
            'status' => 'FINISHED'
        ]);
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

        return redirect('orderlist')->with('message','Order status edited successfully!');
    }
}
