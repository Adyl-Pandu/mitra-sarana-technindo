@extends('layouts.admin')
@section('title', 'Kelola Pesanan')

@section('content')
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
    <form action="{{ route('admin.orders.index') }}" method="GET" class="flex flex-wrap gap-2">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari no. pesanan / nama..."
               class="border border-gray-200 rounded-lg px-4 py-2 text-sm outline-none focus:ring-2 focus:ring-navy-300 w-48">
        <select name="status" onchange="this.form.submit()" class="border border-gray-200 rounded-lg px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-navy-300">
            <option value="">Semua Status</option>
            @foreach(\App\Models\Order::STATUS_LABELS as $key => $label)
                <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>
        <input type="date" name="date_from" value="{{ request('date_from') }}" class="border border-gray-200 rounded-lg px-3 py-2 text-sm outline-none">
        <input type="date" name="date_to" value="{{ request('date_to') }}" class="border border-gray-200 rounded-lg px-3 py-2 text-sm outline-none">
        <button type="submit" class="bg-navy-800 text-white px-4 py-2 rounded-lg text-sm hover:bg-navy-900 transition">Filter</button>
    </form>
</div>

<div class="bg-white rounded-xl border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="text-left px-5 py-3 font-medium text-gray-600">No. Pesanan</th>
                    <th class="text-left px-5 py-3 font-medium text-gray-600">Pelanggan</th>
                    <th class="text-right px-5 py-3 font-medium text-gray-600">Total</th>
                    <th class="text-center px-5 py-3 font-medium text-gray-600">Status</th>
                    <th class="text-center px-5 py-3 font-medium text-gray-600">Tanggal</th>
                    <th class="text-center px-5 py-3 font-medium text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($orders as $order)
                <tr class="hover:bg-gray-50">
                    <td class="px-5 py-3">
                        <a href="{{ route('admin.orders.show', $order) }}" class="font-medium text-sky-600 hover:underline">{{ $order->order_number }}</a>
                    </td>
                    <td class="px-5 py-3">
                        <p class="text-navy-900">{{ $order->customer_name }}</p>
                        <p class="text-xs text-gray-400">{{ $order->customer_phone }}</p>
                    </td>
                    <td class="px-5 py-3 text-right font-medium text-navy-800">{{ $order->formatted_total }}</td>
                    <td class="px-5 py-3 text-center">
                        <span class="inline-block px-2.5 py-0.5 text-xs font-medium rounded-full
                            @switch($order->status_color)
                                @case('yellow') bg-yellow-100 text-yellow-700 @break
                                @case('blue') bg-blue-100 text-blue-700 @break
                                @case('indigo') bg-indigo-100 text-indigo-700 @break
                                @case('green') bg-green-100 text-green-700 @break
                                @case('red') bg-red-100 text-red-700 @break
                            @endswitch">
                            {{ $order->status_label }}
                        </span>
                    </td>
                    <td class="px-5 py-3 text-center text-gray-500 text-xs">{{ $order->created_at->format('d M Y H:i') }}</td>
                    <td class="px-5 py-3 text-center">
                        <a href="{{ route('admin.orders.show', $order) }}" class="p-1.5 text-gray-400 hover:text-sky-600 transition inline-block"><i data-lucide="eye" class="w-4 h-4"></i></a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="px-5 py-10 text-center text-gray-400">Belum ada pesanan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-5 py-4 border-t border-gray-100">{{ $orders->links() }}</div>
</div>
@endsection
