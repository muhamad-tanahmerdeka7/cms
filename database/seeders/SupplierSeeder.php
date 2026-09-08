<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    public function run()
    {
        $suppliers = [
            ['code' => 'SUP001', 'name' => 'PT Bahan Baku Jaya', 'phone' => '021-123456', 'email' => 'info@bahanbaku.com', 'address' => 'Jakarta'],
            ['code' => 'SUP002', 'name' => 'CV Sumber Makmur', 'phone' => '022-654321', 'email' => 'sumber@makmur.com', 'address' => 'Bandung'],
            ['code' => 'SUP003', 'name' => 'Toko Maju Terus', 'phone' => '031-987654', 'email' => 'maju@terus.com', 'address' => 'Surabaya'],
        ];

        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }
    }
}
