<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateShiftRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() && $this->user()->can('employee.update');
    }

    public function rules(): array
    {
        return [
            'code' => [
                'required',
                'string',
                'max:20',
                Rule::unique('shifts', 'code')->ignore($this->shift),
            ],
            'name' => 'required|string|max:255',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'late_tolerance' => 'nullable|integer|min:0',
            'is_overnight' => 'boolean',
            'is_active' => 'boolean',
        ];
    }
}