@extends('layouts.app')

@section('meta_title', 'PT Mitra Sarana Technindo - Supplier Sparepart Pelayaran Terpercaya Sejak 2008')
@section('meta_description', 'PT Mitra Sarana Technindo menyediakan sparepart dan suku cadang pelayaran berkualitas. Komponen mesin kapal, peralatan navigasi, keselamatan, dan perlengkapan kapal. Sejak 2008.')

@section('content')

{{-- Hero Section --}}
<section class="relative overflow-hidden bg-navy-900">
    {{-- <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: {{ asset('images/dominik-luckmann-SInhLTQouEk-unsplash.jpg') }};"></div>
    </div> --}}
    <section class="relative min-h-[600px] lg:min-h-screen flex items-center bg-slate-900 overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img
            src={{ asset('images/dominik-luckmann-SInhLTQouEk-unsplash.jpg') }}
            alt="Marine Spareparts Background"
            class="object-cover w-full h-full"
        />
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-slate-900/80 to-transparent"></div>
    </div>

    <div class="relative z-10 w-full px-4 py-20 mx-auto max-w-7xl lg:py-32">
        <div class="max-w-3xl">
            <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-md text-sky-200 text-sm px-4 py-1.5 rounded-full mb-6 border border-white/20">
                <i data-lucide="shield-check" class="w-4 h-4 text-sky-400"></i>
                <span class="font-medium">Terpercaya Sejak 2008</span>
            </div>

            <h1 class="mb-6 text-4xl font-semibold leading-tight text-white md:text-5xl lg:text-6xl">
                Marine Equipment
                <span class="block text-sky-400">
                    & Ship Spare Parts Supplier
                </span>
            </h1>

            <p class="max-w-2xl mb-10 text-base leading-relaxed md:text-lg text-slate-300">
                Mendukung kebutuhan industri maritim dengan produk berkualitas
                dan layanan pengadaan yang terpercaya.
            </p>

            <div class="flex flex-col gap-4 sm:flex-row">
                <a href="{{ route('products.index') }}"
                   class="inline-flex items-center justify-center gap-3 px-8 py-4 font-bold text-white transition-all duration-300 transform shadow-xl bg-sky-500 hover:bg-sky-600 rounded-xl hover:-translate-y-1 shadow-sky-500/25">
                    <i data-lucide="grid-3x3" class="w-5 h-5"></i>
                    Lihat Katalog Produk
                </a>

                <a href="https://wa.me/{{ env('WHATSAPP_NUMBER', '6281234567890') }}"
                   target="_blank"
                   class="inline-flex items-center justify-center gap-3 px-8 py-4 font-bold text-white transition-all duration-300 border bg-white/10 hover:bg-white/20 backdrop-blur-md rounded-xl border-white/20">
                    <i data-lucide="message-circle" class="w-5 h-5 text-green-400"></i>
                    Hubungi via WhatsApp
                </a>
            </div>
        </div>
    </div>
</section>

<script src="https://unpkg.com/lucide@latest"></script>
<script>
  lucide.createIcons();
</script>
</section>

{{-- Stats Bar --}}
<section class="bg-white border-b">
    <div class="px-4 py-6 mx-auto max-w-7xl">
        <div class="grid grid-cols-2 gap-6 text-center md:grid-cols-4">
            <div>
                <p class="text-2xl font-bold lg:text-3xl text-navy-900">17+</p>
                <p class="text-sm text-gray-500">Tahun Pengalaman</p>
            </div>
            <div>
                <p class="text-2xl font-bold lg:text-3xl text-navy-900">500+</p>
                <p class="text-sm text-gray-500">Produk Tersedia</p>
            </div>
            <div>
                <p class="text-2xl font-bold lg:text-3xl text-navy-900">200+</p>
                <p class="text-sm text-gray-500">Pelanggan Aktif</p>
            </div>
            <div>
                <p class="text-2xl font-bold lg:text-3xl text-navy-900">100%</p>
                <p class="text-sm text-gray-500">Produk Original</p>
            </div>
        </div>
    </div>
</section>

