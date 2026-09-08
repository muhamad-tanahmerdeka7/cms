<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Position;
use App\Models\Shift;
use App\Models\User;
use App\Http\Requests\Employee\StoreEmployeeRequest;
use App\Http\Requests\Employee\UpdateEmployeeRequest;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with(['department', 'position', 'shift', 'user'])->latest()->get();
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        $departments = Department::where('is_active', true)->get();
        $positions = Position::where('is_active', true)->get();
        $shifts = Shift::where('is_active', true)->get();
        $roles = Role::all();
        return view('employees.create', compact('departments', 'positions', 'shifts', 'roles'));
    }

    public function store(StoreEmployeeRequest $request)
    {
        // Buat user jika email diisi dan buat akun
        $user = null;
        if ($request->filled('email') && $request->filled('password')) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            if ($request->filled('role')) {
                $user->assignRole($request->role);
            }
        }

        $employee = Employee::create([
            'user_id' => $user ? $user->id : null,
            'department_id' => $request->department_id,
            'position_id' => $request->position_id,
            'shift_id' => $request->shift_id,
            'employee_code' => $request->employee_code,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'birth_date' => $request->birth_date,
            'join_date' => $request->join_date,
            'status' => $request->status,
        ]);

        return redirect()->route('employees.index')
            ->with('success', 'Karyawan berhasil ditambahkan.');
    }

    public function edit(Employee $employee)
    {
        $departments = Department::where('is_active', true)->get();
        $positions = Position::where('is_active', true)->get();
        $shifts = Shift::where('is_active', true)->get();
        $roles = Role::all();
        return view('employees.edit', compact('employee', 'departments', 'positions', 'shifts', 'roles'));
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $data = $request->validated();

        // Update user jika ada
        if ($employee->user_id && $request->filled('email')) {
            $employee->user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
            if ($request->filled('password')) {
                $employee->user->update(['password' => Hash::make($request->password)]);
            }
            if ($request->filled('role')) {
                $employee->user->syncRoles([$request->role]);
            }
        } elseif ($request->filled('email') && $request->filled('password') && !$employee->user_id) {
            // Buat user baru jika sebelumnya tidak punya user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            if ($request->filled('role')) {
                $user->assignRole($request->role);
            }
            $data['user_id'] = $user->id;
        }

        $employee->update($data);

        return redirect()->route('employees.index')
            ->with('success', 'Karyawan berhasil diperbarui.');
    }

    public function destroy(Employee $employee)
    {
        // Hapus user jika ada (opsional)
        if ($employee->user_id) {
            $employee->user->delete();
        }
        $employee->delete();
        return redirect()->route('employees.index')
            ->with('success', 'Karyawan berhasil dihapus.');
    }
}
