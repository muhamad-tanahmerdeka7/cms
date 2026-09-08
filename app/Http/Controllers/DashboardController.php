<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\LeaveRequest;
use App\Models\OvertimeRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $role = $user->roles->first()->name ?? 'employee';

        // Data statistik umum
        $totalEmployees = Employee::where('status', 'active')->count();
        $today = Carbon::today();
        $presentToday = Attendance::whereDate('attendance_date', $today)
            ->whereIn('status', ['present', 'late'])
            ->count();
        $lateToday = Attendance::whereDate('attendance_date', $today)
            ->where('status', 'late')
            ->count();
        $pendingLeaves = LeaveRequest::where('status', 'pending')->count();
        $pendingOvertimes = OvertimeRequest::where('status', 'pending')->count();

        // Data grafik absensi per bulan (6 bulan terakhir)
        $monthlyData = $this->getMonthlyAttendanceData();

        // Data proyeksi / log kehadiran (misal 5 data terakhir)
        $recentAttendances = Attendance::with('employee')
            ->latest()
            ->limit(5)
            ->get()
            ->map(function ($att) {
                return [
                    'date' => $att->attendance_date->format('d M Y'),
                    'check_in' => $att->check_in ? $att->check_in->format('H:i') : '-',
                    'status' => $att->status,
                    'employee' => $att->employee->name,
                ];
            });

        // Notifikasi tim (contoh dummy, bisa diganti dengan data real)
        $teamNotifications = [
            ['name' => 'Seluruh Wibro', 'status' => 'Selanjutnya: 31'],
            ['name' => 'Surah Sawantun', 'status' => 'Selanjutnya: 1.39'],
            ['name' => 'Surah Simana', 'status' => 'Selanjutnya: 21'],
            ['name' => 'Surah Sumbawa', 'status' => 'Selanjutnya: 29'],
            ['name' => 'Surah Bima', 'status' => 'Selanjutnya: 24'],
            ['name' => 'Surah Makassar', 'status' => 'Selanjutnya: 25'],
            ['name' => 'Surah Ternate', 'status' => 'Selanjutnya: 26'],
        ];

        // Data untuk kalender log (30 hari terakhir)
        $calendarLog = collect(range(1, 30))->map(function ($day) use ($today) {
            $date = $today->copy()->subDays(30 - $day);
            $attendance = Attendance::whereDate('attendance_date', $date)->count();
            return [
                'day' => $day,
                'date' => $date->format('d M'),
                'count' => $attendance,
            ];
        });

        // Log kehadiran terbaru
        $attendanceLog = Attendance::with('employee')
            ->latest()
            ->limit(4)
            ->get()
            ->map(function ($att) {
                return [
                    'date' => $att->attendance_date->format('d M Y'),
                    'check_in' => $att->check_in ? $att->check_in->format('H:i') : '-',
                    'status' => $att->status,
                    'employee' => $att->employee->name,
                ];
            });

        return view('dashboard.index', compact(
            'totalEmployees',
            'presentToday',
            'lateToday',
            'pendingLeaves',
            'pendingOvertimes',
            'monthlyData',
            'recentAttendances',
            'teamNotifications',
            'calendarLog',
            'attendanceLog',
            'role'
        ));
    }

    private function getMonthlyAttendanceData()
    {
        $months = collect();
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $months->push([
                'month' => $month->format('M'),
                'year' => $month->year,
                'present' => Attendance::whereMonth('attendance_date', $month->month)
                    ->whereYear('attendance_date', $month->year)
                    ->whereIn('status', ['present', 'late'])
                    ->count(),
                'absent' => Attendance::whereMonth('attendance_date', $month->month)
                    ->whereYear('attendance_date', $month->year)
                    ->where('status', 'absent')
                    ->count(),
            ]);
        }
        return $months;
    }
}
