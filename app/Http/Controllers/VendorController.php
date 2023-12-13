<?php

namespace App\Http\Controllers;

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

    public function viewVendorProfile(){
        $v = Vendor::where('id',Auth::guard('webvendor')->user()->id)->first();
        $editmode = false;
        $editprofpic = false;
        $membership = json_decode($v->vendor_membership);
        if($membership->status == 'ACTIVE') $ismember = true;
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
        if($membership->status == 'ACTIVE') $ismember = true;
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
        if($membership->status == 'ACTIVE') $ismember = true;
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

    public function cancelMembership()
    {
        $v = Vendor::where('id',Auth::guard('webvendor')->user()->id)->first();
        $membership = json_decode($v->vendor_membership);
        $membership->status = 'INACTIVE';
        $membership->startPeriod = '';
        $membership->endPeriod = '';
        $membership->promotionList = '';
        $membershipData = json_encode($membership);
        DB::table('vendors')->where('id', $v->id)->update([
            'vendor_membership' => $membershipData
        ]);
        foreach($v->products as $product){
            $product->promotion_id = NULL;
            $product->save();
        };

        $v->promotions()->delete();

        return redirect('vendor/profile')->with('message','Membership successfuly cancelled!');
    }

    public function registerMembership()
    {
        $v = Vendor::where('id',Auth::guard('webvendor')->user()->id)->first();
        $membership = json_decode($v->vendor_membership);
        $membership->status = 'ACTIVE';
        $membership->startPeriod = Carbon::now();
        $membership->endPeriod = Carbon::now()->addDays(30);
        $membershipData = json_encode($membership);
        DB::table('vendors')->where('id', $v->id)->update([
            'vendor_membership' => $membershipData
        ]);

        return redirect('vendor/profile')->with('message','Sucessfully registered as member!');
    }

}
