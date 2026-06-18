<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Database\Seeder;

class StockMovementSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::all();

        foreach ($products as $product) {
            StockMovement::create([
                'product_id' => $product->id,
                'type' => 'masuk',
                'quantity' => $product->stock,
                'stock_before' => 0,
                'stock_after' => $product->stock,
                'reference_type' => 'system',
                'reference_id' => null,
                'description' => 'Saldo awal stok',
            ]);
        }

        $this->command->info('Initial stock records created for ' . $products->count() . ' products.');
    }
}
