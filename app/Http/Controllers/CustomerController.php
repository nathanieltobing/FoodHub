<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CustomerController extends UserController
{
    public function register(Request $req){

        $rules = [
            'name' => 'required|max:50|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|email:rfc,dns',
            'role' => 'required', Rule::in(['CUSTOMER', 'VENDOR']),
            'password' => 'required | min:8 | alpha_num |confirmed'
        ];

        $validator = Validator::make($req->all(), $rules);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        // $file = $req->file('dp');
        // $imageName = time().'.'.$file->getClientOriginalExtension();
        // Storage::putFileAs('public/images', $file,$imageName);
        // $imageName = 'images/'.$imageName;


        $customer = new Customer();
        $customer->role = $req->role;
        $customer->name = $req->name;
        $customer->email = $req->email;
       // $customer->display_picture_link = $imageName;
        $customer->password = bcrypt($req->password);
        $customer->status = 'ACTIVE';



        $customer->save();

        return redirect('/login');
    }

    public function viewCustomerProfile(){
        $c = Customer::where('id',Auth::guard('webcustomer')->user()->id)->first();
        $editmode = false;
        $editprofpic = false;
        $membership = json_decode($c->customer_membership);
        if($membership != null && $membership->status == 'ACTIVE') $ismember = true;
        else $ismember = false;
        return view('customerprofile',[
            'user' => $c,
            'editMode' => $editmode,
            'editprofpic' => $editprofpic,
            'membership' => $membership,
            'isMember' => $ismember
        ]);
    }

    public function enableEdit(){
        $c = Customer::where('id',Auth::guard('webcustomer')->user()->id)->first();
        $editmode = true;
        $editprofpic = false;
        $membership = json_decode($c->customer_membership);
        if($membership != null && $membership->status == 'ACTIVE') $ismember = true;
        else $ismember = false;
        return view('customerprofile',[
            'user' => $c,
            'editMode' => $editmode,
            'editprofpic' => $editprofpic,
            'membership' => $membership,
            'isMember' => $ismember
        ]);
    }

    public function showEditPict(){
        $c = Customer::where('id',Auth::guard('webcustomer')->user()->id)->first();
        $editmode = true;
        $editprofpic = true;
        $membership = json_decode($c->customer_membership);
        if($membership != null && $membership->status == 'ACTIVE') $ismember = true;
        else $ismember = false;
        return view('customerprofile',[
            'user' => $c,
            'editMode' => $editmode,
            'editprofpic' => $editprofpic,
            'membership' => $membership,
            'isMember' => $ismember
        ]);
    }

    public function editProfile(Request $request)
    {
        $c = Customer::where('id',Auth::guard('webcustomer')->user()->id)->first();
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'dob' => 'nullable|date',
            'phone' => 'nullable',
            'password' => 'nullable'
        ]);
    
        if(empty($validated['password'])){
            unset($validated['password']);
        }
        else{
            $validated['password'] = bcrypt($validated['password']);
        }

        DB::table('customers')->where('id', $c->id)->update($validated);
        return redirect('customer/profile')->with('message','Profile edited successfully');
    }

    public function editPicture(Request $request)
    {
        $c = Customer::where('id',Auth::guard('webcustomer')->user()->id)->first();
        if($request->hasFile('image')){
            $fileImage = $request->file('image');
            $imageName ='user '.$c->name.'.'.$fileImage->getClientOriginalExtension();
            Storage::putFileAs('public/images', $fileImage, $imageName);
            $imageName = 'images/'.$imageName;
        }
        else{
            $imageName = $c->image;
        }

        DB::table('customers')->where('id', $c->id)->update([
            'image' => $imageName
        ]);

        return redirect('customer/profile')->with('message','Profile picture edited succesfully');
    }

    public function removePicture()
    {
        $c = Customer::where('id',Auth::guard('webcustomer')->user()->id)->first();
        Storage::delete ('public/image/'.$c->image);
        DB::table('customers')->where('id', $c->id)->update([
            'image' => NULL
        ]);

        return redirect('customer/profile')->with('message','Profile picture removed!');
    }
}
