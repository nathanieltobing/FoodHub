<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\Membership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewCancelMembership()
    {
        return view('cancelmembership');
    }

    public function viewRegisterMembership()
    {
        if(Auth::guard('webvendor')->check()){
            $v = Vendor::where('id',Auth::guard('webvendor')->user()->id)->first();
            $showProducts = false;
            return view('registermembership',[
                'vendor' => $v,
                'showProducts' => $showProducts
            ]);
        } else{
            return view('registermembership');
        }

    }

    public function showVendorProducts()
    {
        if(Auth::guard('webvendor')->check()){
            $v = Vendor::where('id',Auth::guard('webvendor')->user()->id)->first();
            $showProducts = true;
            return view('registermembership',[
                'vendor' => $v,
                'showProducts' => $showProducts,
                'countDiscountedProducts' => 0
            ]);
        } else{
            return view('registermembership');
        }

    }

}
