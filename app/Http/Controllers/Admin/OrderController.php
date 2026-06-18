<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('items');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                  ->orWhere('customer_name', 'like', "%{$search}%")
                  ->orWhere('customer_phone', 'like', "%{$search}%");
            });
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $orders = $query->latest()->paginate(15)->appends($request->query());

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('items.product');
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:menunggu_konfirmasi,diproses,dikirim,selesai,dibatalkan',
        ]);

        $oldStatus = $order->status;
        $newStatus = $request->status;

        if ($oldStatus === $newStatus) {
            return back()->with('error', 'Status pesanan sudah ' . ($request->status) . '.');
        }

        $timestamps = [];
        switch ($newStatus) {
            case 'diproses':
                $timestamps['confirmed_at'] = now();
                break;
            case 'dikirim':
                $timestamps['shipped_at'] = now();
                break;
            case 'selesai':
                $timestamps['completed_at'] = now();
                break;
        }

        $order->load('items.product');

        try {
            DB::transaction(function () use ($order, $newStatus, $timestamps) {
            $order->update(array_merge(['status' => $newStatus], $timestamps));

            // Cancel → restore stock if already reduced
            if ($newStatus === 'dibatalkan' && $order->stock_reduced) {
                foreach ($order->items as $item) {
                    if ($item->product) {
                        $stockBefore = $item->product->stock;
                        $item->product->increment('stock', $item->quantity);

                        StockMovement::create([
                            'product_id' => $item->product_id,
                            'type' => 'masuk',
                            'quantity' => $item->quantity,
                            'stock_before' => $stockBefore,
                            'stock_after' => $stockBefore + $item->quantity,
                            'reference_type' => 'order',
                            'reference_id' => $order->id,
                            'description' => 'Pembatalan pesanan #' . $order->order_number,
                            'created_by' => auth()->id(),
                        ]);
                    }
                }
                $order->update(['stock_reduced' => false]);
            }

            // Confirm/ship/complete → decrement stock if not yet reduced
            if (in_array($newStatus, ['diproses', 'dikirim', 'selesai']) && !$order->stock_reduced) {
                foreach ($order->items as $item) {
                    if ($item->product) {
                        if ($item->product->stock < $item->quantity) {
                            throw new \Exception("Stok {$item->product->name} tidak mencukupi.");
                        }

                        $stockBefore = $item->product->stock;
                        $item->product->decrement('stock', $item->quantity);

                        StockMovement::create([
                            'product_id' => $item->product_id,
                            'type' => 'keluar',
                            'quantity' => $item->quantity,
                            'stock_before' => $stockBefore,
                            'stock_after' => $stockBefore - $item->quantity,
                            'reference_type' => 'order',
                            'reference_id' => $order->id,
                            'description' => 'Konfirmasi pesanan #' . $order->order_number,
                            'created_by' => auth()->id(),
                        ]);
                    }
                }
                $order->update(['stock_reduced' => true]);
            }
            });
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }

        return back()->with('success', 'Status pesanan berhasil diperbarui.');
    }
}
