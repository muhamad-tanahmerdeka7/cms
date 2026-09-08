<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  use HasFactory;

    protected $fillable = [
        'category_id',
        'unit_id',
        'code',
        'name',
        'minimum_stock',
        'maximum_stock',
        'description',
        'is_active',
    ];

    protected $casts = [
        'minimum_stock' => 'decimal:3',
        'maximum_stock' => 'decimal:3',
        'is_active' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function stockTransactions()
    {
        return $this->hasMany(StockTransaction::class);
    }

    public function stockInItems()
    {
        return $this->hasMany(StockInItem::class);
    }

    public function stockOutItems()
    {
        return $this->hasMany(StockOutItem::class);
    }

    public function stockAdjustments()
    {
        return $this->hasMany(StockAdjustment::class);
    }

    // Helper untuk mendapatkan stok terkini (dari transaksi terakhir)
    public function getCurrentStockAttribute()
    {
        $lastTransaction = $this->stockTransactions()->latest('id')->first();
        return $lastTransaction ? $lastTransaction->stock_after : 0;
    }

    // Helper: apakah stok di bawah minimum
    public function getIsLowStockAttribute()
    {
        return $this->current_stock < $this->minimum_stock;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeLowStock($query)
    {
        // Menggunakan subquery untuk menghitung stok terkini
        return $query->whereHas('stockTransactions', function ($q) {
            $q->select('stock_after')
                ->whereColumn('product_id', 'products.id')
                ->latest('id')
                ->limit(1)
                ->havingRaw('stock_after < products.minimum_stock');
        })->orWhereDoesntHave('stockTransactions');
    }
}