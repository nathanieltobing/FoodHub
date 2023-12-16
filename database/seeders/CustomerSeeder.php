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
        $endPeriod = Carbon::now()->addDays(30);
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
            'status_updated_by' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()

        ]);
        DB::table('customers')->insert([
            'id' => 2,
            'name' => 'Customer 2',
            'email' => 'customer2@gmail.com',
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
            'status_updated_by' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()

        ]);
        DB::table('customers')->insert([
            'id' => 3,
            'name' => 'Customer 3',
            'email' => 'customer3@gmail.com',
            'password' => bcrypt('123'),
            'role' => 'CUSTOMER',
            'status' => 'ACTIVE',
            'status_updated_by' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()

        ]);
        DB::table('customers')->insert([
            'id' => 4,
            'name' => 'Customer 4',
            'email' => 'customer4@gmail.com',
            'password' => bcrypt('123'),
            'role' => 'CUSTOMER',
            'status' => 'ACTIVE',
            'status_updated_by' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()

        ]);
        DB::table('customers')->insert([
            'id' => 5,
            'name' => 'Customer 5',
            'email' => 'customer5@gmail.com',
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
            'status_updated_by' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()

        ]);
        DB::table('customers')->insert([
            'id' => 6,
            'name' => 'Customer 6',
            'email' => 'customer6@gmail.com',
            'password' => bcrypt('123'),
            'role' => 'CUSTOMER',
            'status' => 'ACTIVE',
            'status_updated_by' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()

        ]);
        
    }
}
