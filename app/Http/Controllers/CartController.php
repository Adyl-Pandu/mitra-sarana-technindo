<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $cartItems = [];
        $total = 0;

        foreach ($cart as $productId => $item) {
            $product = Product::find($productId);
            if ($product && $product->is_active) {
                $subtotal = $product->price * $item['quantity'];
                $cartItems[] = [
                    'product' => $product,
                    'quantity' => $item['quantity'],
                    'subtotal' => $subtotal,
                ];
                $total += $subtotal;
            }
        }

        return view('public.cart', compact('cartItems', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'nullable|integer|min:1'
        ]);

        if (!$product->is_active || !$product->isInStock()) {
            return back()->with('error', 'Produk tidak tersedia.');
        }

        $quantity = $request->input('quantity', 1);
        $cart = session()->get('cart', []);

        $existingQty = $cart[$product->id]['quantity'] ?? 0;
        $totalQty = $existingQty + ($existingQty > 0 ? $quantity : 0);

        if ($existingQty > 0) {
            $totalQty = $existingQty + $quantity;
        } else {
            $totalQty = $quantity;
        }

        if ($totalQty > $product->stock) {
            return back()->with('error', "Stok {$product->name} tidak mencukupi. Tersedia: {$product->stock}.");
        }

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] = $totalQty;
        } else {
            $cart[$product->id] = [
                'quantity' => $quantity,
            ];
        }

        session()->put('cart', $cart);

        return back()->with('success', "{$product->name} berhasil ditambahkan ke keranjang.");
    }

    public function update(Request $request, $productId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $product = Product::find($productId);
            if ($product && $request->quantity > $product->stock) {
                return back()->with('error', "Stok {$product->name} tidak mencukupi. Tersedia: {$product->stock}.");
            }
            $cart[$productId]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Keranjang berhasil diperbarui.');
    }

    public function remove($productId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Produk berhasil dihapus dari keranjang.');
    }

    public function count()
    {
        $cart = session()->get('cart', []);
        $count = array_sum(array_column($cart, 'quantity'));
        return response()->json(['count' => $count]);
    }
}
