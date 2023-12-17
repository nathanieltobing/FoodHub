<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Customer;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends UserController
{
    public function index(){
        $customers = Customer::paginate(5, ['*'], 'customers');
        $vendors = Vendor::paginate(5, ['*'], 'vendors');
        $totalCustomer = Customer::get()->count();
        $totalVendor = Vendor::get()->count();

        return view('adminPage', ['customers'=> $customers , 'vendors' => $vendors , 'totalCustomer' => $totalCustomer, 'totalVendor' => $totalVendor]);
    }

    public function deActivateCustomer(Customer $id){
        $id->status = 'INACTIVE';
        $id->status_updated_by = Auth::guard('webadmin')->user()->id;
        $id->save();
        return redirect()->back();
    }

    public function activateCustomer(Customer $id){
        $id->status = 'ACTIVE';
        $id->status_updated_by = Auth::guard('webadmin')->user()->id;
        $id->save();
        return redirect()->back();
    }

    public function deActivateVendor(Vendor $id){
        $id->status = 'INACTIVE';
        $id->status_updated_by = Auth::guard('webadmin')->user()->id;
        $id->save();
        return redirect()->back();
    }

    public function activateVendor(Vendor $id){
        $id->status = 'ACTIVE';
        $id->status_updated_by = Auth::guard('webadmin')->user()->id;
        $id->save();
        return redirect()->back();
    }
}
