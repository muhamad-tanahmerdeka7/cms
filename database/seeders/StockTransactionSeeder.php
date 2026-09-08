<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\StockTransaction;
use App\Models\User;
use Carbon\Carbon;

class StockTransactionSeeder extends Seeder
{
    public function run()
    {
        $user = User::first();
        $products = Product::all();

        foreach ($products as $product) {
            // Buat transaksi masuk awal (stock awal)
            $quantity = rand(100, 500);
            $stockBefore = 0;
            $stockAfter = $quantity;

            StockTransaction::create([
                'product_id' => $product->id,
                'type' => 'in',
                'reference_type' => 'initial_stock',
                'reference_id' => null,
                'quantity' => $quantity,
                'stock_before' => $stockBefore,
                'stock_after' => $stockAfter,
                'transaction_date' => Carbon::now()->subDays(rand(1, 30)),
                'notes' => 'Stok awal',
                'created_by' => $user->id,
            ]);

            // Tambah beberapa transaksi masuk & keluar acak
            for ($i = 0; $i < rand(3, 8); $i++) {
                $type = rand(0, 1) ? 'in' : 'out';
                $qty = rand(10, 50);
                $currentStock = $product->stockTransactions()->latest('id')->value('stock_after') ?? 0;

                if ($type === 'out' && $currentStock < $qty) {
                    continue; // skip jika stok tidak cukup
                }

                $newStock = $type === 'in' ? $currentStock + $qty : $currentStock - $qty;

                StockTransaction::create([
                    'product_id' => $product->id,
                    'type' => $type,
                    'reference_type' => 'test',
                    'reference_id' => null,
                    'quantity' => $qty,
                    'stock_before' => $currentStock,
                    'stock_after' => $newStock,
                    'transaction_date' => Carbon::now()->subDays(rand(0, 30)),
                    'notes' => "Transaksi $type test",
                    'created_by' => $user->id,
                ]);
            }
        }
    }
}
