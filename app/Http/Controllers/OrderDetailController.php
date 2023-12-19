<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Vendor;

class OrderDetailController extends Controller
{
    public function index(Order $id){
         $orderDetails = OrderDetail::where('order_id', $id->id)->get();
         $vendor = Vendor::find($id->vendor_id);
        return view('orderDetail', [
            'orderDetails' => $orderDetails,
            'order' => $id,
            'vendor' => $vendor
        ]);

    }
}
