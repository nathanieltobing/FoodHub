<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PromotionController extends Controller
{
    public function viewCreatePromotion(Product $p){
        return view('createpromotion',[
            'product' => $p
        ]);
    }

    public function addPromotion(Product $p, Request $req){
        $rules = [
            'discount' => 'required|numeric'
        ];

        $validator = Validator::make($req->all(), $rules);
        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $promotion = new Promotion();
        $promotion->discount = $req->discount;
        $promotion->vendor_id = Auth::guard('webvendor')->user()->id;
        $promotion->save();

        $p->update(['promotion_id' => $promotion->id]);

        return redirect('/registermembership/products');
    }
}
