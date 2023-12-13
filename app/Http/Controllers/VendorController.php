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
       
        $vendors = Vendor::paginate(3);
        return view('vendorList', ['vendors'=> $vendors]);
    }

    public function getFeaturedVendors(){
        $vendorAll = Vendor::where(function ($query){
            $query->whereNull('vendor_membership')
                  ->orWhereJsonContains('vendor_membership->status','INACTIVE');
        })->get();
        $vendors = Vendor::whereNotNull('vendor_membership')->whereJsonContains('vendor_membership->status','ACTIVE')->get();

        if($vendors->count() < 5){
            foreach($vendorAll as $vendor){
                $vendors->push($vendor);
                if($vendors->count() == 5){
                    break;
                }
            }
        }       

        return $vendors;
    }

    public function getTopRatedVendor(){
        $vendor = Vendor::orderBy('rating', 'DESC')->limit(3)->get();
        return $vendor;
    }

    public function indexHomepage(){
        $featuredVendors = $this->getFeaturedVendors();
        $topRatedVendors = $this->getTopRatedVendor();
        
        return view('homepage', ['featuredVendors'=> $featuredVendors , 'topRatedVendors' => $topRatedVendors]);

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
            'vendor' => $v,
            'products' => $v->products
        ]);
    }

    public function search(Request $request)
    {
        return view('vendorList',[
            'vendors' => Vendor::where('name', 'LIKE', "%$request->search%")->get()
        ]);
    }

}
