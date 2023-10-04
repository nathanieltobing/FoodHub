<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactUsController extends Controller
{
    
    public function index(){
       

        $categories = DB::table('categories')->get();

        return view('contactUs', ['categories' => $categories]);
     // tessss
    }

}