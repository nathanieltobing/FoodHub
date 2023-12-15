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
            'quantity' => 5,
            'price' => 50000.00,
            'product_name' => 'product_test_1',
            'discount' => 0.1,
            'order_id' => 1,
            'product_id' => 1
        ]);

        DB::table('order_details')->insert([
            'id' => 2,
            'quantity' => 6,
            'price' => 50000.00,
            'product_name' => 'product_test_2',
            'order_id' => 1,
            'product_id' => 1,
        ]);

        DB::table('order_details')->insert([
            'id' => 3,
            'quantity' => 5,
            'price' => 50000.00,
            'product_name' => 'product_test_3',
            'order_id' => 2,
            'product_id' => 1
        ]);

        DB::table('order_details')->insert([
            'id' => 4,
            'quantity' => 6,
            'price' => 50000.00,
            'product_name' => 'product_test_4',
            'order_id' => 4,
            'product_id' => 1,
        ]);

    }
}
