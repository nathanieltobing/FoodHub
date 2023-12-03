<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Nette\Utils\ArrayList;

class CartController extends Controller
{
    public function addToCart($id){
        $product = Product::find($id);
        $cart = session()-> get('cart',[]);

        if(isset($cart[$id])){
            $cart[$id]['quantity']++;
        }
        else{
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "product_id"=> $id
            ];
        }
        session()->put('cart', $cart);
        
        // $cart->name = $product->name;
        // $cart->price = $product->price;
        // $cart->quantity = 1;
        // $cart->customer_id = Auth::guard('webcustomer')->id;
        // $cart->product_id = $product->id;
 
        // $cart->save();
        return redirect('/checkout');
     }
 
     public function cartIndex(){
 
         return view('checkout');
     }
 
     public function deleteItem(Request $request){
        if($request->id){
            $cart = session()->get('cart');
            if(isset($cart[$request->id])){
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
        }
     }
 
     public function checkout(){
        $order = new Order();
        $order_detail = new OrderDetail();
        $carts = session()->get('cart');

        $total_quantity = 0; $total_price = 0;
        foreach ($carts as $cart) {
            $total_quantity+=$cart->quantity;
            $total_price+=$cart->price * $cart->quantity;
            $vendor_id = $cart->vendor_id;
        }
        $order->status = 'OPEN';
        $order->total_price = $total_price;
        $order->total_quantity = $total_quantity;
        $order->customer_id = Auth::guard('webcustomer')->id;
        $order->vendor_id = $vendor_id;
        $order->save();

        

         Cart::truncate();
         return view('checkcoutCart');
     }
}
