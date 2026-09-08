<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductCategory;

class ProductCategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['code' => 'RAW', 'name' => 'Bahan Baku', 'description' => 'Bahan baku produksi'],
            ['code' => 'PACK', 'name' => 'Kemasan', 'description' => 'Kemasan produk'],
            ['code' => 'FIN', 'name' => 'Produk Jadi', 'description' => 'Produk siap jual'],
            ['code' => 'SPARE', 'name' => 'Spare Part', 'description' => 'Komponen mesin'],
        ];

        foreach ($categories as $cat) {
            ProductCategory::create($cat);
        }
    }
}
