@extends('layouts.app')

@section('meta_title', 'Keranjang Belanja - PT Mitra Sarana Technindo')

@section('content')
<div class="bg-white border-b">
    <div class="max-w-7xl mx-auto px-4 py-4">
        <nav class="flex items-center gap-2 text-sm text-gray-500">
            <a href="{{ route('home') }}" class="hover:text-navy-700">Beranda</a>
            <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
            <span class="text-navy-800 font-medium">Keranjang Belanja</span>
        </nav>
    </div>
</div>

<div class="max-w-5xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-navy-900 mb-6 flex items-center gap-2 font-heading">
        <i data-lucide="shopping-cart" class="w-7 h-7"></i>
        Keranjang Belanja
    </h1>

    @if(count($cartItems) > 0)
        <div class="bg-white rounded-xl border border-gray-100 overflow-hidden mb-6">
            {{-- Cart Items --}}
            @foreach($cartItems as $item)
            <div class="flex items-center gap-4 p-4 lg:p-6 {{ !$loop->last ? 'border-b border-gray-100' : '' }}">
                {{-- Image --}}
                <div class="w-20 h-20 bg-navy-50 rounded-lg overflow-hidden shrink-0">
                    @if($item['product']->image)
                        <img src="{{ asset('storage/' . $item['product']->image) }}" alt="{{ $item['product']->name }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <i data-lucide="package" class="w-8 h-8 text-navy-200"></i>
                        </div>
                    @endif
                </div>

                {{-- Info --}}
                <div class="flex-1 min-w-0">
                    <a href="{{ route('products.show', $item['product']) }}" class="font-semibold text-navy-900 hover:text-sky-700 text-sm lg:text-base">
                        {{ $item['product']->name }}
                    </a>
                    <p class="text-sm text-gray-500 mt-0.5">{{ $item['product']->formatted_price }} / unit</p>

                    <div class="flex items-center gap-4 mt-3">
                        {{-- Quantity --}}
                        <form action="{{ route('cart.update', $item['product']->id) }}" method="POST" class="flex items-center">
                            @csrf @method('PATCH')
                            <div class="flex items-center border border-gray-200 rounded-lg">
                                <button type="submit" name="quantity" value="{{ max(1, $item['quantity'] - 1) }}" class="w-8 h-8 flex items-center justify-center text-gray-500 hover:text-navy-700">
                                    <i data-lucide="minus" class="w-3 h-3"></i>
                                </button>
                                <span class="w-10 h-8 flex items-center justify-center text-sm font-medium border-x border-gray-200">{{ $item['quantity'] }}</span>
                                <button type="submit" name="quantity" value="{{ $item['quantity'] + 1 }}" class="w-8 h-8 flex items-center justify-center text-gray-500 hover:text-navy-700">
                                    <i data-lucide="plus" class="w-3 h-3"></i>
                                </button>
                            </div>
                        </form>

                        {{-- Remove --}}
                        <form action="{{ route('cart.remove', $item['product']->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-400 hover:text-red-600 text-sm flex items-center gap-1 transition">
                                <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                <span class="hidden sm:inline">Hapus</span>
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Subtotal --}}
                <div class="text-right shrink-0">
                    <p class="font-bold text-navy-900">Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</p>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Total & Checkout --}}
        <div class="bg-white rounded-xl border border-gray-100 p-6">
            <div class="flex justify-between items-center mb-4">
                <span class="text-gray-600">Total ({{ count($cartItems) }} produk)</span>
                <span class="text-2xl font-bold text-navy-900">Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>
            <a href="{{ route('checkout.index') }}"
               class="block w-full bg-sky-500 hover:bg-sky-600 text-white text-center font-semibold py-3.5 rounded-lg transition">
                Lanjut ke Checkout
            </a>
            <a href="{{ route('products.index') }}" class="block text-center text-sm text-gray-500 hover:text-navy-700 mt-3 transition">
                Lanjut Belanja
            </a>
        </div>
    @else
        <div class="text-center py-20 bg-white rounded-xl border border-gray-100">
            <i data-lucide="shopping-cart" class="w-20 h-20 text-gray-200 mx-auto mb-4"></i>
            <h2 class="text-lg font-semibold text-gray-700 mb-2 font-heading">Keranjang Belanja Kosong</h2>
            <p class="text-gray-500 mb-6">Anda belum menambahkan produk ke keranjang.</p>
            <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 bg-navy-800 hover:bg-navy-900 text-white px-6 py-3 rounded-lg transition">
                <i data-lucide="grid-3x3" class="w-4 h-4"></i>
                Lihat Katalog Produk
            </a>
        </div>
    @endif
</div>
@endsection
