<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CustomerMembershipController extends Controller
{
    public function cancelMembership()
    {
        $c = Customer::where('id',Auth::guard('webcustomer')->user()->id)->first();
        $membership = json_decode($c->customer_membership);
        $membership->status = 'INACTIVE';
        $membership->startPeriod = '';
        $membership->endPeriod = '';
        $membershipData = json_encode($membership);
        DB::table('customers')->where('id', $c->id)->update([
            'customer_membership' => $membershipData
        ]);
        return redirect('customer/profile')->with('message','Membership successfuly cancelled!');
    }

    public function registerMembership()
    {
        $c = Customer::where('id',Auth::guard('webcustomer')->user()->id)->first();
        $membership = json_decode($c->customer_membership);
        $membership->status = 'ACTIVE';
        $membership->startPeriod = Carbon::now();
        $membership->endPeriod = Carbon::now()->addDays(30);
        $membershipData = json_encode($membership);
        DB::table('customers')->where('id', $c->id)->update([
            'customer_membership' => $membershipData
        ]);
        return redirect('customer/profile')->with('message','Sucessfully registered as member!');
    }

}
