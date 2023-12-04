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

class UserController extends Controller
{
   
    public function login(Request $request){
        $credential = [
            'email' => $request->email,
            'password' => $request->password
        ];
        // dd($request->role);

        if($request->remember_me) {
            Cookie::queue("email", $request->email);
            Cookie::queue("password", $request->password);
            
        }
        else {
            Cookie::queue(Cookie::forget("email"));
            Cookie::queue(Cookie::forget("password"));
        }
        switch($request->role) {
            case "CUSTOMER" :
                if(Auth::guard('webcustomer')->attempt($credential,true)){
                    Session::put('mysession',Auth::guard('webcustomer')->user()->name);
                    return redirect('/');
                }
                else{
                    return redirect()->back()->withErrors('Username or Password is incorrect !');
                
                }   
                break;
            case "VENDOR" :
                if(Auth::guard('webvendor')->attempt($credential,true)){
                    Session::put('mysession',Auth::guard('webvendor')->user()->name);
                    return redirect('/');
                }
                else{
                    return redirect()->back()->withErrors('Username or Password is incorrect !');
                
                }   
                break;
            case "ADMIN" :
                if(Auth::guard('webadmin')->attempt($credential,true)){
                    Session::put('mysession',Auth::guard('webadmin')->user()->name);
                    return redirect('/');
                }
                else{
                    return redirect()->back()->withErrors('Username or Password is incorrect !');
                
                }   
                break;

        }
          
        
    }
}
