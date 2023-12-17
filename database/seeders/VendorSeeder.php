<?php

namespace Database\Seeders;

use Carbon\Carbon;
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
        $startPeriod = Carbon::now();
        $endPeriod = Carbon::now()->addDays(30);

        DB::table('vendors')->insert([
            'id' => 1,
            'name' => 'Vendor 1',
            'email' => 'vendor1@gmail.com',
            'password' => bcrypt('123'),
            'description' => 'Ini adalah contoh vendor category main course',         
            'rating' => 3,
            'image' => 'images/1702475666.jpg',
            'vendor_membership' => json_encode([

                'id' => 1,
                'status' => 'ACTIVE',
                'startPeriod' => $startPeriod,
                'endPeriod' => $endPeriod,
                'promotionList' => json_encode([
                    'promotionId',
                    'promotionId',
                    'promotionId'
                ])
            ]),
            'role' => 'VENDOR',
            'status' => 'ACTIVE',
            'status_updated_by' => '1',
            'phone' => '081234567891',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('vendors')->insert([
            'id' => 2,
            'name' => 'Vendor 2',
            'email' => 'vendor2@gmail.com',
            'password' => bcrypt('123'),
            'description' => 'Ini adalah contoh vendor category main course',
            'rating' => 3,
            'image' => 'images/1702475666.jpg',
            'vendor_membership' => json_encode([

                'id' => 1,
                'status' => 'ACTIVE',
                'startPeriod' => $startPeriod,
                'endPeriod' => $endPeriod,
                'promotionList' => json_encode([
                    'promotionId',
                    'promotionId',
                    'promotionId'
                ])
            ]),
            'role' => 'VENDOR',
            'status' => 'ACTIVE',
            'status_updated_by' => '1',
            'phone' => '081234567891',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('vendors')->insert([
            'id' => 3,
            'name' => 'Vendor 3',
            'email' => 'vendor3@gmail.com',
            'password' => bcrypt('123'),
            'description' => 'Ini adalah contoh vendor category main course',          
            'rating' => 3,
            'image' => 'images/1702475666.jpg',
            'role' => 'VENDOR',
            'status' => 'ACTIVE',
            'status_updated_by' => '1',
            'phone' => '081234567891',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('vendors')->insert([
            'id' => 4,
            'name' => 'Vendor 4',
            'email' => 'vendor4@gmail.com',
            'password' => bcrypt('123'),
            'description' => 'Ini adalah contoh vendor category main course',         
            'rating' => 3,
            'image' => 'images/1702475666.jpg',
            'role' => 'VENDOR',
            'status' => 'ACTIVE',
            'status_updated_by' => '1',
            'phone' => '081234567891',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('vendors')->insert([
            'id' => 5,
            'name' => 'Vendor 5',
            'email' => 'vendor5@gmail.com',
            'password' => bcrypt('123'),
            'description' => 'Ini adalah contoh vendor category main course',         
            'rating' => 3,
            'image' => 'images/1702475666.jpg',
            'vendor_membership' => json_encode([
                'id' => 1,
                'status' => 'INACTIVE',
                'startPeriod' => $startPeriod,
                'endPeriod' => $endPeriod,
                'promotionList' => json_encode([
                    'promotionId',
                    'promotionId',
                    'promotionId'
                ])
            ]),
            'role' => 'VENDOR',
            'status' => 'ACTIVE',
            'status_updated_by' => '1',
            'phone' => '081234567891',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('vendors')->insert([
            'id' => 6,
            'name' => 'Vendor 6',
            'email' => 'vendor6@gmail.com',
            'password' => bcrypt('123'),
            'description' => 'Ini adalah contoh vendor category main course',
            'rating' => 3,
            'image' => 'images/1702475666.jpg',
            'vendor_membership' => json_encode([
                'id' => 1,
                'status' => 'INACTIVE',
                'startPeriod' => $startPeriod,
                'endPeriod' => $endPeriod,
                'promotionList' => json_encode([
                    'promotionId',
                    'promotionId',
                    'promotionId'
                ])
            ]),
            'role' => 'VENDOR',
            'status' => 'ACTIVE',
            'status_updated_by' => '1',
            'phone' => '081234567891',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
