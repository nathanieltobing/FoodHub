<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    public function orders(){
        return $this->belongsToMany(Order::class);
    }
    public function products(){
        return $this->belongsToMany(Product::class);
    }
}