{{-- Categories Section --}}
<section class="relative px-4 py-20 overflow-hidden bg-gray-50">

    {{-- Background Decoration --}}
    <div class="absolute inset-0 pointer-events-none opacity-40">
        <div class="absolute top-0 left-0 rounded-full w-72 h-72 bg-navy-100 blur-3xl"></div>
        <div class="absolute bottom-0 right-0 bg-blue-100 rounded-full w-72 h-72 blur-3xl"></div>
    </div>

    <div class="relative mx-auto max-w-7xl">

        {{-- Heading --}}
        <div class="max-w-2xl mx-auto text-center mb-14">
            <span class="inline-block px-4 py-1 mb-4 text-xs font-semibold tracking-wider uppercase rounded-full bg-navy-100 text-navy-700">
                Product Categories
            </span>

            <h2 class="mb-4 text-3xl font-extrabold leading-tight lg:text-5xl text-navy-900">
                Kategori Produk
            </h2>

            <p class="text-base leading-relaxed text-gray-500 lg:text-lg">
                Temukan berbagai suku cadang, perlengkapan, dan komponen kapal berkualitas tinggi sesuai kebutuhan industri pelayaran Anda.
            </p>
        </div>

        {{-- Categories Grid --}}
        <div class="grid grid-cols-2 gap-5 md:grid-cols-3 lg:grid-cols-6">

            @foreach($categories as $category)

            <a href="{{ route('products.index', ['category' => $category->slug]) }}"
               class="relative p-6 overflow-hidden transition-all duration-300 bg-white border border-gray-100 shadow-sm group rounded-2xl hover:shadow-2xl hover:-translate-y-2 hover:border-navy-200">

                {{-- Hover Glow --}}
                <div class="absolute inset-0 transition-opacity duration-300 opacity-0 bg-gradient-to-br from-navy-50 to-blue-50 group-hover:opacity-100"></div>

                <div class="relative z-10">

                    {{-- Icon --}}
                    <div class="flex items-center justify-center w-16 h-16 mx-auto mb-5 transition-all duration-300 rounded-2xl bg-navy-50 group-hover:bg-navy-900 group-hover:scale-110">

                        @switch($category->sort_order)

                            @case(1)
                                <i data-lucide="compass"
                                   class="w-8 h-8 transition text-navy-700 group-hover:text-white"></i>
                            @break

                            @case(2)
                                <i data-lucide="life-buoy"
                                   class="w-8 h-8 transition text-navy-700 group-hover:text-white"></i>
                            @break

                            @case(3)
                                <i data-lucide="anchor"
                                   class="w-8 h-8 transition text-navy-700 group-hover:text-white"></i>
                            @break

                            @case(4)
                                <i data-lucide="zap"
                                   class="w-8 h-8 transition text-navy-700 group-hover:text-white"></i>
                            @break

                            @case(5)
                                <i data-lucide="droplets"
                                   class="w-8 h-8 transition text-navy-700 group-hover:text-white"></i>
                            @break

                            @default
                                <i data-lucide="settings"
                                   class="w-8 h-8 transition text-navy-700 group-hover:text-white"></i>

                        @endswitch

                    </div>

                    {{-- Content --}}
                    <h3 class="mb-2 text-sm font-bold leading-snug transition-colors duration-300 lg:text-base text-navy-900 group-hover:text-navy-700">
                        {{ $category->name }}
                    </h3>

                    <p class="text-sm text-gray-400">
                        {{ $category->active_products_count }} produk
                    </p>

                </div>

            </a>

            @endforeach

        </div>

        {{-- CTA --}}
        <div class="text-center mt-14">
            <a href="{{ route('products.index') }}"
               class="inline-flex items-center gap-2 px-6 py-3 text-sm font-semibold text-white transition-all duration-300 shadow-lg bg-navy-900 rounded-xl hover:bg-navy-800 hover:shadow-xl">

                Lihat Semua Produk

                <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </a>
        </div>

    </div>
</section>

