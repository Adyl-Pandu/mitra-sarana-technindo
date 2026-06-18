@extends('layouts.app')

@section('meta_title', $metaTitle)
@section('meta_description', $metaDescription)

@section('content')
<div class="bg-white border-b">
    <div class="max-w-7xl mx-auto px-4 py-4">
        <nav class="flex items-center gap-2 text-sm text-gray-500">
            <a href="{{ route('home') }}" class="hover:text-navy-700">Beranda</a>
            <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
            <span class="text-navy-800 font-medium">Katalog Produk</span>
            @if(request('category'))
                <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                <span class="text-navy-800 font-medium">{{ $categories->firstWhere('slug', request('category'))?->name }}</span>
            @endif
        </nav>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex flex-col lg:flex-row gap-8">
        {{-- Sidebar Filters --}}
        <aside class="lg:w-64 shrink-0">
            {{-- Search --}}
            <form action="{{ route('products.index') }}" method="GET" class="mb-6">
                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Cari produk..."
                           class="w-full border border-gray-200 rounded-lg pl-10 pr-4 py-2.5 text-sm focus:ring-2 focus:ring-navy-300 focus:border-navy-400 outline-none">
                    <i data-lucide="search" class="w-4 h-4 text-gray-400 absolute left-3 top-3"></i>
                </div>
            </form>

            {{-- Categories --}}
            <div class="bg-white rounded-xl border border-gray-100 p-5">
                <h3 class="font-semibold text-navy-900 mb-4 font-heading">Kategori</h3>
                <ul class="space-y-1">
                    <li>
                        <a href="{{ route('products.index') }}"
                           class="block px-3 py-2 rounded-lg text-sm transition {{ !request('category') ? 'bg-navy-100 text-navy-800 font-medium' : 'text-gray-600 hover:bg-gray-50' }}">
                            Semua Produk
                        </a>
                    </li>
                    @foreach($categories as $category)
                    <li>
                        <a href="{{ route('products.index', ['category' => $category->slug]) }}"
                           class="flex justify-between items-center px-3 py-2 rounded-lg text-sm transition {{ request('category') == $category->slug ? 'bg-navy-100 text-navy-800 font-medium' : 'text-gray-600 hover:bg-gray-50' }}">
                            {{ $category->name }}
                            <span class="text-xs text-gray-400">{{ $category->active_products_count }}</span>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </aside>

        {{-- Product Grid --}}
        <div class="flex-1">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                <p class="text-sm text-gray-500">
                    Menampilkan <strong>{{ $products->total() }}</strong> produk
                    @if(request('search'))
                        untuk "<em>{{ request('search') }}</em>"
                    @endif
                </p>
                <select onchange="window.location.href=this.value"
                        class="text-sm border border-gray-200 rounded-lg px-3 py-2 outline-none focus:ring-2 focus:ring-navy-300">
                    <option value="{{ route('products.index', array_merge(request()->query(), ['sort' => 'newest'])) }}" {{ request('sort', 'newest') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                    <option value="{{ route('products.index', array_merge(request()->query(), ['sort' => 'price_low'])) }}" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Harga Terendah</option>
                    <option value="{{ route('products.index', array_merge(request()->query(), ['sort' => 'price_high'])) }}" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Harga Tertinggi</option>
                    <option value="{{ route('products.index', array_merge(request()->query(), ['sort' => 'name'])) }}" {{ request('sort') == 'name' ? 'selected' : '' }}>Nama A-Z</option>
                </select>
            </div>

            @if($products->count())
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 lg:gap-6">
                    @foreach($products as $product)
                        @include('components.product-card', ['product' => $product])
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $products->links() }}
                </div>
            @else
                <div class="text-center py-20">
                    <i data-lucide="search-x" class="w-16 h-16 text-gray-300 mx-auto mb-4"></i>
                    <h3 class="text-lg font-semibold text-gray-700 mb-2 font-heading">Produk Tidak Ditemukan</h3>
                    <p class="text-gray-500 mb-6">Coba gunakan kata kunci lain atau lihat semua produk.</p>
                    <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 bg-navy-800 hover:bg-navy-900 text-white px-6 py-2.5 rounded-lg text-sm transition">
                        Lihat Semua Produk
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
