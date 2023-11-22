<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
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

}
