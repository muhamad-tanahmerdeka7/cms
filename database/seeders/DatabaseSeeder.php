<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
       $this->call([
        RolePermissionSeeder::class,
        DepartmentSeeder::class,
        PositionSeeder::class,
        ShiftSeeder::class,
        LeaveTypeSeeder::class,
        UnitSeeder::class,
        ProductCategorySeeder::class,
        SupplierSeeder::class,
        EmployeeSeeder::class,      // Sekarang robust
        AttendanceSeeder::class,
        LeaveRequestSeeder::class,
        OvertimeRequestSeeder::class,
        ProductSeeder::class,
        StockTransactionSeeder::class,
    ]);
}
}