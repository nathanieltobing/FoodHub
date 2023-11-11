<?php

namespace Database\Seeders;

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
        DB::table('customers')->insert([
            'id' => 1,
            'name' => 'Customer 1',
            'email' => 'customer1@gmail.com',
            'password' => bcrypt('123'),
            'customer_membership' => json_encode([
                'tes'
            ]),
            'role' => 'CUSTOMER',
            'status' => 'ACTIVE',
            'status_updated_by' => '1'
        ]);
    }
}
