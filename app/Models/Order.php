<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function customers(){
        return $this->belongsTo(Customer::class);
    }
    public function order_details(){
        return $this->hasMany(OrderDetail::class);
    }
    public function vendors(){
        return $this->belongsTo(Vendor::class,'vendor_id','id');
    }
}
