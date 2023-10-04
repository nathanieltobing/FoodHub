<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public function publishers(){
        return $this->hasOne(Publisher::class, 'id','publisher_id');
    }
    public function categories(){
        return $this->belongsToMany(Category::class, 'book_categories', 'category_id', 'book_id');
    }
    // tes commit by geary
}
