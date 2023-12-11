<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    public function addReview(Request $request, Order $o){
        DB::table('orders')->where([
            ['id',$o->id]
            ])->update([
            'status' => 'FINISHED'
        ]);

        DB::table('reviews')->insert(array_merge(
            [
                'rating' => $request->rating,
                'comment' => $request->comment,
                'order_id' =>  $o->id
            ]
        ));

        return redirect('orderlist/'.$o->customer_id)->with('message','Order #'.$o->id.' status edited successfully!');
    }
}
