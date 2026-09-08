<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Position;

class PositionSeeder extends Seeder
{
    public function run()
    {
        $positions = [
            ['code' => 'DIR', 'name' => 'Director'],
            ['code' => 'MGR', 'name' => 'Manager'],
            ['code' => 'SPV', 'name' => 'Supervisor'],
            ['code' => 'STAFF', 'name' => 'Staff'],
            ['code' => 'OPR', 'name' => 'Operator'],
            ['code' => 'ADM', 'name' => 'Administrator'],
            ['code' => 'ENG', 'name' => 'Engineer'],
        ];

        foreach ($positions as $pos) {
            Position::create($pos);
        }
    }
}
