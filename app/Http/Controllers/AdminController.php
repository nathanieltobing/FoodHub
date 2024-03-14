<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Order;
use App\Models\Vendor;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(){
        $customers = Customer::paginate(5, ['*'], 'customers');
        $vendors = Vendor::paginate(5, ['*'], 'vendors');
        $totalCustomer = Customer::get()->count();
        $totalVendor = Vendor::get()->count();

        return view('adminPage', ['customers'=> $customers , 'vendors' => $vendors , 'totalCustomer' => $totalCustomer, 'totalVendor' => $totalVendor]);
    }

    public function deActivateUser($id, Request $req){
        if($req->role == "CUSTOMER"){
            $customer = Customer::find($id);
            $customer->status = 'INACTIVE';
            $customer->status_updated_by = Auth::guard('webadmin')->user()->id;
            $customer->save();
            return redirect()->back();
        }
        else if($req->role == "VENDOR"){
            $vendor = Vendor::find($id);
            $vendor->status = 'INACTIVE';
            $vendor->status_updated_by = Auth::guard('webadmin')->user()->id;
            $vendor->save();
            return redirect()->back();
        }
    }

    public function activateUser($id, Request $req){
        if($req->role == "CUSTOMER"){
            $customer = Customer::find($id);
            $customer->status = 'ACTIVE';
            $customer->status_updated_by = Auth::guard('webadmin')->user()->id;
            $customer->save();
            return redirect()->back();
        }
        else if($req->role == "VENDOR"){
            $vendor = Vendor::find($id);
            $vendor->status = 'ACTIVE';
            $vendor->status_updated_by = Auth::guard('webadmin')->user()->id;
            $vendor->save();
            return redirect()->back();
        }
    }

    public function viewOrders(){
        return view('admin-payment',[
            'orders' => Order::all()
        ]);
    }

    public function viewTransaction(Order $o){
        return view('transaction',[
            'order' => $o,
            'vendor' => Vendor::where('id', $o->vendor_id)->first()
        ]);
    }

    public function acceptPaymentProof(Order $o){
        $o->status = 'ON GOING';
        $o->payment_proof_status = 'APPROVED';
        $o->save();

        return redirect('admin-payment')->with('message','Payment proof successfully approved');
    }

    public function rejectPaymentProof(Order $o){
        $o->payment_proof_status = 'REJECTED';
        $o->save();
        return redirect('admin-payment')->with('message','Payment proof successfully rejected');
    }
}
