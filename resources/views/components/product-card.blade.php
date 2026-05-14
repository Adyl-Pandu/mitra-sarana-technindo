<article class="bg-white rounded-xl border border-gray-100 overflow-hidden hover:shadow-lg hover:border-navy-200 transition-all duration-300 group flex flex-col">
    <a href="{{ route('products.show', $product) }}" class="block relative overflow-hidden aspect-square bg-gray-100">
        @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}"
                 alt="{{ $product->alt_text ?? $product->name }}"
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                 loading="lazy">
        @else
            <div class="w-full h-full flex items-center justify-center bg-navy-50">
                <i data-lucide="package" class="w-12 h-12 text-navy-200"></i>
            </div>
        @endif
        @if($product->is_featured)
            <span class="absolute top-2 left-2 bg-amber-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full uppercase tracking-wider">Unggulan</span>
        @endif
        @if(!$product->isInStock())
            <div class="absolute inset-0 bg-black/40 flex items-center justify-center">
                <span class="bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-full">Stok Habis</span>
            </div>
        @endif
    </a>
    <div class="p-4 flex flex-col flex-grow">
        <a href="{{ route('products.index', ['category' => $product->category->slug]) }}"
           class="text-[11px] text-navy-500 font-medium uppercase tracking-wider mb-1 hover:text-navy-700">
            {{ $product->category->name }}
        </a>
        <a href="{{ route('products.show', $product) }}" class="block mb-2">
            <h3 class="font-semibold text-navy-900 text-sm leading-snug line-clamp-2 group-hover:text-sky-700 transition">{{ $product->name }}</h3>
        </a>
        <div class="mt-auto pt-3 border-t border-gray-50 flex items-center justify-between">
            <p class="text-base lg:text-lg font-bold text-navy-900">{{ $product->formatted_price }}</p>
            @if($product->isInStock())
                <form action="{{ route('cart.add', $product) }}" method="POST">
                    @csrf
                    <button type="submit" class="w-9 h-9 bg-navy-100 hover:bg-sky-500 text-navy-700 hover:text-white rounded-lg flex items-center justify-center transition" title="Tambah ke Keranjang">
                        <i data-lucide="plus" class="w-4 h-4"></i>
                    </button>
                </form>
            @endif
        </div>
    </div>
</article>
