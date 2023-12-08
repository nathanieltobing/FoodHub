<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class VendorController extends UserController
{
    public function index(){
        // $books = DB::table('books')->get();
        // $books = Book::paginate(4);
        // $categories = DB::table('categories')->get();
        $vendors = Vendor::paginate(3);
        // dd($products->isEmpty());
        return view('vendorList', ['vendors'=> $vendors]);
    }

    public function register(Request $req){

        $rules = [
            'name' => 'required|max:25|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|email:rfc,dns',
            'role' => 'required', Rule::in(['CUSTOMER', 'VENDOR']),
            'category' => 'required', Rule::in(['Food', 'Beverages']),
            'dp' => 'required|image',
            'password' => 'required | min:8 | alpha_num |confirmed'
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


        $vendor = new Vendor();
        $vendor->role = $req->role;
        $vendor->name = $req->name;
        $vendor->email = $req->email;
        $vendor->vendor_picture = $imageName;
        $vendor->password = bcrypt($req->password);
        $vendor->status = 'ACTIVE';



        $vendor->save();

        return redirect('/login');
    }

    public function showProductList(Vendor $v){
        return view('productList',[
            'products' => $v->products,
        ]);
    }

}
