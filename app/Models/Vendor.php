<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends User
{
    use HasFactory;

    protected $casts = [
        'category' => 'array'
    ];

    public function orders(){
        return $this->hasMany(Order::class,'vendor_id', 'id');
    }

    public function products(){
        return $this->hasMany(Product::class);
    }

    public function promotions(){
        return $this->hasMany(Promotion::class, 'vendor_id', 'id');
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }
}
