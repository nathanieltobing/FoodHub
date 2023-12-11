<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CustomerController extends UserController
{
    public function register(Request $req){

        $rules = [
            'name' => 'required|max:25|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|email:rfc,dns',
            'role' => 'required', Rule::in(['CUSTOMER', 'VENDOR']),
            'password' => 'required | min:8 | alpha_num |confirmed'
        ];

        $validator = Validator::make($req->all(), $rules);
        // $validator = $this->validate($req, $rules);

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

    public function viewCustomerProfile(Customer $c){
        $editmode = false;
        $editprofpic = false;
        return view('profile',[
            'user' => $c,
            'editMode' => $editmode,
            'editprofpic' => $editprofpic
        ]);
    }

    public function enableEdit(Customer $c){
        $editmode = true;
        $editprofpic = false;
        return view('profile',[
            'user' => $c,
            'editMode' => $editmode,
            'editprofpic' => $editprofpic
        ]);
    }

    public function showEditPict(Customer $c){
        $editmode = true;
        $editprofpic = true;
        return view('profile',[
            'user' => $c,
            'editMode' => $editmode,
            'editprofpic' => $editprofpic
        ]);
    }

    public function editProfile(Request $request, Customer $c)
    {
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

        DB::table('customers')->where('id', $c->id)->update($validated);
        return redirect('profile/'.$c->id)->with('message','Profile edited successfully');
    }

    public function editPicture(Request $request, Customer $c)
    {

        if($request->hasFile('image')){
            $fileImage = $request->file('image');
            $imageName ='user '.$c->name.'.'.$fileImage->getClientOriginalExtension();
            Storage::putFileAs('public/images', $fileImage, $imageName);
        }
        else{
            $imageName = $c->image;
        }

        DB::table('customers')->where('id', $c->id)->update([
            'image' => $imageName
        ]);

        return redirect('profile/'.$c->id)->with('message','Profile picture edited succesfully');
    }

    public function removePicture(Customer $c)
    {
        Storage::delete ('public/image/'.$c->image);
        DB::table('customers')->where('id', $c->id)->update([
            'image' => NULL
        ]);

        return redirect('profile/'.$c->id)->with('message','Profile picture removed!');
    }
}
