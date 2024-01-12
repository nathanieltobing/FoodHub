<?php

namespace Database\Seeders;

use Carbon\Carbon;
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
            'name' => 'Chocolate Cake',
            'price' => 1500000.00,
            'stock' => 100,
            'description' => 'Kue cokelat untuk acara ukuran menengah untuk jumlah orang 100-200',
            'image' => '/images/chocolate-cake.jpeg',
            'category_id' => 3,
            'vendor_id' => 3,
            'promotion_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('products')->insert([
            'id' => 2,
            'name' => 'Strawberry Cake',
            'price' => 1300000.00,
            'stock' => 80,
            'description' => 'Kue strawberry untuk acara ukuran menengah untuk jumlah orang 100-200',
            'image' => '/images/strawberry-cake.jpg',
            'category_id' => 3,
            'vendor_id' => 3,
            'promotion_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('products')->insert([
            'id' => 3,
            'name' => 'Vanilla Cake',
            'price' => 1700000.00,
            'stock' => 120,
            'description' => 'Kue vanilla untuk acara ukuran menengah untuk jumlah orang 100-200',
            'image' => '/images/vanilla-cake.jpg',
            'category_id' => 3,
            'vendor_id' => 3,
            'promotion_id' => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('products')->insert([
            'id' => 4,
            'name' => 'Chocolate Bread',
            'price' => 900000.00,
            'stock' => 200,
            'description' => 'Roti cokelat untuk acara ukuran menengah untuk jumlah orang 100-200',
            'image' => '/images/chocolate-bread.jpeg',
            'category_id' => 3,
            'vendor_id' => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('products')->insert([
            'id' => 5,
            'name' => 'Soes Kering',
            'price' => 250000.00,
            'stock' => 100,
            'description' => 'Soes kering untuk acara ukuran menengah untuk jumlah orang 30-50',
            'image' => '/images/Soes_kering.jpg',
            'category_id' => 1,
            'vendor_id' => 2,
            'promotion_id' => 4,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('products')->insert([
            'id' => 6,
            'name' => 'Makaroni Balado',
            'price' => 150000.00,
            'stock' => 100,
            'description' => 'Makaroni Balado untuk acara ukuran menengah untuk jumlah orang 30-50',
            'image' => '/images/makaroni_balado.jpg',
            'category_id' => 1,
            'vendor_id' => 2,
            'promotion_id' => 5,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('products')->insert([
            'id' => 11,
            'name' => 'Basreng',
            'price' => 200000.00,
            'stock' => 100,
            'description' => 'Basreng untuk acara ukuran menengah untuk jumlah orang 30-50',
            'image' => '/images/basreng.jpg',
            'category_id' => 1,
            'vendor_id' => 2,
            'promotion_id' => 6,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('products')->insert([
            'id' => 7,
            'name' => 'Pie Susu',
            'price' => 200000.00,
            'stock' => 100,
            'description' => 'Pie Susu untuk acara ukuran menengah untuk jumlah orang 30-50',
            'image' => '/images/pie_susu.jpg',
            'category_id' => 1,
            'vendor_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('products')->insert([
            'id' => 8,
            'name' => 'Coklat Kurma',
            'price' => 300000.00,
            'stock' => 100,
            'description' => 'Coklat Kurma untuk acara ukuran menengah untuk jumlah orang 30-50',
            'image' => '/images/Coklat_kurma.jpg',
            'category_id' => 1,
            'vendor_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('products')->insert([
            'id' => 9,
            'name' => 'Nasi Kotak',
            'price' => 2000000.00,
            'stock' => 100,
            'description' => 'Nasi Kotak untuk acara ukuran menengah untuk jumlah orang 100-150',
            'image' => '/images/Nasi_kotak.jpg',
            'category_id' => 2,
            'vendor_id' => 4,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('products')->insert([
            'id' => 10,
            'name' => 'Nasi Kuning',
            'price' => 2500000.00,
            'stock' => 100,
            'description' => 'Nasi Kuning untuk acara ukuran menengah untuk jumlah orang 100-150',
            'image' => '/images/Nasi_kuning.jpg',
            'category_id' => 2,
            'vendor_id' => 4,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('products')->insert([
            'id' => 12,
            'name' => 'Nasi Liwet',
            'price' => 2200000.00,
            'stock' => 100,
            'description' => 'Nasi Liwet untuk acara ukuran menengah untuk jumlah orang 100-150',
            'image' => '/images/nasiliwet.jpg',
            'category_id' => 2,
            'vendor_id' => 4,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
