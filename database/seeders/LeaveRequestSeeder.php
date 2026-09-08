<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LeaveRequest;
use App\Models\Employee;
use App\Models\LeaveType;
use Carbon\Carbon;

class LeaveRequestSeeder extends Seeder
{
    public function run()
    {
        $employees = Employee::where('status', 'active')->get();
        $leaveTypes = LeaveType::all();

        foreach ($employees as $employee) {
            // Masing-masing karyawan punya 2-5 pengajuan
            for ($i = 0; $i < rand(0, 3); $i++) {
                $start = Carbon::now()->subDays(rand(10, 60));
                $end = $start->copy()->addDays(rand(1, 5));
                $statuses = ['pending', 'approved', 'rejected', 'cancelled'];
                $status = $statuses[array_rand($statuses)];

                LeaveRequest::create([
                    'employee_id' => $employee->id,
                    'leave_type_id' => $leaveTypes->random()->id,
                    'start_date' => $start,
                    'end_date' => $end,
                    'total_days' => $start->diffInDays($end) + 1,
                    'reason' => 'Izin karena keperluan pribadi',
                    'attachment' => null,
                    'status' => $status,
                    'approved_by' => $status === 'approved' ? 2 : null,
                    'approved_at' => $status === 'approved' ? now() : null,
                    'rejection_reason' => $status === 'rejected' ? 'Tidak sesuai prosedur' : null,
                ]);
            }
        }
    }
}
