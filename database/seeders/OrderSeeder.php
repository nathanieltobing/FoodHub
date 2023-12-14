<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->insert([
            'id' => 1,
            'status' => 'OPEN',
            'total_price' => 10.0,
            'total_quantity' => 1,
            'customer_id' => 1,
            'vendor_id' => 1

        ]);

        DB::table('orders')->insert([
            'id' => 2,
            'status' => 'ON GOING',
            'total_price' => 10.0,
            'total_quantity' => 1,
            'customer_id' => 1,
            'vendor_id' => 1,
        ]);

        DB::table('orders')->insert([
            'id' => 3,
            'status' => 'REJECTED',
            'total_price' => 10.0,
            'total_quantity' => 1,
            'customer_id' => 1,
            'vendor_id' => 1,
        ]);

        DB::table('orders')->insert([
            'id' => 4,
            'status' => 'FINISHED',
            'total_price' => 10.0,
            'total_quantity' => 1,
            'customer_id' => 1,
            'vendor_id' => 1,
        ]);
    }
}
