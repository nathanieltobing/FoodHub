<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $startPeriod = Carbon::now();
        $endPeriod = $startPeriod->addDays(30);
        DB::table('customers')->insert([
            'id' => 1,
            'name' => 'Customer 1',
            'email' => 'customer1@gmail.com',
            'password' => bcrypt('123'),
            'customer_membership' => json_encode([
                'id' => 1,
                'status'=> 'ACTIVE',
                'startPeriod'=> $startPeriod,
                'endPeriod' => $endPeriod,
                'discount' => 10
            ]),
            'role' => 'CUSTOMER',
            'status' => 'ACTIVE',
            'status_updated_by' => '1'
        ]);
    }
}
