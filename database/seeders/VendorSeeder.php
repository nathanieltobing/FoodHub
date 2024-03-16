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
            'name' => 'Gerai Snack Tangerang',
            'email' => 'geraisnacktangerang@gmail.com',
            'password' => bcrypt('12345678'),
            'description' => 'Gerai Snack Tangerang adalah vendor makanan penyedia makanan ringan berkualitas dan terjangkau',         
            'rating' => 4,
            'image' => 'images/geraiSnack.jpg',
            'status' => 'ACTIVE',
            'status_updated_by' => '1',
            'phone' => '081235287823',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('vendors')->insert([
            'id' => 2,
            'name' => 'Aneka Snack',
            'email' => 'anekasnack@gmail.com',
            'password' => bcrypt('12345678'),
            'description' => 'Aneka Snack adalah penyedia snack atau makanan ringan yang mempunyai produk beragam mulai dari keripik sampai makanan ringan pesta',
            'rating' => 4,
            'image' => 'images/anekaSnack.jpg',
            'vendor_membership' => json_encode([             
                'status' => 'ACTIVE',
                'startPeriod' => $startPeriod,
                'endPeriod' => $endPeriod
            ]),
            'status' => 'ACTIVE',
            'status_updated_by' => '1',
            'phone' => '081243547696',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('vendors')->insert([
            'id' => 3,
            'name' => 'Sweet Bakery',
            'email' => 'sweetbakery@gmail.com',
            'password' => bcrypt('12345678'),
            'description' => 'Sweet Bakery merupakan bakery yang menyediakan beragam jenis kue maupun roti dengan beraneka rasa',          
            'rating' => 5,
            'image' => 'images/sweetbakery.jpg',
            'vendor_membership' => json_encode([             
                'status' => 'ACTIVE',
                'startPeriod' => $startPeriod,
                'endPeriod' => $endPeriod
            ]),
            'status' => 'ACTIVE',
            'status_updated_by' => '1',
            'phone' => '081223567221',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('vendors')->insert([
            'id' => 4,
            'name' => 'Salama Catering',
            'email' => 'salamacatering@gmail.com',
            'password' => bcrypt('12345678'),
            'description' => 'Salama catering menyediakan berbagai menu nasi kotak untuk acara besar maupun kecil dengan rasa yang terpecaya',         
            'rating' => 3,
            'image' => 'images/salamaCatering.jpg',
            'status' => 'ACTIVE',
            'status_updated_by' => '1',
            'phone' => '081231335611',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        // DB::table('vendors')->insert([
        //     'id' => 5,
        //     'name' => 'Vendor 5',
        //     'email' => 'vendor5@gmail.com',
        //     'password' => bcrypt('123'),
        //     'description' => 'Ini adalah contoh vendor category main course',         
        //     'rating' => 3,
        //     'image' => 'images/1702475666.jpg',
            // 'vendor_membership' => json_encode([
            //     'id' => 1,
            //     'status' => 'INACTIVE',
            //     'startPeriod' => $startPeriod,
            //     'endPeriod' => $endPeriod
            // ]),
        //     'role' => 'VENDOR',
        //     'status' => 'ACTIVE',
        //     'status_updated_by' => '1',
        //     'phone' => '081234567891',
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now()
        // ]);

        // DB::table('vendors')->insert([
        //     'id' => 6,
        //     'name' => 'Vendor 6',
        //     'email' => 'vendor6@gmail.com',
        //     'password' => bcrypt('123'),
        //     'description' => 'Ini adalah contoh vendor category main course',
        //     'rating' => 3,
        //     'image' => 'images/1702475666.jpg',
        //     'vendor_membership' => json_encode([
        //         'id' => 1,
        //         'status' => 'INACTIVE',
        //         'startPeriod' => $startPeriod,
        //         'endPeriod' => $endPeriod,
        //         'promotionList' => json_encode([
        //             'promotionId',
        //             'promotionId',
        //             'promotionId'
        //         ])
        //     ]),
        //     'role' => 'VENDOR',
        //     'status' => 'ACTIVE',
        //     'status_updated_by' => '1',
        //     'phone' => '081234567891',
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now()
        // ]);
    }
}
