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

        // 1. Admin HR
        $userHr = User::create([
            'name' => 'Admin HR',
            'email' => 'hr@company.com',
            'password' => bcrypt('password'),
        ]);
        $userHr->assignRole('admin_hr');

        Employee::create([
            'user_id' => $userHr->id,
            'employee_code' => 'EMP-001',
            'name' => 'Admin HR',
            'email' => 'hr@company.com',
            'department_id' => Department::where('code', 'HR')->first()->id,
            'position_id' => Position::where('code', 'ADM')->first()->id,
            'shift_id' => Shift::where('code', 'SHIFT1')->first()->id,
            'join_date' => '2020-01-01',
            'status' => 'active',
        ]);

        // 2. Manager
        $userMgr = User::create([
            'name' => 'Manager Produksi',
            'email' => 'manager@company.com',
            'password' => bcrypt('password'),
        ]);
        $userMgr->assignRole('manager');

        Employee::create([
            'user_id' => $userMgr->id,
            'employee_code' => 'EMP-002',
            'name' => 'Manager Produksi',
            'email' => 'manager@company.com',
            'department_id' => Department::where('code', 'PROD')->first()->id,
            'position_id' => Position::where('code', 'MGR')->first()->id,
            'shift_id' => Shift::where('code', 'SHIFT1')->first()->id,
            'join_date' => '2018-06-15',
            'status' => 'active',
        ]);

        // 3. Supervisor
        $userSpv = User::create([
            'name' => 'Supervisor Gudang',
            'email' => 'supervisor@company.com',
            'password' => bcrypt('password'),
        ]);
        $userSpv->assignRole('supervisor');

        Employee::create([
            'user_id' => $userSpv->id,
            'employee_code' => 'EMP-003',
            'name' => 'Supervisor Gudang',
            'email' => 'supervisor@company.com',
            'department_id' => Department::where('code', 'WH')->first()->id,
            'position_id' => Position::where('code', 'SPV')->first()->id,
            'shift_id' => Shift::where('code', 'SHIFT2')->first()->id,
            'join_date' => '2019-03-10',
            'status' => 'active',
        ]);

        // 4. Warehouse Staff
        $userWh = User::create([
            'name' => 'Staff Gudang',
            'email' => 'warehouse@company.com',
            'password' => bcrypt('password'),
        ]);
        $userWh->assignRole('warehouse');

        Employee::create([
            'user_id' => $userWh->id,
            'employee_code' => 'EMP-004',
            'name' => 'Staff Gudang',
            'email' => 'warehouse@company.com',
            'department_id' => Department::where('code', 'WH')->first()->id,
            'position_id' => Position::where('code', 'STAFF')->first()->id,
            'shift_id' => Shift::where('code', 'SHIFT1')->first()->id,
            'join_date' => '2021-05-20',
            'status' => 'active',
        ]);

        // 5. Employee biasa (tanpa user login)
        Employee::create([
            'user_id' => null,
            'employee_code' => 'EMP-005',
            'name' => 'Budi Santoso',
            'email' => 'budi@company.com',
            'phone' => '08123456789',
            'department_id' => Department::where('code', 'PROD')->first()->id,
            'position_id' => Position::where('code', 'OPR')->first()->id,
            'shift_id' => Shift::where('code', 'SHIFT3')->first()->id,
            'join_date' => '2022-01-10',
            'status' => 'active',
        ]);

        // Buat beberapa karyawan tambahan dengan user (untuk testing)
        for ($i = 6; $i <= 20; $i++) {
            $user = User::create([
                'name' => "Karyawan $i",
                'email' => "karyawan$i@company.com",
                'password' => bcrypt('password'),
            ]);
            $user->assignRole('employee');

            Employee::create([
                'user_id' => $user->id,
                'employee_code' => "EMP-" . str_pad($i, 3, '0', STR_PAD_LEFT),
                'name' => "Karyawan $i",
                'email' => "karyawan$i@company.com",
                'department_id' => Department::inRandomOrder()->first()->id,
                'position_id' => Position::inRandomOrder()->first()->id,
                'shift_id' => Shift::inRandomOrder()->first()->id,
                'join_date' => now()->subDays(rand(30, 365)),
                'status' => 'active',
            ]);
        }
    }
}
