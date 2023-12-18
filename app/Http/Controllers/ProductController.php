<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Promotion;
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
            'name' => 'required|max:50|regex:/^[\pL\s\-]+$/u',
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

        return redirect('/product/vendor');
    }

    public function addIndex(){
        return view('addProduct');
    }

    public function editIndex(Product $id){
        return view('editProduct', ['product'=> $id]);

    }

    public function editProduct(Product $id, Request $req){

        $rules = [
            'name' => 'required|max:50|regex:/^[\pL\s\-]+$/u',        
            'quantity' => 'required',
            'price' => 'required',
            'category' => 'required', Rule::in(['Main Course', 'Appetizer', 'Desserts']),
            'dp' => 'image',
            'desc' => 'required'
        ];

        $validator = Validator::make($req->all(), $rules);
        // $validator = $this->validate($req, $rules);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        if($req->hasFile('dp')){
            $file = $req->file('dp');
            $imageName = time().'.'.$file->getClientOriginalExtension();
            Storage::putFileAs('public/images', $file,$imageName);
            $imageName = 'images/'.$imageName;
        }
        else{
            $imageName = $id->product_picture;
        }

        $id->name = $req->name;
        $id->price = $req->price;

        $id->stock = $req->quantity;
        $id->description = $req->desc;
        $id->product_picture = $imageName;
        // dd($req->category);
        $category = Category::where('name', $req->category)->first();
        $id->category_id = $category->id;

        $id->save();

        return redirect('/product/vendor');
    }

    public function checkProductFromOtherVendor(Product $product){
        $carts = session()->get('cart');
        if(empty($carts)){
            return true;
        }
        else{
            $cart = reset($carts);
            if($product->vendor_id == $cart['vendor_id']){
                return true;
            }
            return false;
        }
    }

    public function addToCart($id){
        $product = Product::find($id);
        $cart = session()-> get('cart',[]);
        $discount = null;
        if($product->promotion_id != null){
            $promotion = Promotion::where('id',$product->promotion_id)->first();
            $discount = $promotion->discount;
        }
        if($this->checkProductFromOtherVendor($product)){
            if(isset($cart[$id])){
                $cart[$id]['quantity']++;
            }
            else{
                $cart[$id] = [          
                    "name" => $product->name,
                    "quantity" => 1,
                    "price" => $product->price,
                    "product_id"=> $id,
                    "vendor_id"=>$product->vendor_id,
                    "discounted_price"=>$discount,
                    "image"=>$product->product_picture
                ];
            }
            session()->put('cart', $cart);
    
            return redirect('/checkout');
        }
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
        $vc = new VendorController();
        $error = $vc->checkInAnotherVendorPage($v->id);
         return view('productList',[
            'vendor' => $v,
             'products' => Product::where('name', 'LIKE', "%$request->search%")->where('vendor_id','like',"$v->id")->paginate(2),
             'error' => $error
         ]);
     }
}
