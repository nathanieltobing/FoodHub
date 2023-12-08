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
            'description' => 'Ini adalah contoh vendor category main course',
            'category' => json_encode([
                'Main Course',
                'Desserts',
                'Fruits'
            ]),
            'rating' => 3,
            'vendor_picture' => 'images/product1.jpg',
            'vendor_membership' => json_encode([
                'tes'
            ]),
            'role' => 'VENDOR',
            'status' => 'ACTIVE',
            'status_updated_by' => '1'
        ]);

        DB::table('vendors')->insert([
            'id' => 2,
            'name' => 'Vendor 2',
            'email' => 'vendor1@gmail.com',
            'password' => bcrypt('123'),
            'description' => 'Ini adalah contoh vendor category main course',
            'category' => json_encode([
                'Main Course',
                'Desserts',
                'Fruits'
            ]),
            'rating' => 3,
            'vendor_picture' => 'images/product1.jpg',
            'vendor_membership' => json_encode([
                'tes'
            ]),
            'role' => 'VENDOR',
            'status' => 'ACTIVE',
            'status_updated_by' => '1'
        ]);

        DB::table('vendors')->insert([
            'id' => 3,
            'name' => 'Vendor 3',
            'email' => 'vendor1@gmail.com',
            'password' => bcrypt('123'),
            'description' => 'Ini adalah contoh vendor category main course',
            'category' => json_encode([
                'Main Course',
                'Desserts',
                'Fruits'
            ]),
            'rating' => 3,
            'vendor_picture' => 'images/product1.jpg',
            'vendor_membership' => json_encode([
                'tes'
            ]),
            'role' => 'VENDOR',
            'status' => 'ACTIVE',
            'status_updated_by' => '1'
        ]);

        DB::table('vendors')->insert([
            'id' => 4,
            'name' => 'Vendor 4',
            'email' => 'vendor1@gmail.com',
            'password' => bcrypt('123'),
            'description' => 'Ini adalah contoh vendor category main course',
            'category' => json_encode([
                'Main Course',
                'Desserts',
                'Fruits'
            ]),
            'rating' => 3,
            'vendor_picture' => 'images/product1.jpg',
            'vendor_membership' => json_encode([
                'tes'
            ]),
            'role' => 'VENDOR',
            'status' => 'ACTIVE',
            'status_updated_by' => '1'
        ]);

        DB::table('vendors')->insert([
            'id' => 5,
            'name' => 'Vendor 5',
            'email' => 'vendor1@gmail.com',
            'password' => bcrypt('123'),
            'description' => 'Ini adalah contoh vendor category main course',
            'category' => json_encode([
                'Main Course',
                'Desserts',
                'Fruits'
            ]),
            'rating' => 3,
            'vendor_picture' => 'images/product1.jpg',
            'vendor_membership' => json_encode([
                'tes'
            ]),
            'role' => 'VENDOR',
            'status' => 'ACTIVE',
            'status_updated_by' => '1'
        ]);
    }
}
