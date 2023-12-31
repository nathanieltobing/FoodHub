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
        return $this->belongsTo(Order::class,'vendor_id', 'id');
    }

    public function products(){
        return $this->hasMany(Product::class);
    }
}
