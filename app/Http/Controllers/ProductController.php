<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Validation\Rule;
use App\Models\Vendor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function insertProduct(Request $req){

        $rules = [
            'name' => 'required|max:25|regex:/^[\pL\s\-]+$/u',
            'quantity' => 'required',
            'price' => 'required',
            'category' => 'required', Rule::in(['Main Course', 'Appetizer', 'Desserts']),
            'dp' => 'required|image',
            'desc' => 'required'
        ];

        $validator = Validator::make($req->all(), $rules);
        // $validator = $this->validate($req, $rules);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $file = $req->file('dp');
        $imageName = time().'.'.$file->getClientOriginalExtension();
        Storage::putFileAs('public/images', $file,$imageName);
        $imageName = 'images/'.$imageName;

        $product = new Product();
        $product->name = $req->name;
        $product->price = $req->price;

        $product->stock = $req->quantity;
        $product->description = $req->desc;
        $product->product_picture = $req->dp;
        // dd($req->category);
        $category = Category::where('name', $req->category)->first();
        $product->category_id = $category->id;

        $product->vendor_id = Auth::guard('webvendor')->user()->id;

        $product->save();

        return redirect('/');
    }

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



        //  Cart::truncate();
        //  return view('checkcoutCart');
        $most_recent_order = DB::table('orders')->latest()->first();
        foreach ($carts as $cart) {
            $order_detail = new OrderDetail();
            $order_detail->quantity = $cart->quantity;
            $order_detail->price = $cart->price;
            $order_detail->product_name = $cart->name;
            $order_detail->order_id = $most_recent_order->id;
            $order_detail->product_id = $cart->product_id;
            $order_detail->save();
        }
     }

     public function search(Vendor $v, Request $request)
     {
         return view('productList',[
            'vendor' => $v,
             'products' => Product::where('name', 'LIKE', "%$request->search%" , 'and', 'vendor_id', 'like', "$v->id")->get()
         ]);
     }
}