{{-- Featured Products --}}
@if($featuredProducts->count())
<section class="py-16 bg-navy-50/50">
    <div class="px-4 mx-auto max-w-7xl">
        <div class="flex items-center justify-between mb-10">
            <div>
                <h2 class="mb-2 text-2xl font-bold lg:text-3xl text-navy-900">Produk Unggulan</h2>
                <p class="text-gray-500">Produk sparepart pelayaran terlaris dan paling dicari.</p>
            </div>
            <a href="{{ route('products.index') }}" class="items-center hidden gap-1 font-medium transition md:inline-flex text-navy-700 hover:text-navy-900">
                Lihat Semua <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </a>
        </div>
        <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4 lg:gap-6">
            @foreach($featuredProducts as $product)
                @include('components.product-card', ['product' => $product])
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Latest Products --}}
<section class="px-4 py-16 mx-auto max-w-7xl">
    <div class="flex items-center justify-between mb-10">
        <div>
            <h2 class="mb-2 text-2xl font-bold lg:text-3xl text-navy-900">Produk Terbaru</h2>
            <p class="text-gray-500">Update terbaru produk sparepart pelayaran kami.</p>
        </div>
        <a href="{{ route('products.index') }}" class="items-center hidden gap-1 font-medium transition md:inline-flex text-navy-700 hover:text-navy-900">
            Lihat Semua <i data-lucide="arrow-right" class="w-4 h-4"></i>
        </a>
    </div>
    <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4 lg:gap-6">
        @foreach($latestProducts as $product)
            @include('components.product-card', ['product' => $product])
        @endforeach
    </div>
</section>

{{-- About Section --}}
{{-- <section class="py-16 bg-navy-900" id="tentang">
    <div class="px-4 mx-auto max-w-7xl">
        <div class="grid items-center gap-12 lg:grid-cols-2">
            <div>
                <h2 class="mb-6 text-2xl font-bold text-white lg:text-3xl">Tentang PT Mitra Sarana Technindo</h2>
                <p class="mb-4 leading-relaxed text-navy-200">
                    PT Mitra Sarana Technindo adalah perusahaan supplier sparepart pelayaran yang telah berdiri
                    sejak tahun 2008. Beralamat di Pasar Asem Reges, Jakarta Barat, kami menyediakan berbagai
                    macam suku cadang dan perlengkapan untuk kebutuhan industri pelayaran.
                </p>
                <p class="mb-6 leading-relaxed text-navy-200">
                    Dengan pengalaman lebih dari 17 tahun, kami telah membangun reputasi sebagai supplier
                    sparepart pelayaran yang terpercaya dengan layanan terbaik dan harga kompetitif.
                </p>
                <div class="grid grid-cols-2 gap-4">
                    <div class="flex items-center gap-3">
                        <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-sky-500/20">
                            <i data-lucide="check-circle" class="w-5 h-5 text-sky-400"></i>
                        </div>
                        <span class="text-sm text-navy-100">Produk Original</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-sky-500/20">
                            <i data-lucide="truck" class="w-5 h-5 text-sky-400"></i>
                        </div>
                        <span class="text-sm text-navy-100">Pengiriman Cepat</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-sky-500/20">
                            <i data-lucide="headphones" class="w-5 h-5 text-sky-400"></i>
                        </div>
                        <span class="text-sm text-navy-100">Konsultasi Gratis</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-sky-500/20">
                            <i data-lucide="badge-check" class="w-5 h-5 text-sky-400"></i>
                        </div>
                        <span class="text-sm text-navy-100">Garansi Kualitas</span>
                    </div>
                </div>
            </div>
            <div class="p-8 bg-navy-800 rounded-2xl lg:p-10">
                <h3 class="mb-6 text-xl font-bold text-white">Hubungi Kami</h3>
                <div class="space-y-5">
                    <div class="flex items-start gap-4">
                        <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-navy-700 shrink-0">
                            <i data-lucide="map-pin" class="w-5 h-5 text-sky-400"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-white">Alamat</p>
                            <p class="text-sm text-navy-300">Pasar Asem Reges Blok Alooaks No.055, Jl. Tamansari Raya, Jakarta Barat</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-navy-700 shrink-0">
                            <i data-lucide="message-circle" class="w-5 h-5 text-green-400"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-white">WhatsApp</p>
                            <a href="https://wa.me/{{ env('WHATSAPP_NUMBER', '6281234567890') }}" class="text-sm text-sky-400 hover:underline">Chat Langsung</a>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-navy-700 shrink-0">
                            <i data-lucide="clock" class="w-5 h-5 text-sky-400"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-white">Jam Operasional</p>
                            <p class="text-sm text-navy-300">Senin - Sabtu: 08.00 - 17.00 WIB</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}

@endsection
