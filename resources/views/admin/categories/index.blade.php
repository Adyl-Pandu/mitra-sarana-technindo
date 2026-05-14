@extends('layouts.admin')
@section('title', 'Kelola Kategori')

@section('content')
<div class="flex justify-between items-center mb-6">
    <p class="text-sm text-gray-500">{{ $categories->total() }} kategori</p>
    <a href="{{ route('admin.categories.create') }}" class="bg-sky-500 hover:bg-sky-600 text-white px-5 py-2.5 rounded-lg text-sm font-medium transition flex items-center gap-2">
        <i data-lucide="plus" class="w-4 h-4"></i> Tambah Kategori
    </a>
</div>

<div class="bg-white rounded-xl border border-gray-100 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-100">
            <tr>
                <th class="text-left px-5 py-3 font-medium text-gray-600">Kategori</th>
                <th class="text-center px-5 py-3 font-medium text-gray-600">Jumlah Produk</th>
                <th class="text-center px-5 py-3 font-medium text-gray-600">Status</th>
                <th class="text-center px-5 py-3 font-medium text-gray-600">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($categories as $category)
            <tr class="hover:bg-gray-50">
                <td class="px-5 py-3">
                    <p class="font-medium text-navy-900">{{ $category->name }}</p>
                    <p class="text-xs text-gray-400">/produk?category={{ $category->slug }}</p>
                </td>
                <td class="px-5 py-3 text-center">{{ $category->products_count }}</td>
                <td class="px-5 py-3 text-center">
                    <span class="{{ $category->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }} text-xs px-2 py-0.5 rounded-full">
                        {{ $category->is_active ? 'Aktif' : 'Nonaktif' }}
                    </span>
                </td>
                <td class="px-5 py-3 text-center">
                    <div class="flex items-center justify-center gap-1">
                        <a href="{{ route('admin.categories.edit', $category) }}" class="p-1.5 text-gray-400 hover:text-sky-600 transition"><i data-lucide="pencil" class="w-4 h-4"></i></a>
                        @if($category->products_count == 0)
                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?')">
                            @csrf @method('DELETE')
                            <button class="p-1.5 text-gray-400 hover:text-red-600 transition"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                        </form>
                        @endif
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" class="px-5 py-10 text-center text-gray-400">Belum ada kategori.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="px-5 py-4 border-t border-gray-100">{{ $categories->links() }}</div>
</div>
@endsection
