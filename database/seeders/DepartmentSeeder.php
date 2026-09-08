<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            ['code' => 'HR', 'name' => 'Human Resources', 'description' => 'Mengelola sumber daya manusia'],
        //     ['code' => 'FIN', 'name' => 'Finance', 'description' => 'Keuangan dan akuntansi'],
        //     ['code' => 'PROD', 'name' => 'Production', 'description' => 'Produksi barang'],
        //     ['code' => 'WH', 'name' => 'Warehouse', 'description' => 'Gudang dan logistik'],
        //     ['code' => 'MKT', 'name' => 'Marketing', 'description' => 'Pemasaran dan penjualan'],
        //     ['code' => 'IT', 'name' => 'Information Technology', 'description' => 'Teknologi informasi'],
        //     ['code' => 'QA', 'name' => 'Quality Assurance', 'description' => 'Pengendalian kualitas'],
        // ];
        ];
        foreach ($departments as $dept) {
            // Department::create($dept);
       Department::firstOrCreate(
            ['code' => $dept['code']], // kondisi unik
            $dept // data yang akan diisi jika tidak ditemukan
        );
    }
}
}
