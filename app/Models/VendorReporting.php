<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorReporting extends Model
{
    use HasFactory;

    public function vendors(){
        return $this->hasOne(Vendor::class,'id','vendor_id');
    }
}
