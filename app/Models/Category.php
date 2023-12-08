<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // public function books(){
    //     return $this->belongsToMany(Book::class, 'book_categories', 'category_id', 'book_id');
    // }
    public function products(){
        return $this->belongsTo(Product::class,'category_id', 'id');
    }
}
