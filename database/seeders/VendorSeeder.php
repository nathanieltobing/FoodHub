<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vendors')->insert([
            'id' => 1,
            'name' => 'Vendor 1',
            'email' => 'vendor1@gmail.com',
            'password' => bcrypt('123'),
            'vendor_membership' => json_encode([
                'tes'
            ]),
            'role' => 'VENDOR',
            'status' => 'ACTIVE',
            'status_updated_by' => '1'
        ]);
    }
}
