<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'id' => 1,
            'name' => 'Nathaniel Tobing',
            'email' => 'admin1@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'ADMIN',
        ]);
        DB::table('admins')->insert([
            'id' => 2,
            'name' => 'Steven Nathaniel',
            'email' => 'admin2@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'ADMIN',
        ]);
        DB::table('admins')->insert([
            'id' => 3,
            'name' => 'Geary Riandy',
            'email' => 'admin3@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'ADMIN',
        ]);
    }
}
