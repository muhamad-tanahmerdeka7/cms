<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockIn extends Model
{
   use HasFactory;

    protected $fillable = [
        'transaction_number',
        'supplier_id',
        'transaction_date',
        'notes',
        'created_by',
    ];

    protected $casts = [
        'transaction_date' => 'datetime',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function items()
    {
        return $this->hasMany(StockInItem::class);
    }

    // Helper: total item dalam transaksi
    public function getTotalItemsAttribute()
    {
        return $this->items->sum('quantity');
    }

    // Helper: total harga
    public function getTotalPriceAttribute()
    {
        return $this->items->sum('total_price');
    }
}
