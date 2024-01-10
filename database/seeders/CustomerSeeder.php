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
            'name' => 'Danang Prasetyo',
            'email' => 'customer1@gmail.com',
            'password' => bcrypt('12345678'),
            'customer_membership' => json_encode([
                'status'=> 'ACTIVE',
                'startPeriod'=> $startPeriod,
                'endPeriod' => $endPeriod,
                'discount' => 10
            ]),
            'role' => 'CUSTOMER',
            'status' => 'ACTIVE',
            'status_updated_by' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'image' => 'images/danangprasetyo.png'
        ]);
        DB::table('customers')->insert([
            'id' => 2,
            'name' => 'Vera Purwanti',
            'email' => 'customer2@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'CUSTOMER',
            'status' => 'ACTIVE',
            'status_updated_by' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'image' => 'images/verapurwanti.png'
        ]);
        DB::table('customers')->insert([
            'id' => 3,
            'name' => 'Zizi Mulyani',
            'email' => 'customer3@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'CUSTOMER',
            'status' => 'ACTIVE',
            'status_updated_by' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()

        ]);
        DB::table('customers')->insert([
            'id' => 4,
            'name' => 'Endah Nuraini',
            'email' => 'customer4@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'CUSTOMER',
            'status' => 'ACTIVE',
            'status_updated_by' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()

        ]);
        DB::table('customers')->insert([
            'id' => 5,
            'name' => 'Labuh Kuswoyo',
            'email' => 'customer5@gmail.com',
            'password' => bcrypt('12345678'),
            'customer_membership' => json_encode([
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
            'name' => 'Elisa Mardhiyah',
            'email' => 'customer6@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'CUSTOMER',
            'status' => 'ACTIVE',
            'status_updated_by' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

    }
}
