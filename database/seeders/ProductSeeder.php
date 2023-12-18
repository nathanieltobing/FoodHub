<?php

namespace Database\Seeders;

use Carbon\Carbon;
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
            'name' => 'Chocolate Cake',
            'price' => 1500000.00,
            'stock' => 100,
            'description' => 'Kue cokelat untuk acara ukuran menengah untuk jumlah orang 100-200',
            'product_picture' => '/images/chocolate-cake.jpeg',
            'category_id' => 3,
            'vendor_id' => 3,
            'promotion_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('products')->insert([
            'id' => 2,
            'name' => 'Strawberry Cake',
            'price' => 1300000.00,
            'stock' => 80,
            'description' => 'Kue strawberry untuk acara ukuran menengah untuk jumlah orang 100-200',
            'product_picture' => '/images/strawberry-cake.jpg',
            'category_id' => 3,
            'vendor_id' => 3,
            'promotion_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('products')->insert([
            'id' => 3,
            'name' => 'Vanilla Cake',
            'price' => 1700000.00,
            'stock' => 120,
            'description' => 'Kue vanilla untuk acara ukuran menengah untuk jumlah orang 100-200',
            'product_picture' => '/images/vanilla-cake.jpg',
            'category_id' => 3,
            'vendor_id' => 3,
            'promotion_id' => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('products')->insert([
            'id' => 4,
            'name' => 'Chocolate Bread',
            'price' => 900000.00,
            'stock' => 200,
            'description' => 'Roti cokelat untuk acara ukuran menengah untuk jumlah orang 100-200',
            'product_picture' => '/images/chocolate-bread.jpeg',
            'category_id' => 3,
            'vendor_id' => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('products')->insert([
            'id' => 5,
            'name' => 'Fifth Product',
            'price' => 50000.00,
            'stock' => 10,
            'description' => 'ini adalah first product dari vendor 5',
            'product_picture' => '1701874795.jpg',
            'category_id' => 1,
            'vendor_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('products')->insert([
            'id' => 6,
            'name' => 'Fifth Product',
            'price' => 50000.00,
            'stock' => 10,
            'description' => 'ini adalah first product dari vendor 5',
            'product_picture' => '1701874795.jpg',
            'category_id' => 1,
            'vendor_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('products')->insert([
            'id' => 7,
            'name' => 'Fifth Product',
            'price' => 50000.00,
            'stock' => 10,
            'description' => 'ini adalah first product dari vendor 5',
            'product_picture' => '1701874795.jpg',
            'category_id' => 1,
            'vendor_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
