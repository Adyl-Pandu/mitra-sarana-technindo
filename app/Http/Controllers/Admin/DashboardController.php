<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalRevenue = Order::where('status', 'selesai')->sum('total_amount');
        $pendingOrders = Order::where('status', 'menunggu_konfirmasi')->count();

        $recentOrders = Order::with('items')
            ->latest()
            ->take(5)
            ->get();

        $monthlySales = Order::where('status', 'selesai')
            ->whereYear('created_at', now()->year)
            ->selectRaw('MONTH(created_at) as month, SUM(total_amount) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('total', 'month')
            ->toArray();

        $topProducts = Product::orderBy('views', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalProducts', 'totalOrders', 'totalRevenue', 'pendingOrders',
            'recentOrders', 'monthlySales', 'topProducts'
        ));
    }
}
