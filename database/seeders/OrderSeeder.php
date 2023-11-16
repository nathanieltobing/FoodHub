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
            'customer_id' => 1,
            'vendor_id' => 1,
            'order_detail_id' => 1
        ]);

        DB::table('orders')->insert([
            'id' => 2,
            'status' => 'ON GOING',
            'customer_id' => 1,
            'vendor_id' => 1,
            'order_detail_id' => 2
        ]);

        DB::table('orders')->insert([
            'id' => 3,
            'status' => 'REJECTED',
            'customer_id' => 1,
            'vendor_id' => 1,
            'order_detail_id' => 3
        ]);

        DB::table('orders')->insert([
            'id' => 4,
            'status' => 'FINISHED',
            'customer_id' => 1,
            'vendor_id' => 1,
            'order_detail_id' => 4
        ]);
    }
}
