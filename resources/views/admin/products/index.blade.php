@extends('layouts.admin')
@section('title', 'Kelola Produk')

@section('content')
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
    <form action="{{ route('admin.products.index') }}" method="GET" class="flex gap-2 flex-1 max-w-lg">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk..."
               class="flex-1 border border-gray-200 rounded-lg px-4 py-2 text-sm outline-none focus:ring-2 focus:ring-navy-300">
        <button type="submit" class="bg-navy-800 text-white px-4 py-2 rounded-lg text-sm hover:bg-navy-900 transition">Cari</button>
    </form>
    <a href="{{ route('admin.products.create') }}" class="bg-sky-500 hover:bg-sky-600 text-white px-5 py-2.5 rounded-lg text-sm font-medium transition flex items-center gap-2 shrink-0">
        <i data-lucide="plus" class="w-4 h-4"></i> Tambah Produk
    </a>
</div>

<div class="bg-white rounded-xl border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="text-left px-5 py-3 font-medium text-gray-600">Produk</th>
                    <th class="text-left px-5 py-3 font-medium text-gray-600">Kategori</th>
                    <th class="text-right px-5 py-3 font-medium text-gray-600">Harga</th>
                    <th class="text-center px-5 py-3 font-medium text-gray-600">Stok</th>
                    <th class="text-center px-5 py-3 font-medium text-gray-600">Status</th>
                    <th class="text-center px-5 py-3 font-medium text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($products as $product)
                <tr class="hover:bg-gray-50">
                    <td class="px-5 py-3">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-navy-50 rounded-lg overflow-hidden shrink-0">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center"><i data-lucide="package" class="w-5 h-5 text-navy-200"></i></div>
                                @endif
                            </div>
                            <div>
                                <p class="font-medium text-navy-900">{{ $product->name }}</p>
                                <p class="text-xs text-gray-400">SKU: {{ $product->sku ?? '-' }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-5 py-3 text-gray-600">{{ $product->category->name }}</td>
                    <td class="px-5 py-3 text-right font-medium text-navy-800">{{ $product->formatted_price }}</td>
                    <td class="px-5 py-3 text-center">
                        <span class="{{ $product->stock > 0 ? 'text-green-600' : 'text-red-500' }} font-medium">{{ $product->stock }}</span>
                    </td>
                    <td class="px-5 py-3 text-center">
                        @if($product->is_active)
                            <span class="bg-green-100 text-green-700 text-xs px-2 py-0.5 rounded-full">Aktif</span>
                        @else
                            <span class="bg-gray-100 text-gray-500 text-xs px-2 py-0.5 rounded-full">Nonaktif</span>
                        @endif
                    </td>
                    <td class="px-5 py-3 text-center">
                        <div class="flex items-center justify-center gap-1">
                            <a href="{{ route('admin.products.edit', $product) }}" class="p-1.5 text-gray-400 hover:text-sky-600 transition" title="Edit">
                                <i data-lucide="pencil" class="w-4 h-4"></i>
                            </a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Hapus produk ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-1.5 text-gray-400 hover:text-red-600 transition" title="Hapus">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="px-5 py-10 text-center text-gray-400">Belum ada produk.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-5 py-4 border-t border-gray-100">{{ $products->links() }}</div>
</div>
@endsection
