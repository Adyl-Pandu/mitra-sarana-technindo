@extends('layouts.admin')
@section('title', 'Laporan Penjualan')

@section('content')
{{-- Date Filter --}}
<form action="{{ route('admin.reports.index') }}" method="GET" class="bg-white rounded-xl border border-gray-100 p-5 mb-6 flex flex-wrap items-end gap-4">
    <div>
        <label class="block text-xs font-medium text-gray-500 mb-1">Dari Tanggal</label>
        <input type="date" name="date_from" value="{{ $dateFrom }}" class="border border-gray-200 rounded-lg px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-navy-300">
    </div>
    <div>
        <label class="block text-xs font-medium text-gray-500 mb-1">Sampai Tanggal</label>
        <input type="date" name="date_to" value="{{ $dateTo }}" class="border border-gray-200 rounded-lg px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-navy-300">
    </div>
    <button type="submit" class="bg-navy-800 hover:bg-navy-900 text-white px-5 py-2 rounded-lg text-sm transition">Tampilkan</button>
</form>

{{-- Summary Cards --}}
<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
    <div class="bg-white rounded-xl border border-gray-100 p-5">
        <p class="text-sm text-gray-500 mb-1">Total Pendapatan</p>
        <p class="text-2xl font-bold text-navy-900">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
    </div>
    <div class="bg-white rounded-xl border border-gray-100 p-5">
        <p class="text-sm text-gray-500 mb-1">Jumlah Pesanan Selesai</p>
        <p class="text-2xl font-bold text-navy-900">{{ $totalOrders }}</p>
    </div>
    <div class="bg-white rounded-xl border border-gray-100 p-5">
        <p class="text-sm text-gray-500 mb-1">Rata-rata per Pesanan</p>
        <p class="text-2xl font-bold text-navy-900">Rp {{ number_format($averageOrder, 0, ',', '.') }}</p>
    </div>
</div>

<div class="grid lg:grid-cols-2 gap-6 mb-6">
    {{-- Top Products --}}
    <div class="bg-white rounded-xl border border-gray-100 overflow-hidden">
        <div class="px-5 py-4 border-b border-gray-100">
            <h3 class="font-semibold text-navy-900">Produk Terlaris</h3>
        </div>
        <table class="w-full text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="text-left px-5 py-2.5 font-medium text-gray-600">Produk</th>
                    <th class="text-center px-4 py-2.5 font-medium text-gray-600">Qty Terjual</th>
                    <th class="text-right px-5 py-2.5 font-medium text-gray-600">Pendapatan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($topProducts as $item)
                <tr>
                    <td class="px-5 py-2.5 text-navy-900">{{ $item->product_name }}</td>
                    <td class="px-4 py-2.5 text-center">{{ $item->total_qty }}</td>
                    <td class="px-5 py-2.5 text-right font-medium">Rp {{ number_format($item->total_revenue, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr><td colspan="3" class="px-5 py-8 text-center text-gray-400">Belum ada data.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Daily Sales --}}
    <div class="bg-white rounded-xl border border-gray-100 overflow-hidden">
        <div class="px-5 py-4 border-b border-gray-100">
            <h3 class="font-semibold text-navy-900">Penjualan Harian</h3>
        </div>
        <div class="max-h-80 overflow-y-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 sticky top-0">
                    <tr>
                        <th class="text-left px-5 py-2.5 font-medium text-gray-600">Tanggal</th>
                        <th class="text-center px-4 py-2.5 font-medium text-gray-600">Pesanan</th>
                        <th class="text-right px-5 py-2.5 font-medium text-gray-600">Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($dailySales as $day)
                    <tr>
                        <td class="px-5 py-2.5 text-navy-900">{{ \Carbon\Carbon::parse($day->date)->format('d M Y') }}</td>
                        <td class="px-4 py-2.5 text-center">{{ $day->count }}</td>
                        <td class="px-5 py-2.5 text-right font-medium">Rp {{ number_format($day->total, 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="3" class="px-5 py-8 text-center text-gray-400">Belum ada data.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- All Orders in Period --}}
<div class="bg-white rounded-xl border border-gray-100 overflow-hidden">
    <div class="px-5 py-4 border-b border-gray-100">
        <h3 class="font-semibold text-navy-900">Daftar Pesanan Selesai</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="text-left px-5 py-2.5 font-medium text-gray-600">No. Pesanan</th>
                    <th class="text-left px-5 py-2.5 font-medium text-gray-600">Pelanggan</th>
                    <th class="text-center px-4 py-2.5 font-medium text-gray-600">Item</th>
                    <th class="text-right px-5 py-2.5 font-medium text-gray-600">Total</th>
                    <th class="text-center px-5 py-2.5 font-medium text-gray-600">Tanggal</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($orders as $order)
                <tr class="hover:bg-gray-50">
                    <td class="px-5 py-2.5">
                        <a href="{{ route('admin.orders.show', $order) }}" class="text-sky-600 hover:underline font-medium">{{ $order->order_number }}</a>
                    </td>
                    <td class="px-5 py-2.5 text-navy-900">{{ $order->customer_name }}</td>
                    <td class="px-4 py-2.5 text-center">{{ $order->items->count() }}</td>
                    <td class="px-5 py-2.5 text-right font-medium text-navy-800">{{ $order->formatted_total }}</td>
                    <td class="px-5 py-2.5 text-center text-gray-500 text-xs">{{ $order->created_at->format('d M Y') }}</td>
                </tr>
                @empty
                <tr><td colspan="5" class="px-5 py-10 text-center text-gray-400">Tidak ada pesanan selesai pada periode ini.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
