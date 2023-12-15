<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'id' => 1,
            'name' => 'First Product',
            'price' => 50000.00,
            'stock' => 10,
            'description' => 'ini adalah first product dari vendor 1',
            'product_picture' => 'public/storage/images/1701874795.jpg',
            'category_id' => 1,
            'vendor_id' => 1
        ]);

        DB::table('products')->insert([
            'id' => 2,
            'name' => 'Second Product',
            'price' => 50000.00,
            'stock' => 10,
            'description' => 'ini adalah first product dari vendor 2',
            'product_picture' => '1701874795.jpg',
            'category_id' => 1,
            'vendor_id' => 1
        ]);

        DB::table('products')->insert([
            'id' => 3,
            'name' => 'Third Product',
            'price' => 50000.00,
            'stock' => 10,
            'description' => 'ini adalah first product dari vendor 3',
            'product_picture' => '1701874795.jpg',
            'category_id' => 1,
            'vendor_id' => 1
        ]);

        DB::table('products')->insert([
            'id' => 4,
            'name' => 'Fourth Product',
            'price' => 50000.00,
            'stock' => 10,
            'description' => 'ini adalah first product dari vendor 4',
            'product_picture' => '1701874795.jpg',
            'category_id' => 1,
            'vendor_id' => 2
        ]);

        DB::table('products')->insert([
            'id' => 5,
            'name' => 'Fifth Product',
            'price' => 50000.00,
            'stock' => 10,
            'description' => 'ini adalah first product dari vendor 5',
            'product_picture' => '1701874795.jpg',
            'category_id' => 1,
            'vendor_id' => 2
        ]);
    }
}
