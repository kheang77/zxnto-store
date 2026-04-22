<?php

namespace Database\Seeders;

use DB;
use Str;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        for($i = 0; $i < 20; $i++) {
            DB::table('tbl_product')->insert([
                'name' => Str::random(20),
                'price' => rand(1, 20),
                'qty' => rand(1, 10),
                'description' => Str::random(50),  
                'created_at' => now(),
                'updated_at' => now(),
                'img' => Str::random(20) .'.jpg',
                'cat_id' => rand(1,5),
            ]);
        }
    }
}
