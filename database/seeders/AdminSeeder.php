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
            'name' => 'Admin 1',
            'email' => 'admin1@gmail.com',
            'password' => bcrypt('123'),
            'role' => 'ADMIN',
        ]);
    }
}
