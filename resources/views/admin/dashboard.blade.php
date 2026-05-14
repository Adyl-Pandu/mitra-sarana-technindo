@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
{{-- Stats Cards --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <div class="bg-white rounded-xl p-5 border border-gray-100">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                <i data-lucide="package" class="w-5 h-5 text-blue-600"></i>
            </div>
        </div>
        <p class="text-2xl font-bold text-navy-900">{{ $totalProducts }}</p>
        <p class="text-sm text-gray-500">Total Produk</p>
    </div>
    <div class="bg-white rounded-xl p-5 border border-gray-100">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                <i data-lucide="shopping-bag" class="w-5 h-5 text-green-600"></i>
            </div>
        </div>
        <p class="text-2xl font-bold text-navy-900">{{ $totalOrders }}</p>
        <p class="text-sm text-gray-500">Total Pesanan</p>
    </div>
    <div class="bg-white rounded-xl p-5 border border-gray-100">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 bg-amber-100 rounded-lg flex items-center justify-center">
                <i data-lucide="alert-circle" class="w-5 h-5 text-amber-600"></i>
            </div>
        </div>
        <p class="text-2xl font-bold text-navy-900">{{ $pendingOrders }}</p>
        <p class="text-sm text-gray-500">Menunggu Konfirmasi</p>
    </div>
    <div class="bg-white rounded-xl p-5 border border-gray-100">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center">
                <i data-lucide="banknote" class="w-5 h-5 text-emerald-600"></i>
            </div>
        </div>
        <p class="text-2xl font-bold text-navy-900">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
        <p class="text-sm text-gray-500">Total Pendapatan</p>
    </div>
</div>

<div class="grid lg:grid-cols-3 gap-6">
    {{-- Recent Orders --}}
    <div class="lg:col-span-2 bg-white rounded-xl border border-gray-100">
        <div class="flex justify-between items-center px-5 py-4 border-b border-gray-100">
            <h3 class="font-semibold text-navy-900">Pesanan Terbaru</h3>
            <a href="{{ route('admin.orders.index') }}" class="text-sm text-sky-600 hover:underline">Lihat Semua</a>
        </div>
        <div class="divide-y divide-gray-50">
            @forelse($recentOrders as $order)
            <div class="px-5 py-3 flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-navy-900">{{ $order->order_number }}</p>
                    <p class="text-xs text-gray-500">{{ $order->customer_name }} &middot; {{ $order->created_at->diffForHumans() }}</p>
                </div>
                <div class="text-right">
                    <p class="text-sm font-semibold text-navy-800">{{ $order->formatted_total }}</p>
                    <span class="inline-block px-2 py-0.5 text-[10px] font-medium rounded-full
                        @switch($order->status_color)
                            @case('yellow') bg-yellow-100 text-yellow-700 @break
                            @case('blue') bg-blue-100 text-blue-700 @break
                            @case('indigo') bg-indigo-100 text-indigo-700 @break
                            @case('green') bg-green-100 text-green-700 @break
                            @case('red') bg-red-100 text-red-700 @break
                        @endswitch">
                        {{ $order->status_label }}
                    </span>
                </div>
            </div>
            @empty
            <div class="px-5 py-8 text-center text-gray-400 text-sm">Belum ada pesanan.</div>
            @endforelse
        </div>
    </div>

    {{-- Top Products --}}
    <div class="bg-white rounded-xl border border-gray-100">
        <div class="px-5 py-4 border-b border-gray-100">
            <h3 class="font-semibold text-navy-900">Produk Paling Dilihat</h3>
        </div>
        <div class="divide-y divide-gray-50">
            @foreach($topProducts as $product)
            <div class="px-5 py-3 flex items-center justify-between">
                <p class="text-sm text-navy-800 truncate flex-1 mr-3">{{ $product->name }}</p>
                <span class="text-xs text-gray-400 shrink-0">{{ $product->views }} views</span>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
