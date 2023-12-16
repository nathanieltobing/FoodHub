<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Review;
use App\Models\Vendor;
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
                'order_id' =>  $o->id,
                'vendor_id' => $o->vendor_id
            ]
        ));
        $this->calculcateAndSaveNewRating($o);

        return redirect('orderlist')->with('message','Order #'.$o->id.' status edited successfully!');
    }

    public function calculcateAndSaveNewRating(Order $o){
        $vendor = Vendor::where('id',$o->vendor_id)->first();
        $totalRating = Review::where('vendor_id',$o->vendor_id)->sum('rating');
        $totalReview = Review::where('vendor_id',$o->vendor_id)->count();
        $newRating = round(($totalRating/$totalReview));
        $vendor->rating = $newRating;
        $vendor->save();
        
    }
}
