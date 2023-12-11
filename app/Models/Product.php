<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function categories(){
        return $this->hasOne(Category::class,'id','category_id');
    }
    public function vendor(){
        return $this->belongsTo(Vendor::class,'id','vendor_id');
    }
    public function order_details(){
        return $this->hasMany(OrderDetail::class);
    }
    public function promotions(){
        return $this->belongsTo(Promotion::class,'product_id', 'id');
    }
}
