<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Unit;

class UnitSeeder extends Seeder
{
    public function run()
    {
        $units = [
            ['code' => 'KG', 'name' => 'Kilogram'],
            ['code' => 'G', 'name' => 'Gram'],
            ['code' => 'L', 'name' => 'Liter'],
            ['code' => 'PCS', 'name' => 'Pieces'],
            ['code' => 'BOX', 'name' => 'Box'],
            ['code' => 'PACK', 'name' => 'Pack'],
            ['code' => 'M', 'name' => 'Meter'],
        ];

        foreach ($units as $unit) {
            Unit::create($unit);
        }
    }
}
