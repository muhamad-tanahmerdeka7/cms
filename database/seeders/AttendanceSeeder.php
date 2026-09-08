<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;

class AttendanceSeeder extends Seeder
{
    public function run()
    {
        $employees = Employee::where('status', 'active')->get();
        $startDate = Carbon::now()->subDays(30);

        foreach ($employees as $employee) {
            for ($i = 0; $i < 30; $i++) {
                $date = $startDate->copy()->addDays($i);
                // Skip weekend (Sabtu/Minggu) untuk contoh
                if ($date->isWeekend()) {
                    continue;
                }

                // Random status
                $statuses = ['present', 'late', 'absent', 'leave', 'permission', 'sick'];
                $status = $statuses[array_rand($statuses)];

                $checkIn = null;
                $checkOut = null;
                $lateMinutes = 0;

                if ($status !== 'absent') {
                    $shiftStart = $employee->shift ? Carbon::parse($employee->shift->start_time) : Carbon::parse('07:00');
                    $checkIn = $date->copy()->setTimeFrom($shiftStart)->addMinutes(rand(-5, 30));
                    $checkOut = $checkIn->copy()->addHours(8)->addMinutes(rand(-10, 30));

                    if ($status === 'late') {
                        $lateMinutes = rand(1, 60);
                        $checkIn->addMinutes($lateMinutes);
                    }
                }

                Attendance::create([
                    'employee_id' => $employee->id,
                    'attendance_date' => $date,
                    'check_in' => $checkIn,
                    'check_out' => $checkOut,
                    'status' => $status,
                    'late_minutes' => $lateMinutes,
                    'overtime_hours' => rand(0, 2) * 0.5,
                    'notes' => null,
                ]);
            }
        }
    }
}
