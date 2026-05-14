<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja Anda kosong.');
        }

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

        return view('public.checkout', compact('cartItems', 'total'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'required|string',
            'customer_email' => 'nullable|email|max:255',
            'notes' => 'nullable|string|max:500',
        ], [
            'customer_name.required' => 'Nama lengkap wajib diisi.',
            'customer_phone.required' => 'Nomor telepon wajib diisi.',
            'customer_address.required' => 'Alamat pengiriman wajib diisi.',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja Anda kosong.');
        }

        // Create Order
        $order = Order::create([
            'order_number' => Order::generateOrderNumber(),
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'customer_address' => $request->customer_address,
            'customer_email' => $request->customer_email,
            'notes' => $request->notes,
            'total_amount' => 0,
            'status' => 'menunggu_konfirmasi',
        ]);

        $total = 0;
        $whatsappItems = [];

        foreach ($cart as $productId => $item) {
            $product = Product::find($productId);
            if ($product && $product->is_active) {
                $subtotal = $product->price * $item['quantity'];
                $total += $subtotal;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'product_price' => $product->price,
                    'quantity' => $item['quantity'],
                    'subtotal' => $subtotal,
                ]);

                $whatsappItems[] = "• {$product->name} (x{$item['quantity']}) - Rp " . number_format($subtotal, 0, ',', '.');
            }
        }

        $order->update(['total_amount' => $total]);

        // Clear cart
        session()->forget('cart');

        // Build WhatsApp message
        $message = "🛒 *PESANAN BARU*\n";
        $message .= "━━━━━━━━━━━━━━━\n";
        $message .= "📋 No. Pesanan: *{$order->order_number}*\n\n";
        $message .= "👤 *Data Pemesan:*\n";
        $message .= "Nama: {$request->customer_name}\n";
        $message .= "Telepon: {$request->customer_phone}\n";
        $message .= "Alamat: {$request->customer_address}\n";
        if ($request->customer_email) {
            $message .= "Email: {$request->customer_email}\n";
        }
        $message .= "\n📦 *Detail Pesanan:*\n";
        $message .= implode("\n", $whatsappItems);
        $message .= "\n\n💰 *Total: Rp " . number_format($total, 0, ',', '.') . "*\n";
        if ($request->notes) {
            $message .= "\n📝 Catatan: {$request->notes}\n";
        }
        $message .= "\n━━━━━━━━━━━━━━━\n";
        $message .= "Terima kasih telah memesan di PT Mitra Sarana Technindo.";

        $whatsappNumber = config('app.whatsapp_number', env('WHATSAPP_NUMBER',''));
        $whatsappUrl = 'https://wa.me/' . $whatsappNumber . '?text=' . urlencode($message);

        return redirect()->route('checkout.success', [
            'order' => $order->order_number,
            'wa' => $whatsappUrl
        ]);
    }

    public function success(Request $request)
    {
        $orderNumber = $request->query('order');
        $whatsappUrl = $request->query('wa');

        return view('public.checkout-success', compact('orderNumber', 'whatsappUrl'));
    }
}
