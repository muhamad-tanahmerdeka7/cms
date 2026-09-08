<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockAdjustment extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_number',
        'transaction_date',
        'product_id',
        'stock_before',
        'stock_after',
        'difference',
        'reason',
        'created_by',
    ];

    protected $casts = [
        'transaction_date' => 'datetime',
        'stock_before' => 'decimal:3',
        'stock_after' => 'decimal:3',
        'difference' => 'decimal:3',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
