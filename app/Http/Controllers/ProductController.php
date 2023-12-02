<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function checkout(Product $products)
    {
        $product = Product::find($products->id);

        return view('checkout',[
            'product' => $product
        ]);
    }
}
