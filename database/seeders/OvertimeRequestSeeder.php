<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OvertimeRequest;
use App\Models\Employee;
use Carbon\Carbon;

class OvertimeRequestSeeder extends Seeder
{
    public function run()
    {
        $employees = Employee::where('status', 'active')->get();

        foreach ($employees as $employee) {
            for ($i = 0; $i < rand(0, 2); $i++) {
                $date = now()->subDays(rand(1, 30));
                $start = Carbon::parse('17:00:00');
                $end = Carbon::parse('19:00:00');
                $statuses = ['pending', 'approved', 'rejected'];
                $status = $statuses[array_rand($statuses)];

                OvertimeRequest::create([
                    'employee_id' => $employee->id,
                    'date' => $date,
                    'start_time' => $start,
                    'end_time' => $end,
                    'total_hours' => 2,
                    'reason' => 'Penyelesaian target produksi',
                    'attachment' => null,
                    'status' => $status,
                    'approved_by' => $status === 'approved' ? 2 : null,
                    'approved_at' => $status === 'approved' ? now() : null,
                    'rejection_reason' => $status === 'rejected' ? 'Overbudget' : null,
                ]);
            }
        }
    }
}
