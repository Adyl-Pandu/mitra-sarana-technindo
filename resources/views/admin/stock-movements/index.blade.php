@extends('layouts.admin')
@section('title', 'Riwayat Stok')

@section('content')
<div class="bg-white rounded-xl border border-gray-100 p-5 mb-6">
    <form action="{{ route('admin.stock-movements.index') }}" method="GET" class="flex flex-wrap items-end gap-4">
        <div>
            <label class="block text-xs font-medium text-gray-500 mb-1">Produk</label>
            <select name="product_id" class="border border-gray-200 rounded-lg px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-navy-300 min-w-48">
                <option value="">Semua Produk</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}" {{ request('product_id') == $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-xs font-medium text-gray-500 mb-1">Tipe</label>
            <select name="type" class="border border-gray-200 rounded-lg px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-navy-300">
                <option value="">Semua Tipe</option>
                <option value="masuk" {{ request('type') == 'masuk' ? 'selected' : '' }}>Masuk</option>
                <option value="keluar" {{ request('type') == 'keluar' ? 'selected' : '' }}>Keluar</option>
            </select>
        </div>
        <div>
            <label class="block text-xs font-medium text-gray-500 mb-1">Dari Tanggal</label>
            <input type="date" name="date_from" value="{{ request('date_from') }}" class="border border-gray-200 rounded-lg px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-navy-300">
        </div>
        <div>
            <label class="block text-xs font-medium text-gray-500 mb-1">Sampai Tanggal</label>
            <input type="date" name="date_to" value="{{ request('date_to') }}" class="border border-gray-200 rounded-lg px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-navy-300">
        </div>
        <button type="submit" class="bg-navy-800 text-white px-5 py-2 rounded-lg text-sm hover:bg-navy-900 transition">Filter</button>
        <a href="{{ route('admin.stock-movements.index') }}" class="text-sm text-gray-500 hover:text-navy-800 px-3 py-2">Reset</a>
    </form>
</div>

<div class="bg-white rounded-xl border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="text-left px-5 py-3 font-medium text-gray-600">Tanggal</th>
                    <th class="text-left px-5 py-3 font-medium text-gray-600">Produk</th>
                    <th class="text-center px-5 py-3 font-medium text-gray-600">Tipe</th>
                    <th class="text-right px-5 py-3 font-medium text-gray-600">Stok Awal</th>
                    <th class="text-right px-5 py-3 font-medium text-gray-600">Qty</th>
                    <th class="text-right px-5 py-3 font-medium text-gray-600">Stok Akhir</th>
                    <th class="text-left px-5 py-3 font-medium text-gray-600">Keterangan</th>
                    <th class="text-center px-5 py-3 font-medium text-gray-600">Oleh</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($movements as $m)
                <tr class="hover:bg-gray-50">
                    <td class="px-5 py-3 text-gray-500 text-xs">{{ $m->created_at->format('d M Y H:i') }}</td>
                    <td class="px-5 py-3">
                        <a href="{{ route('admin.products.edit', $m->product_id) }}" class="text-navy-900 hover:text-sky-600 font-medium">{{ $m->product->name ?? '—' }}</a>
                    </td>
                    <td class="px-5 py-3 text-center">
                        @if($m->type === 'masuk')
                            <span class="inline-flex items-center gap-1 text-xs font-medium text-green-700 bg-green-50 border border-green-200 rounded-full px-2.5 py-0.5">
                                <i data-lucide="arrow-down" class="w-3 h-3"></i> Masuk
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 text-xs font-medium text-red-700 bg-red-50 border border-red-200 rounded-full px-2.5 py-0.5">
                                <i data-lucide="arrow-up" class="w-3 h-3"></i> Keluar
                            </span>
                        @endif
                    </td>
                    <td class="px-5 py-3 text-right text-navy-900">{{ $m->stock_before }}</td>
                    <td class="px-5 py-3 text-right font-semibold {{ $m->type === 'masuk' ? 'text-green-600' : 'text-red-600' }}">{{ ($m->type === 'masuk' ? '+' : '-') . $m->quantity }}</td>
                    <td class="px-5 py-3 text-right text-navy-900">{{ $m->stock_after }}</td>
                    <td class="px-5 py-3 text-gray-600 max-w-64 truncate">{{ $m->description }}</td>
                    <td class="px-5 py-3 text-center text-xs text-gray-500">{{ $m->creator->name ?? 'Sistem' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-5 py-12 text-center text-gray-400">
                        <i data-lucide="package" class="w-8 h-8 mx-auto mb-2 text-gray-300"></i>
                        <p>Belum ada riwayat pergerakan stok.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-5 py-3 border-t border-gray-100">
        {{ $movements->links() }}
    </div>
</div>
@endsection
