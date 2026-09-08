<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() && $this->user()->can('employee.update');
    }

    public function rules(): array
    {
        $employee = $this->route('employee');

        return [
            'employee_code' => [
                'required',
                'string',
                'max:50',
                Rule::unique('employees', 'employee_code')->ignore($employee),
            ],
            'name' => 'required|string|max:255',
            'email' => [
                'nullable',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($employee->user_id),
            ],
            'phone' => 'nullable|string|max:30',
            'gender' => ['nullable', Rule::in(['male', 'female'])],
            'birth_date' => 'nullable|date|before:today',
            'join_date' => 'required|date|before_or_equal:today',
            'status' => ['required', Rule::in(['active', 'inactive', 'resigned'])],
            'department_id' => 'nullable|exists:departments,id',
            'position_id' => 'nullable|exists:positions,id',
            'shift_id' => 'nullable|exists:shifts,id',
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'nullable|exists:roles,name',
        ];
    }
}