@extends('layouts.app')

@section('meta_title', $product->meta_title ?? 'Jual ' . $product->name . ' - PT Mitra Sarana Technindo')
@section('meta_description', $product->meta_description ?? 'Jual ' . $product->name . ' berkualitas untuk kebutuhan industri pelayaran. Harga terbaik dari PT Mitra Sarana Technindo.')

@section('content')

{{-- Breadcrumb --}}
<div class="bg-white border-b">
    <div class="max-w-7xl mx-auto px-4 py-4">
        <nav class="flex items-center gap-2 text-sm text-gray-500 flex-wrap">
            <a href="{{ route('home') }}" class="hover:text-navy-700">Beranda</a>
            <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
            <a href="{{ route('products.index') }}" class="hover:text-navy-700">Katalog</a>
            <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
            <a href="{{ route('products.index', ['category' => $product->category->slug]) }}" class="hover:text-navy-700">{{ $product->category->name }}</a>
            <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
            <span class="text-navy-800 font-medium">{{ $product->name }}</span>
        </nav>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="grid lg:grid-cols-2 gap-8 lg:gap-12">
        {{-- Product Image --}}
        <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden aspect-square flex items-center justify-center">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}"
                     alt="{{ $product->alt_text ?? $product->name }}"
                     class="w-full h-full object-cover">
            @else
                <div class="w-full h-full bg-navy-50 flex flex-col items-center justify-center">
                    <i data-lucide="package" class="w-24 h-24 text-navy-200 mb-2"></i>
                    <span class="text-navy-300 text-sm">Foto produk belum tersedia</span>
                </div>
            @endif
        </div>

        {{-- Product Info --}}
        <div>
            <a href="{{ route('products.index', ['category' => $product->category->slug]) }}"
               class="inline-flex items-center gap-1 text-xs text-navy-500 font-medium uppercase tracking-wider mb-3 hover:text-navy-700">
                <i data-lucide="tag" class="w-3.5 h-3.5"></i>
                {{ $product->category->name }}
            </a>

            <h1 class="text-2xl lg:text-3xl font-bold text-navy-900 mb-2">{{ $product->name }}</h1>

            @if($product->sku)
                <p class="text-sm text-gray-400 mb-4">SKU: {{ $product->sku }}</p>
            @endif

            <div class="flex items-center gap-4 mb-6">
                <p class="text-3xl font-bold text-navy-900">{{ $product->formatted_price }}</p>
                @if($product->isInStock())
                    <span class="inline-flex items-center gap-1 bg-green-100 text-green-700 text-xs font-medium px-3 py-1 rounded-full">
                        <i data-lucide="check" class="w-3 h-3"></i> Stok Tersedia ({{ $product->stock }})
                    </span>
                @else
                    <span class="inline-flex items-center gap-1 bg-red-100 text-red-700 text-xs font-medium px-3 py-1 rounded-full">
                        <i data-lucide="x" class="w-3 h-3"></i> Stok Habis
                    </span>
                @endif
            </div>

            {{-- Description --}}
            @if($product->description)
            <div class="mb-6">
                <h2 class="text-sm font-semibold text-navy-800 mb-2 uppercase tracking-wider">Deskripsi Produk</h2>
                <p class="text-gray-600 leading-relaxed">{{ $product->description }}</p>
            </div>
            @endif

            {{-- Specifications --}}
            @if($product->specifications)
            <div class="mb-6 bg-navy-50 rounded-xl p-5">
                <h2 class="text-sm font-semibold text-navy-800 mb-3 uppercase tracking-wider">Spesifikasi</h2>
                <div class="space-y-2">
                    @foreach(explode("\n", $product->specifications) as $spec)
                        @if(trim($spec))
                        <div class="flex items-start gap-2 text-sm">
                            <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-navy-400 mt-0.5 shrink-0"></i>
                            <span class="text-gray-700">{{ trim($spec) }}</span>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Add to Cart --}}
            @if($product->isInStock())
            <form action="{{ route('cart.add', $product) }}" method="POST" class="flex items-center gap-4 mb-6">
                @csrf
                <div class="flex items-center border border-gray-200 rounded-lg">
                    <button type="button" onclick="changeQty(-1)" class="w-10 h-10 flex items-center justify-center text-gray-500 hover:text-navy-700 transition">
                        <i data-lucide="minus" class="w-4 h-4"></i>
                    </button>
                    <input type="number" name="quantity" id="qty" value="1" min="1" max="{{ $product->stock }}"
                           class="w-14 h-10 text-center border-x border-gray-200 text-sm font-medium outline-none">
                    <button type="button" onclick="changeQty(1)" class="w-10 h-10 flex items-center justify-center text-gray-500 hover:text-navy-700 transition">
                        <i data-lucide="plus" class="w-4 h-4"></i>
                    </button>
                </div>
                <button type="submit" class="flex-1 lg:flex-none bg-sky-500 hover:bg-sky-600 text-white font-semibold px-8 py-3 rounded-lg transition flex items-center justify-center gap-2">
                    <i data-lucide="shopping-cart" class="w-5 h-5"></i>
                    Tambah ke Keranjang
                </button>
            </form>
            @endif

            {{-- WhatsApp Direct --}}
            <a href="https://wa.me/{{ env('WHATSAPP_NUMBER', '6281234567890') }}?text={{ urlencode('Halo, saya tertarik dengan produk: ' . $product->name . ' (SKU: ' . $product->sku . '). Apakah masih tersedia?') }}"
               target="_blank"
               class="inline-flex items-center gap-2 bg-green-500 hover:bg-green-600 text-white font-medium px-6 py-3 rounded-lg transition w-full lg:w-auto justify-center">
                <i data-lucide="message-circle" class="w-5 h-5"></i>
                Tanya via WhatsApp
            </a>
        </div>
    </div>

    {{-- Related Products --}}
    @if($relatedProducts->count())
    <div class="mt-16">
        <h2 class="text-xl font-bold text-navy-900 mb-6">Produk Terkait</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 lg:gap-6">
            @foreach($relatedProducts as $related)
                @include('components.product-card', ['product' => $related])
            @endforeach
        </div>
    </div>
    @endif
</div>

@push('scripts')
<script>
function changeQty(delta) {
    const input = document.getElementById('qty');
    let val = parseInt(input.value) + delta;
    val = Math.max(1, Math.min(val, parseInt(input.max)));
    input.value = val;
}
</script>
@endpush
@endsection
