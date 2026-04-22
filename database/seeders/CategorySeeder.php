<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Food'],
            ['name' => 'Drink'],
            ['name' => 'Cloth'],
            ['name' => 'Computer'],
            ['name' => 'Shoe'],
        ];

        DB::table('tbl_category')->insert($categories);
    }
}

