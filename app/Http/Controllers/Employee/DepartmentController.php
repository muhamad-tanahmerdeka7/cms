<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Http\Requests\Employee\StoreDepartmentRequest;
use App\Http\Requests\Employee\UpdateDepartmentRequest;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::latest()->get();
        return view('employees.departments.index', compact('departments'));
    }

    public function create()
    {
        return view('employees.departments.create');
    }

    public function store(StoreDepartmentRequest $request)
    {
        Department::create($request->validated());
        return redirect()->route('departments.index')
            ->with('success', 'Departemen berhasil ditambahkan.');
    }

    public function edit(Department $department)
    {
        return view('employees.departments.edit', compact('department'));
    }

    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        $department->update($request->validated());
        return redirect()->route('departments.index')
            ->with('success', 'Departemen berhasil diperbarui.');
    }

    public function destroy(Department $department)
    {
        if ($department->employees()->count() > 0) {
            return back()->with('error', 'Departemen masih memiliki karyawan, tidak bisa dihapus.');
        }
        $department->delete();
        return redirect()->route('departments.index')
            ->with('success', 'Departemen berhasil dihapus.');
    }
}
