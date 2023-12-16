<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
