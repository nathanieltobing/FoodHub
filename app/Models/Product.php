<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $fillable = ['promotion_id'];

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
        return $this->belongsTo(Promotion::class,'promotion_id', 'id');
    }
}
