<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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

        // Generate idempotency token
        session()->put('checkout_token', Str::random(32));

        return view('public.checkout', compact('cartItems', 'total'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'customer_name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s\.\',\-]+$/'],
            'customer_phone' => 'required|digits_between:11,12',
            'customer_address' => 'required|string',
            'customer_email' => 'required|email|max:255',
            'notes' => 'nullable|string|max:500',
            'checkout_token' => 'required|string',
        ], [
            'customer_name.required' => 'Nama lengkap wajib diisi.',
            'customer_name.regex' => 'Nama lengkap hanya boleh berisi huruf.',
            'customer_phone.required' => 'Nomor telepon wajib diisi.',
            'customer_phone.digits_between' => 'Nomor telepon harus 11-12 digit angka.',
            'customer_address.required' => 'Alamat pengiriman wajib diisi.',
            'customer_email.required' => 'Email wajib diisi.',
            'customer_email.email' => 'Format email tidak valid.',
            'checkout_token.required' => 'Token checkout tidak valid.',
        ]);

        // Idempotency check — prevent duplicate submission
        $token = $request->checkout_token;
        $sessionToken = session()->pull('checkout_token');
        if (!$sessionToken || $sessionToken !== $token) {
            return redirect()->route('cart.index')->with('error', 'Pesanan sudah diproses sebelumnya.');
        }

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja Anda kosong.');
        }

        // Validate stock availability before processing
        $products = Product::whereIn('id', array_keys($cart))->get()->keyBy('id');
        foreach ($cart as $productId => $item) {
            $product = $products->get($productId);
            if (!$product || !$product->is_active) {
                return back()->with('error', "Produk dengan ID {$productId} tidak tersedia.");
            }
            if ($product->stock < $item['quantity']) {
                return back()->with('error', "Stok {$product->name} tidak mencukupi (tersedia: {$product->stock}).");
            }
        }

        $order = DB::transaction(function () use ($request, $cart, $products) {
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
                $product = $products->get($productId);
                if (!$product || !$product->is_active) {
                    continue;
                }

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

            $order->update([
                'total_amount' => $total,
            ]);

            // Attach WhatsApp items to order for use outside transaction
            $order->whatsappItems = $whatsappItems;

            return $order;
        });

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
        $message .= implode("\n", $order->whatsappItems);
        $message .= "\n\n💰 *Total: Rp " . number_format($order->total_amount, 0, ',', '.') . "*\n";
        if ($request->notes) {
            $message .= "\n📝 Catatan: {$request->notes}\n";
        }
        $message .= "\n━━━━━━━━━━━━━━━\n";
        $message .= "Terima kasih telah memesan di PT Mitra Sarana Technindo.";

        $whatsappUrl = 'https://wa.me/' . config('app.whatsapp_number') . '?text=' . urlencode($message);

        return redirect()->route('checkout.success', [
            'order' => $order->order_number,
            'wa' => $whatsappUrl,
        ]);
    }

    public function success(Request $request)
    {
        $orderNumber = $request->query('order');
        $whatsappUrl = $request->query('wa');

        return view('public.checkout-success', compact('orderNumber', 'whatsappUrl'));
    }
}
