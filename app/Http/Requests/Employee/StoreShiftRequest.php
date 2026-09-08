<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class StoreShiftRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() && $this->user()->can('employee.create');
    }

    public function rules(): array
    {
        return [
            'code' => 'required|string|max:20|unique:shifts,code',
            'name' => 'required|string|max:255',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'late_tolerance' => 'nullable|integer|min:0',
            'is_overnight' => 'boolean',
            'is_active' => 'boolean',
        ];
    }
}