<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class VendorReportingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vendor_reportings')->insert([
            'id' => 1,
            'vendor_id' => 1,
            'number_of_transaction' => 5,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
