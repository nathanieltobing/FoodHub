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
            'pricePerProduct' => 50000.00,
            'total_price' => 5*50000.00,
            'product_id' => 1,
        ]);
    }
}
