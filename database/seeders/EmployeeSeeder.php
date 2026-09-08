<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Position;
use App\Models\Shift;
use Spatie\Permission\Models\Role;

class EmployeeSeeder extends Seeder
{
    public function run()
    {
        // Pastikan role sudah ada (dari RolePermissionSeeder)
        // Buat beberapa user dengan role berbeda

        // === Helper untuk mendapatkan atau membuat data master ===
        $getDepartment = function ($code, $name, $description = null) {
            return Department::firstOrCreate(
                ['code' => $code],
                ['name' => $name, 'description' => $description, 'is_active' => true]
            );
        };

        $getPosition = function ($code, $name) {
            return Position::firstOrCreate(
                ['code' => $code],
                ['name' => $name, 'is_active' => true]
            );
        };

        $getShift = function ($code, $name, $start, $end, $tolerance = 15, $overnight = false) {
            return Shift::firstOrCreate(
                ['code' => $code],
                [
                    'name' => $name,
                    'start_time' => $start,
                    'end_time' => $end,
                    'late_tolerance' => $tolerance,
                    'is_overnight' => $overnight,
                    'is_active' => true
                ]
            );
        };

        // === Buat data master yang dibutuhkan jika belum ada ===
        $deptHR = $getDepartment('HR', 'Human Resources', 'Mengelola sumber daya manusia');
        $deptPROD = $getDepartment('PROD', 'Production', 'Produksi barang');
        $deptWH = $getDepartment('WH', 'Warehouse', 'Gudang dan logistik');

        $posADM = $getPosition('ADM', 'Administrator');
        $posMGR = $getPosition('MGR', 'Manager');
        $posSPV = $getPosition('SPV', 'Supervisor');
        $posSTAFF = $getPosition('STAFF', 'Staff');
        $posOPR = $getPosition('OPR', 'Operator');

        $shift1 = $getShift('SHIFT1', 'Pagi', '07:00:00', '16:00:00', 15, false);
        $shift2 = $getShift('SHIFT2', 'Siang', '15:00:00', '23:00:00', 15, false);
        $shift3 = $getShift('SHIFT3', 'Malam', '23:00:00', '07:00:00', 15, true);

        // === 1. Admin HR ===
        $userHr = User::firstOrCreate(
            ['email' => 'hr@company.com'],
            ['name' => 'Admin HR', 'password' => bcrypt('password')]
        );
        $userHr->assignRole('admin_hr');

        Employee::firstOrCreate(
            ['employee_code' => 'EMP-001'],
            [
                'user_id' => $userHr->id,
                'name' => 'Admin HR',
                'email' => 'hr@company.com',
                'department_id' => $deptHR->id,
                'position_id' => $posADM->id,
                'shift_id' => $shift1->id,
                'join_date' => '2020-01-01',
                'status' => 'active',
            ]
        );

        // === 2. Manager ===
        $userMgr = User::firstOrCreate(
            ['email' => 'manager@company.com'],
            ['name' => 'Manager Produksi', 'password' => bcrypt('password')]
        );
        $userMgr->assignRole('manager');

        Employee::firstOrCreate(
            ['employee_code' => 'EMP-002'],
            [
                'user_id' => $userMgr->id,
                'name' => 'Manager Produksi',
                'email' => 'manager@company.com',
                'department_id' => $deptPROD->id,
                'position_id' => $posMGR->id,
                'shift_id' => $shift1->id,
                'join_date' => '2018-06-15',
                'status' => 'active',
            ]
        );

        // === 3. Supervisor ===
        $userSpv = User::firstOrCreate(
            ['email' => 'supervisor@company.com'],
            ['name' => 'Supervisor Gudang', 'password' => bcrypt('password')]
        );
        $userSpv->assignRole('supervisor');

        Employee::firstOrCreate(
            ['employee_code' => 'EMP-003'],
            [
                'user_id' => $userSpv->id,
                'name' => 'Supervisor Gudang',
                'email' => 'supervisor@company.com',
                'department_id' => $deptWH->id,
                'position_id' => $posSPV->id,
                'shift_id' => $shift2->id,
                'join_date' => '2019-03-10',
                'status' => 'active',
            ]
        );

        // === 4. Warehouse Staff ===
        $userWh = User::firstOrCreate(
            ['email' => 'warehouse@company.com'],
            ['name' => 'Staff Gudang', 'password' => bcrypt('password')]
        );
        $userWh->assignRole('warehouse');

        Employee::firstOrCreate(
            ['employee_code' => 'EMP-004'],
            [
                'user_id' => $userWh->id,
                'name' => 'Staff Gudang',
                'email' => 'warehouse@company.com',
                'department_id' => $deptWH->id,
                'position_id' => $posSTAFF->id,
                'shift_id' => $shift1->id,
                'join_date' => '2021-05-20',
                'status' => 'active',
            ]
        );

        // === 5. Employee biasa (tanpa user login) ===
        Employee::firstOrCreate(
            ['employee_code' => 'EMP-005'],
            [
                'user_id' => null,
                'name' => 'Budi Santoso',
                'email' => 'budi@company.com',
                'phone' => '08123456789',
                'department_id' => $deptPROD->id,
                'position_id' => $posOPR->id,
                'shift_id' => $shift3->id,
                'join_date' => '2022-01-10',
                'status' => 'active',
            ]
        );

        // === Buat 15 karyawan tambahan dengan user ===
        for ($i = 6; $i <= 20; $i++) {
            $email = "karyawan$i@company.com";
            $user = User::firstOrCreate(
                ['email' => $email],
                ['name' => "Karyawan $i", 'password' => bcrypt('password')]
            );
            $user->assignRole('employee');

            Employee::firstOrCreate(
                ['employee_code' => "EMP-" . str_pad($i, 3, '0', STR_PAD_LEFT)],
                [
                    'user_id' => $user->id,
                    'name' => "Karyawan $i",
                    'email' => $email,
                    'department_id' => Department::inRandomOrder()->first()->id ?? $deptPROD->id,
                    'position_id' => Position::inRandomOrder()->first()->id ?? $posSTAFF->id,
                    'shift_id' => Shift::inRandomOrder()->first()->id ?? $shift1->id,
                    'join_date' => now()->subDays(rand(30, 365)),
                    'status' => 'active',
                ]
            );
        }
    }
}
