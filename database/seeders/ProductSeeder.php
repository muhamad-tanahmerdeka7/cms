<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Unit;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $categories = ProductCategory::all();
        $units = Unit::all();

        $products = [
            ['code' => 'PRD-001', 'name' => 'Tepung Terigu', 'minimum_stock' => 50, 'maximum_stock' => 500],
            ['code' => 'PRD-002', 'name' => 'Gula Pasir', 'minimum_stock' => 30, 'maximum_stock' => 300],
            ['code' => 'PRD-003', 'name' => 'Minyak Goreng', 'minimum_stock' => 20, 'maximum_stock' => 200],
            ['code' => 'PRD-004', 'name' => 'Telur Ayam', 'minimum_stock' => 100, 'maximum_stock' => 1000],
            ['code' => 'PRD-005', 'name' => 'Susu Bubuk', 'minimum_stock' => 15, 'maximum_stock' => 150],
            ['code' => 'PRD-006', 'name' => 'Kemasan Box', 'minimum_stock' => 200, 'maximum_stock' => 2000],
            ['code' => 'PRD-007', 'name' => 'Label Stiker', 'minimum_stock' => 500, 'maximum_stock' => 5000],
        ];

        foreach ($products as $product) {
            Product::create([
                'category_id' => $categories->random()->id,
                'unit_id' => $units->random()->id,
                'code' => $product['code'],
                'name' => $product['name'],
                'minimum_stock' => $product['minimum_stock'],
                'maximum_stock' => $product['maximum_stock'],
                'description' => 'Produk ' . $product['name'],
                'is_active' => true,
            ]);
        }

        // Tambah produk random lagi
        for ($i = 8; $i <= 30; $i++) {
            Product::create([
                'category_id' => $categories->random()->id,
                'unit_id' => $units->random()->id,
                'code' => 'PRD-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'name' => "Produk $i",
                'minimum_stock' => rand(10, 100),
                'maximum_stock' => rand(200, 1000),
                'description' => "Deskripsi produk $i",
                'is_active' => true,
            ]);
        }
    }
}
