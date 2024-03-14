<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       $this->call(AdminSeeder::class);
       $this->call(CustomerSeeder::class);
       $this->call(VendorSeeder::class);
       $this->call(CategorySeeder::class);
       $this->call(PromotionSeeder::class);
       $this->call(ProductSeeder::class);
       $this->call(OrderSeeder::class);
       $this->call(OrderDetailSeeder::class);
       $this->call(VendorReportingSeeder::class);
       $this->call(ProductReportingSeeder::class);
    }
}
