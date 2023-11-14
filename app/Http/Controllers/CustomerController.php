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

class CustomerController extends Controller
{
    public function register(Request $req){

        $rules = [
            'first_name' => 'required|max:25|alpha',
            'last_name' => 'required|max:25|alpha',
            'email' => 'required|email:rfc,dns',
            'role' => 'required', Rule::in([1, 2]),
            'gender' => 'required',
            'dp' => 'required|image',
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
        $customer->role_id = $req->role;
        $customer->gender_id = $req->gender;
        $customer->first_name = $req->first_name;
        $customer->last_name = $req->last_name;
        $customer->email = $req->email;
       // $customer->display_picture_link = $imageName;
        $customer->password = bcrypt($req->password);


        

        $customer->save();

        return redirect('/login');
    }

    public function login(Request $request){
        $credential = [
            'email' => $request->email,
            'password' => $request->password
        ];
        //dd($credential);

        if($request->remember_me) {
            Cookie::queue("email", $request->email);
            Cookie::queue("password", $request->password);
            
        }
        else {
            Cookie::queue(Cookie::forget("email"));
            Cookie::queue(Cookie::forget("password"));
        }
        if(Auth::attempt($credential,true)){
            Session::put('mysession',Auth::user()->first_name);
            return redirect('/');
        }
        else{
            return redirect()->back()->withErrors('Username or Password is incorrect !');
        
        }      
        
    }
}
