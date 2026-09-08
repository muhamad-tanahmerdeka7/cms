<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LeaveType;

class LeaveTypeSeeder extends Seeder
{
    public function run()
    {
        $types = [
            ['code' => 'ANNUAL', 'name' => 'Cuti Tahunan', 'quota' => 12, 'requires_attachment' => false, 'is_paid' => true],
            ['code' => 'SICK', 'name' => 'Sakit', 'quota' => 14, 'requires_attachment' => true, 'is_paid' => true],
            ['code' => 'PERMISSION', 'name' => 'Izin', 'quota' => null, 'requires_attachment' => false, 'is_paid' => false],
            ['code' => 'MATERNITY', 'name' => 'Cuti Melahirkan', 'quota' => 90, 'requires_attachment' => true, 'is_paid' => true],
            ['code' => 'EMERGENCY', 'name' => 'Cuti Darurat', 'quota' => 5, 'requires_attachment' => false, 'is_paid' => true],
        ];

        foreach ($types as $type) {
            LeaveType::create($type);
        }
    }
}
