<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Shift;

class ShiftSeeder extends Seeder
{
    public function run()
    {
        $shifts = [
            [
                'code' => 'SHIFT1',
                'name' => 'Pagi',
                'start_time' => '07:00:00',
                'end_time' => '16:00:00',
                'late_tolerance' => 15,
                'is_overnight' => false,
            ],
            [
                'code' => 'SHIFT2',
                'name' => 'Siang',
                'start_time' => '15:00:00',
                'end_time' => '23:00:00',
                'late_tolerance' => 15,
                'is_overnight' => false,
            ],
            [
                'code' => 'SHIFT3',
                'name' => 'Malam',
                'start_time' => '23:00:00',
                'end_time' => '07:00:00',
                'late_tolerance' => 15,
                'is_overnight' => true,
            ],
        ];

        foreach ($shifts as $shift) {
            Shift::create($shift);
        }
    }
}
