<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends User
{
    use HasFactory;

    public function orders(){
        return $this->belongsTo(Order::class,'customer_id', 'id');
    }
}
