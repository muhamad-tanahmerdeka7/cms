<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'start_time',
        'end_time',
        'late_tolerance',
        'is_overnight',
        'is_active',
    ];

    protected $casts = [
        'start_time' => 'datetime:H:i:s',
        'end_time' => 'datetime:H:i:s',
        'is_overnight' => 'boolean',
        'is_active' => 'boolean',
        'late_tolerance' => 'integer',
    ];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Helper: menghitung jam kerja normal (dalam menit)
    public function getWorkDurationInMinutesAttribute()
    {
        $start = $this->start_time;
        $end = $this->end_time;
        if ($this->is_overnight) {
            // Jika shift melewati tengah malam, tambahkan 24 jam ke end_time
            $end = $end->addDay();
        }
        return $start->diffInMinutes($end);
    }
}