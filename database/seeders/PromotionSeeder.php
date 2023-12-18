<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('promotions')->insert([
            'id' => 1,
            'discount' => 1300000.00,
            'vendor_id' => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('promotions')->insert([
            'id' => 2,
            'discount' => 1000000.00,
            'vendor_id' => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('promotions')->insert([
            'id' => 3,
            'discount' => 1500000.00,
            'vendor_id' => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('promotions')->insert([
            'id' => 4,
            'discount' => 220000.00,
            'vendor_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('promotions')->insert([
            'id' => 5,
            'discount' => 1300000.00,
            'vendor_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('promotions')->insert([
            'id' => 6,
            'discount' => 1700000.00,
            'vendor_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
