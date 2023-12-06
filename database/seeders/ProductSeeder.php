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
            'category_id' => 1,
            'vendor_id' => 1
        ]);

        DB::table('products')->insert([
            'id' => 2,
            'name' => 'Second Product',
            'price' => 50000.00,
            'stock' => 10,
            'description' => 'ini adalah first product dari vendor 2',
            'category_id' => 1,
            'vendor_id' => 1
        ]);

        DB::table('products')->insert([
            'id' => 3,
            'name' => 'Third Product',
            'price' => 50000.00,
            'stock' => 10,
            'description' => 'ini adalah first product dari vendor 3',
            'category_id' => 1,
            'vendor_id' => 1
        ]);

        DB::table('products')->insert([
            'id' => 4,
            'name' => 'Fourth Product',
            'price' => 50000.00,
            'stock' => 10,
            'description' => 'ini adalah first product dari vendor 4',
            'category_id' => 1,
            'vendor_id' => 1
        ]);

        DB::table('products')->insert([
            'id' => 5,
            'name' => 'Fifth Product',
            'price' => 50000.00,
            'stock' => 10,
            'description' => 'ini adalah first product dari vendor 5',
            'category_id' => 1,
            'vendor_id' => 1
        ]);
    }
}
