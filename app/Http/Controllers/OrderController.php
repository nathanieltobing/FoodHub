<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function viewOrderList(Customer $c)
    {
        return view('orderList',[
            'order' => $c->orders,
            'customer' => $c
        ]);
    }

    public function editStatus(Request $request, Order $o)
    {
        if($request->status == '1'){
            $status = 'ON GOING';
        } else if ($request->status == '2'){
            $status = 'REJECTED';
        }

        DB::table('orders')->where([
            ['id',$o->id]
            ])->update([
            'status' => $status
        ]);
        return redirect()->back()->with('message','Order #'.$o->id.' status edited successfully!');
    }

    public function checkout(){
        $order = new Order();
        $order_detail = new OrderDetail();
        $carts = session()->get('cart');

        $total_quantity = 0; $total_price = 0;
        foreach ($carts as $cart) {
            $total_quantity+=$cart['quantity'];
            $total_price+=$cart['price'] * $cart['quantity'];
            $vendor_id = $cart['vendor_id'];
        }
        $order->status = 'OPEN';
        $order->total_price = $total_price;
        $order->total_quantity = $total_quantity;
        $order->customer_id = Auth::guard('webcustomer')->user()->id;
        $order->vendor_id = $vendor_id;
        $order->save();

        $customerMembership = Auth::guard('webcustomer')->user()->customer_membership;
            if($customerMembership != null){
                $customerMembership = json_decode($customerMembership, true);                             
            }                              

        $most_recent_order = DB::table('orders')->latest()->first();
        foreach ($carts as $cart) {
            $order_detail = new OrderDetail();
            $order_detail->quantity = $cart['quantity'];
            $order_detail->price = $cart['price'];
            $order_detail->product_name = $cart['name'];
            $order_detail->order_id = $most_recent_order->id;
            $order_detail->product_id = $cart['product_id'];
            $order_detail->discount = (double)$customerMembership['discount'] /100;
            $order_detail->save();
        }
        session()->put('cart', []);
        return view('succesfulPage');
     }
}
