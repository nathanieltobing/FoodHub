<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_details')->insert([
            'id' => 1,
            'order_quantity' => 5,
            'price_per_product' => 50000.00,
            'total_price' => 5*50000.00,
            'product_id' => 1,
        ]);

        DB::table('order_details')->insert([
            'id' => 2,
            'order_quantity' => 6,
            'price_per_product' => 50000.00,
            'total_price' => 6*50000.00,
            'product_id' => 1,
        ]);

        DB::table('order_details')->insert([
            'id' => 3,
            'order_quantity' => 6,
            'price_per_product' => 50000.00,
            'total_price' => 6*50000.00,
            'product_id' => 1,
        ]);

        DB::table('order_details')->insert([
            'id' => 4,
            'order_quantity' => 6,
            'price_per_product' => 50000.00,
            'total_price' => 6*50000.00,
            'product_id' => 1,
        ]);
    }
}
