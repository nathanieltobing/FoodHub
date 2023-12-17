<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Carbon\Carbon;
use App\Models\Vendor;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class VendorController extends UserController
{
    public function index(){

        $vendors = Vendor::paginate(2);
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
            'name' => 'required|max:50|regex:/^[\pL\s\-]+$/u',
            'phoneNumber' => 'required|regex:/^(0)[0-9]{11}/',
            'email' => 'required|email:rfc,dns',
            'role' => 'required', Rule::in(['CUSTOMER', 'VENDOR']),         
            'dp' => 'image',
            'password' => 'required | min:8 | alpha_num |confirmed'
        ];

        $validator = Validator::make($req->all(), $rules);
        // $validator = $this->validate($req, $rules);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $vendor = new Vendor();
        if($req->hasFile('dp')){
            $file = $req->file('dp');
            $imageName = time().'.'.$file->getClientOriginalExtension();
            Storage::putFileAs('public/images', $file,$imageName);
            $imageName = 'images/'.$imageName;
            $vendor->image = $imageName;
        }

        $vendor->phone = $req->phoneNumber;
        $vendor->description ="";
        $vendor->rating = 3;
        $vendor->role = $req->role;
        $vendor->name = $req->name;
        $vendor->email = $req->email;
        $vendor->password = bcrypt($req->password);
        $vendor->status = 'ACTIVE';

        $vendor->save();

        return redirect('/login');
    }

    public function checkInAnotherVendorPage($id){
        $carts = session()->get('cart');
        if(empty($carts)){
            return "-1";
        }
        else{
            $cart = reset($carts);
            if($id == $cart['vendor_id']){
                return "-1";
            }
            return "1";
        }
    }

    public function showProductList(Vendor $v){
        $products = Product::where('vendor_id', $v->id)->paginate(3);
        $error = $this->checkInAnotherVendorPage($v->id);
        // dd($error);
        return view('productList',[
            'vendor' => $v,
            'products' => $products,
            'error' => $error
        ]);
    }

    public function showVendorProductList(){
        $products = Product::where('vendor_id',Auth::guard('webvendor')->user()->id)->paginate(3);
        return view('productList',[
            'products' => $products,
            'vendor' => Auth::guard('webvendor')->user(),
        ]);
    }

    public function search(Request $request)
    {
        // $vendorsPaginate = Vendor::paginate(3);
        return view('vendorList',[
            'vendors' => Vendor::where('name', 'LIKE', "%$request->search%")->paginate(3)
        ]);
    }

    public function viewVendorProfile(){
        $v = Vendor::where('id',Auth::guard('webvendor')->user()->id)->first();
        $editmode = false;
        $editprofpic = false;
        $membership = json_decode($v->vendor_membership);
        if($membership != null && $membership->status == 'ACTIVE') $ismember = true;
        else $ismember = false;
        return view('vendorprofile',[
            'user' => $v,
            'editMode' => $editmode,
            'editprofpic' => $editprofpic,
            'membership' => $membership,
            'isMember' => $ismember
        ]);
    }

    public function enableEdit(){
        $v = Vendor::where('id',Auth::guard('webvendor')->user()->id)->first();
        $editmode = true;
        $editprofpic = false;
        $membership = json_decode($v->vendor_membership);
        if($membership != null && $membership->status == 'ACTIVE') $ismember = true;
        else $ismember = false;
        return view('vendorprofile',[
            'user' => $v,
            'editMode' => $editmode,
            'editprofpic' => $editprofpic,
            'membership' => $membership,
            'isMember' => $ismember
        ]);
    }

    public function showEditPict(){
        $v = Vendor::where('id',Auth::guard('webvendor')->user()->id)->first();
        $editmode = true;
        $editprofpic = true;
        $membership = json_decode($v->vendor_membership);
        if($membership != null && $membership->status == 'ACTIVE') $ismember = true;
        else $ismember = false;
        return view('vendorprofile',[
            'user' => $v,
            'editMode' => $editmode,
            'editprofpic' => $editprofpic,
            'membership' => $membership,
            'isMember' => $ismember
        ]);
    }

    public function editProfile(Request $request)
    {
        $v = Vendor::where('id',Auth::guard('webvendor')->user()->id)->first();
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'description' => 'required',
            'password' => 'nullable'
        ]);

        if(empty($validated['password'])){
            unset($validated['password']);
        }

        DB::table('vendors')->where('id', $v->id)->update($validated);
        return redirect('vendor/profile')->with('message','Profile edited successfully');
    }

    public function editPicture(Request $request)
    {
        $v = Vendor::where('id',Auth::guard('webvendor')->user()->id)->first();
        if($request->hasFile('image')){
            $fileImage = $request->file('image');
            $imageName ='user '.$v->name.'.'.$fileImage->getClientOriginalExtension();
            Storage::putFileAs('public/images', $fileImage, $imageName);
        }
        else{
            $imageName = $v->image;
        }

        DB::table('vendors')->where('id', $v->id)->update([
            'image' => $imageName
        ]);

        return redirect('vendor/profile')->with('message','Profile picture edited succesfully');
    }

    public function removePicture()
    {
        $v = Vendor::where('id',Auth::guard('webvendor')->user()->id)->first();
        Storage::delete ('public/image/'.$v->image);
        DB::table('vendors')->where('id', $v->id)->update([
            'image' => NULL
        ]);

        return redirect('vendor/profile')->with('message','Profile picture removed!');
    }

}
