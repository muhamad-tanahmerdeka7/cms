<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockTransaction extends Model
{
    use HasFactory;

    const TYPE_IN = 'in';
    const TYPE_OUT = 'out';
    const TYPE_ADJUSTMENT = 'adjustment';

    protected $fillable = [
        'product_id',
        'type',
        'reference_type',
        'reference_id',
        'quantity',
        'stock_before',
        'stock_after',
        'transaction_date',
        'notes',
        'created_by',
    ];

    protected $casts = [
        'quantity' => 'decimal:3',
        'stock_before' => 'decimal:3',
        'stock_after' => 'decimal:3',
        'transaction_date' => 'datetime',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Scope untuk tipe tertentu
    public function scopeType($query, $type)
    {
        return $query->where('type', $type);
    }

    // Scope untuk transaksi masuk
    public function scopeIn($query)
    {
        return $query->where('type', self::TYPE_IN);
    }

    // Scope untuk transaksi keluar
    public function scopeOut($query)
    {
        return $query->where('type', self::TYPE_OUT);
    }

    // Scope untuk adjustment
    public function scopeAdjustment($query)
    {
        return $query->where('type', self::TYPE_ADJUSTMENT);
    }

    // Helper: apakah transaksi masuk
    public function getIsInAttribute()
    {
        return $this->type === self::TYPE_IN;
    }

    // Helper: apakah transaksi keluar
    public function getIsOutAttribute()
    {
        return $this->type === self::TYPE_OUT;
    }

    // Helper: apakah adjustment
    public function getIsAdjustmentAttribute()
    {
        return $this->type === self::TYPE_ADJUSTMENT;
    }
}