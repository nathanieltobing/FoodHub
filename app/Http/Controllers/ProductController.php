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
        $product->product_picture = $imageName;
        // dd($req->category);
        $category = Category::where('name', $req->category)->first();
        $product->category_id = $category->id;

        $product->vendor_id = Auth::guard('webvendor')->user()->id;

        
        $product->save();

        return redirect('/');
    }

    public function editIndex(Product $id){
        return view('editProduct', ['product'=> $id]);

    }

    public function editProduct(Request $req){

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
                "product_id"=> $id,
                "vendor_id"=>$product->vendor_id
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
         $carts = session()->get('cart');
         return view('checkout', [
            'carts' => $carts
        ]);
     }

     public function deleteItem($id){
    
        $cart = session()->get('cart');
        // dd($cart);
        if(isset($cart[$id])){
            unset($cart[$id]);
            session()->put('cart', $cart);
            // dd($cart);
        }
        return redirect('/checkout');
     }

     public function addQuantity($id){
        $cart = session()->get('cart');
        if(isset($cart[$id])){          
            $cart[$id]['quantity']++;
            session()->put('cart', $cart);
            
        }
        return redirect('/checkout');
     }

     public function decreaseQuantity($id){
        $cart = session()->get('cart');
        if(isset($cart[$id])){  
            if($cart[$id]['quantity'] > 1){
                $cart[$id]['quantity']--;
            }        
            session()->put('cart', $cart);
        }
        return redirect('/checkout');
     }

     public function search(Vendor $v, Request $request)
     {
         return view('productList',[
            'vendor' => $v,
             'products' => Product::where('name', 'LIKE', "%$request->search%" , 'and', 'vendor_id', 'like', "$v->id")->get()
         ]);
     }
}
