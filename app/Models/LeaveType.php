<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
     use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'quota',
        'requires_attachment',
        'is_paid',
        'is_active',
    ];

    protected $casts = [
        'quota' => 'integer',
        'requires_attachment' => 'boolean',
        'is_paid' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function leaveRequests()
    {
        return $this->hasMany(LeaveRequest::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Helper: cek apakah jenis izin memiliki kuota
    public function getHasQuotaAttribute()
    {
        return !is_null($this->quota);
    }
}