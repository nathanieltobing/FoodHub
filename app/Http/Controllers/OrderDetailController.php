<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;

class OrderDetailController extends Controller
{
    public function index(Order $id){
         $orderDetails = OrderDetail::where('order_id', $id->id)->get();
        // dd($orderDetails);
        return view('orderDetail', [
            'orderDetails' => $orderDetails,
            'order' => $id
        ]);

    }
}
