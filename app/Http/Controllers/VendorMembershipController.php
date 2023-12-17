<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class VendorMembershipController extends Controller
{
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

    public function registerMembership(Request $req)
    {
        $rules = [
            'email' => 'required|email:rfc,dns',
            'cardNumber' => 'required|numeric',
            'expiryDate' => 'required',
            'cvv' => 'required | numeric'
        ];

        $validator = Validator::make($req->all(), $rules);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $v = Vendor::where('id',Auth::guard('webvendor')->user()->id)->first();
        $startPeriod = Carbon::now();
        $endPeriod = Carbon::now()->addDays(30);
        if(!$v->vendor_membership){
            $membershipData = json_encode([
                'status' => 'ACTIVE',
                'startPeriod' => $startPeriod,
                'endPeriod' => $endPeriod
            ]);
        } else{
            $membership = json_decode($v->vendor_membership);
            $membership->status = 'ACTIVE';
            $membership->startPeriod = $startPeriod;
            $membership->endPeriod = $endPeriod;
            $membershipData = json_encode($membership);
        }

        DB::table('vendors')->where('id', $v->id)->update([
            'vendor_membership' => $membershipData
        ]);

        return redirect('vendor/profile')->with('message','Sucessfully registered as member!');
    }
}
