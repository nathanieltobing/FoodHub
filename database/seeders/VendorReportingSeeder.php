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
            'total_earning_monthly' => 5100000,
            'month' => Carbon::now()->month,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
