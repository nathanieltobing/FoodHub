<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'id' => 1,
            'name' => 'First Product',
            'price' => 50000.00,
            'stock' => 10,
            'description' => 'ini adalah first product dari vendor 1',
            'category_id' => 1,
            'vendor_id' => 1
        ]);
    }
}
