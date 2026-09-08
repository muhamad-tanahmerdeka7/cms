<?php

namespace Database\Seeders;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cache
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // === Buat permissions ===
        $permissions = [
            // Dashboard
            'dashboard.view',

            // Employee
            'employee.view',
            'employee.create',
            'employee.update',
            'employee.delete',

            // Attendance
            'attendance.view',
            'attendance.create',
            'attendance.edit',
            'attendance.approve',

            // Leave
            'leave.view',
            'leave.create',
            'leave.edit',
            'leave.approve',

            // Overtime
            'overtime.view',
            'overtime.create',
            'overtime.edit',
            'overtime.approve',

            // Inventory
            'inventory.view',
            'inventory.create',
            'inventory.update',
            'inventory.delete',
            'stock.in',
            'stock.out',
            'stock.adjust',

            // Report
            'report.view',

            // Settings
            'settings.view',
            'settings.manage',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm, 'guard_name' => 'web']);
        }

        // === Buat roles ===
        $superAdmin = Role::firstOrCreate(['name' => 'super_admin']);
        $adminHr = Role::firstOrCreate(['name' => 'admin_hr']);
        $manager = Role::firstOrCreate(['name' => 'manager']);
        $supervisor = Role::firstOrCreate(['name' => 'supervisor']);
        $warehouse = Role::firstOrCreate(['name' => 'warehouse']);
        $employee = Role::firstOrCreate(['name' => 'employee']);

        // Assign permissions
        $superAdmin->givePermissionTo(Permission::all());

        $adminHr->givePermissionTo([
            'dashboard.view',
            'employee.view', 'employee.create', 'employee.update', 'employee.delete',
            'attendance.view', 'attendance.create', 'attendance.edit', 'attendance.approve',
            'leave.view', 'leave.approve',
            'overtime.view', 'overtime.approve',
            'report.view',
        ]);

        $manager->givePermissionTo([
            'dashboard.view',
            'leave.approve',
            'overtime.approve',
            'report.view',
        ]);

        $supervisor->givePermissionTo([
            'dashboard.view',
            'leave.approve',
            'overtime.approve',
        ]);

        $warehouse->givePermissionTo([
            'dashboard.view',
            'inventory.view', 'inventory.create', 'inventory.update', 'inventory.delete',
            'stock.in', 'stock.out', 'stock.adjust',
            'report.view',
        ]);

        $employee->givePermissionTo([
            'dashboard.view',
            'attendance.create',
            'leave.create', 'leave.view',
            'overtime.create', 'overtime.view',
        ]);

        // Buat user super_admin (sudah ada dari Breeze mungkin, tapi kita pastikan)
        $user = User::firstOrCreate(
            ['email' => 'admin@company.com'],
            [
                'name' => 'Super Admin',
                'password' => bcrypt('password'),
            ]
        );
        $user->assignRole('super_admin');
    }
}
