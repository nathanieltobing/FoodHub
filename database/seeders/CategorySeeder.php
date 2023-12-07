<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => 'Appetizer'
        ]);
        DB::table('categories')->insert([
            'name' => 'Main Course'
        ]);
        DB::table('categories')->insert([
            'name' => 'Desserts'
        ]);
    }
}
