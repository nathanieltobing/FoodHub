<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryReporting extends Model
{
    use HasFactory;

    public function categories(){
        return $this->hasOne(Category::class,'id','category_id');
    }
}
