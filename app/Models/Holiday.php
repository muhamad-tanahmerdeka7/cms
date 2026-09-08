<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
     use HasFactory;

    protected $fillable = [
        'date',
        'name',
        'is_national',
        'description',
    ];

    protected $casts = [
        'date' => 'date',
        'is_national' => 'boolean',
    ];

    // Scope untuk mendapatkan hari libur pada rentang tanggal tertentu
    public function scopeBetween($query, $start, $end)
    {
        return $query->whereBetween('date', [$start, $end]);
    }

    // Scope untuk hari libur nasional
    public function scopeNational($query)
    {
        return $query->where('is_national', true);
    }
}
