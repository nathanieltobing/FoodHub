<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReporting extends Model
{
    use HasFactory;

    public function products(){
        return $this->hasOne(Product::class,'id','product_id');
    }

    public function vendors(){
        return $this->hasOne(Vendor::class,'id','vendor_id');
    }
}
