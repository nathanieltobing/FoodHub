<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CategoryReportingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category_reportings')->insert([
            'id' => 1,
            'category_id' => 3,
            'product_sold' => 7,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
