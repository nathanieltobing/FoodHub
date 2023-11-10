<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    public function orders(){
        return $this->belongsTo(Order::class,'order_detail_id', 'id');
    }
    public function products(){
        return $this->hasOne(Product::class,'id','product_id');
    }
}
