<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

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

        $timestamps = [];
        switch ($request->status) {
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

        $order->update(array_merge(['status' => $request->status], $timestamps));

        return back()->with('success', 'Status pesanan berhasil diperbarui.');
    }
}
