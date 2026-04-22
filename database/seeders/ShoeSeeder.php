<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShoeSeeder extends Seeder
{
    public function run(): void
    {
        // Insert category
        $catId = DB::table('tbl_category')->insertGetId([
            'name'       => 'Nike',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Insert 3 products under that category
        $products = [
            [
                'name'        => 'Nike Air Max 270',
                'price'       => 150.00,
                'qty'         => 30,
                'description' => 'Max Air unit delivers all-day comfort with bold street style. Lightweight mesh upper keeps your feet cool.',
                'img'         => 'photos/nike-air-max-270.jpg',
                'cat_id'      => $catId,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'Nike Air Force 1',
                'price'       => 110.00,
                'qty'         => 25,
                'description' => 'The iconic silhouette that defined a generation. Clean leather upper with classic Nike branding.',
                'img'         => 'photos/nike-air-force-1.jpg',
                'cat_id'      => $catId,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'Nike React Infinity Run',
                'price'       => 160.00,
                'qty'         => 20,
                'description' => 'Engineered to reduce injury risk on every run. React foam provides a smooth, responsive ride.',
                'img'         => 'photos/nike-react-infinity.jpg',
                'cat_id'      => $catId,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ];

        DB::table('tbl_product')->insert($products);
    }
}
