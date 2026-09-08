<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
   use HasFactory;

    protected $fillable = [
        'user_id',
        'department_id',
        'position_id',
        'shift_id',
        'employee_code',
        'name',
        'email',
        'phone',
        'gender',
        'birth_date',
        'join_date',
        'resign_date',
        'photo',
        'status',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'join_date' => 'date',
        'resign_date' => 'date',
        'gender' => 'string',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function leaveRequests()
    {
        return $this->hasMany(LeaveRequest::class);
    }

    public function overtimeRequests()
    {
        return $this->hasMany(OvertimeRequest::class);
    }

    // Scope untuk employee yang aktif
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    // Helper: umur
    public function getAgeAttribute()
    {
        return $this->birth_date ? $this->birth_date->age : null;
    }

    // Helper: lama bekerja (dalam tahun)
    public function getYearsOfServiceAttribute()
    {
        return $this->join_date ? $this->join_date->diffInYears(now()) : 0;
    }
}
