<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function customers(){
        return $this->hasOne(Customer::class,'id','customer_id');
    }
    public function order_details(){
        return $this->hasOne(OrderDetail::class,'id','order_detail_id');
    }
    public function vendors(){
        return $this->hasOne(Vendor::class,'id','vendor_id');
    }
}
