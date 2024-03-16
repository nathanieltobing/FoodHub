<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ProductReportingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_reportings')->insert([
            'id' => 1,
            'vendor_id' => 3,
            'product_id'=> 2,
            'product_sold' => 7,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
