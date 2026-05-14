<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- SEO Meta Tags --}}
    <title>@yield('meta_title', 'PT Mitra Sarana Technindo - Supplier Sparepart Pelayaran Terpercaya')</title>
    <meta name="description"
        content="@yield('meta_description', 'PT Mitra Sarana Technindo - Supplier sparepart dan suku cadang pelayaran terpercaya sejak 2008. Komponen mesin kapal, peralatan navigasi, keselamatan, dan perlengkapan kapal.')">
    <meta name="keywords"
        content="sparepart kapal, suku cadang pelayaran, komponen mesin kapal, peralatan navigasi, supplier marine">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Open Graph --}}
    <meta property="og:title" content="@yield('meta_title', 'PT Mitra Sarana Technindo')">
    <meta property="og:description"
        content="@yield('meta_description', 'Supplier sparepart pelayaran terpercaya sejak 2008.')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">


    @vite(['resources/css/app.css', 'resources/js/app.js'])

    
</head>

<body class="text-gray-800 bg-gray-50">

    {{-- Top Bar --}}
    <div class="hidden text-xs border-b bg-navy-950/95 border-white/10 text-navy-200 md:block">
        <div class="flex items-center justify-between px-4 py-2 mx-auto max-w-7xl">
            <div class="flex items-center gap-4">
                <span class="flex items-center gap-1">
                    <i data-lucide="map-pin" class="w-3.5 h-3.5"></i>
                    Pasar Asem Reges Blok Alooaks No.055, Jakarta Barat
                </span>
            </div>
            <div class="flex items-center gap-4">
                <a href="https://wa.me/{{ env('WHATSAPP_NUMBER', '6281234567890') }}"
                    class="flex items-center gap-1 transition hover:text-white">
                    <i data-lucide="phone" class="w-3.5 h-3.5"></i>
                    Hubungi Kami
                </a>
            </div>
        </div>
    </div>

    {{-- Navigation --}}
    <nav class="sticky top-0 z-50 bg-white shadow-sm" x-data="{ mobileOpen: false }">
        <div class="px-4 mx-auto max-w-7xl">
            <div class="flex items-center justify-between h-14 lg:h-16">
                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-3">

                    <div class="hidden sm:block">
                        <h1 class="text-lg font-semibold tracking-tight text-navy-900">
                            Mitra Sarana
                        </h1>

                        <p class="text-[11px] uppercase tracking-[0.25em] text-navy-500">
                            Technindo
                        </p>
                    </div>
                </a>

                {{-- Desktop Menu --}}
                <div class="items-center hidden gap-8 lg:flex">
                    <a href="{{ route('home') }}"
                        class="text-gray-700 hover:text-navy-800 font-medium transition {{ request()->routeIs('home') ? 'text-navy-800 border-b-2 border-navy-800 pb-1' : '' }}">Beranda</a>
                    <a href="{{ route('products.index') }}"
                        class="text-gray-700 hover:text-navy-800 font-medium transition {{ request()->routeIs('products.*') ? 'text-navy-800 border-b-2 border-navy-800 pb-1' : '' }}">Katalog
                        Produk</a>
                    <a href="{{ route('aboutus') }}" class="font-medium text-gray-700 transition hover:text-navy-800">Tentang Kami</a>
                    <a href="#kontak" class="font-medium text-gray-700 transition hover:text-navy-800">Kontak</a>
                </div>

                {{-- Cart & Mobile Menu --}}
                <div class="flex items-center gap-3">
                    <a href="{{ route('cart.index') }}"
                        class="relative p-2 text-gray-600 transition hover:text-navy-800">
                        <i data-lucide="shopping-cart" class="w-6 h-6"></i>
                        @php $cartCount = collect(session('cart', []))->sum('quantity'); @endphp
                        @if($cartCount > 0)
                            <span
                                class="absolute flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-red-500 rounded-full -top-1 -right-1">{{ $cartCount }}</span>
                        @endif
                    </a>
                    <button @click="mobileOpen = !mobileOpen" class="p-2 text-gray-600 lg:hidden">
                        <i data-lucide="menu" class="w-6 h-6" x-show="!mobileOpen"></i>
                        <i data-lucide="x" class="w-6 h-6" x-show="mobileOpen" x-cloak></i>
                    </button>
                </div>
            </div>

            {{-- Mobile Menu --}}
            <div x-show="mobileOpen" x-cloak x-transition class="pb-4 border-t lg:hidden">
                <a href="{{ route('home') }}" class="block px-2 py-3 text-gray-700 rounded hover:bg-navy-50">Beranda</a>
                <a href="{{ route('products.index') }}"
                    class="block px-2 py-3 text-gray-700 rounded hover:bg-navy-50">Katalog Produk</a>
                <a href="{{ route('aboutus') }}" class="block px-2 py-3 text-gray-700 rounded hover:bg-navy-50">Tentang Kami</a>
                <a href="#kontak" class="block px-2 py-3 text-gray-700 rounded hover:bg-navy-50">Kontak</a>
            </div>
        </div>
    </nav>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" x-transition
            class="fixed z-50 flex items-center gap-2 px-6 py-3 text-white bg-green-500 rounded-lg shadow-lg top-24 right-4">
            <i data-lucide="check-circle" class="w-5 h-5"></i>
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" x-transition
            class="fixed z-50 flex items-center gap-2 px-6 py-3 text-white bg-red-500 rounded-lg shadow-lg top-24 right-4">
            <i data-lucide="alert-circle" class="w-5 h-5"></i>
            {{ session('error') }}
        </div>
    @endif

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-navy-950 text-navy-200" id="kontak">
        <div class="px-4 py-12 mx-auto max-w-7xl lg:py-16">
            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-4">
                {{-- Company Info --}}
                <div class="lg:col-span-2">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-white/10">
                            <i data-lucide="anchor" class="w-6 h-6 text-white"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-white">PT Mitra Sarana Technindo</h3>
                            <p class="text-xs text-navy-400">Supplier Sparepart Pelayaran Sejak 2008</p>
                        </div>
                    </div>
                    <p class="mb-4 text-sm leading-relaxed text-navy-300">
                        Menyediakan berbagai suku cadang dan perlengkapan untuk kebutuhan industri pelayaran
                        dengan kualitas terbaik dan harga kompetitif.
                    </p>
                    <div class="flex items-center gap-2 text-sm">
                        <i data-lucide="map-pin" class="w-4 h-4 text-navy-400"></i>
                        <span>Pasar Asem Reges Blok Alooaks No.055, Jl. Tamansari Raya, Jakarta Barat</span>
                    </div>
                </div>

                {{-- Quick Links --}}
                <div>
                    <h4 class="mb-4 font-semibold text-white">Menu</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('home') }}" class="transition hover:text-white">Beranda</a></li>
                        <li><a href="{{ route('products.index') }}" class="transition hover:text-white">Katalog
                                Produk</a></li>
                        <li><a href="{{ route('cart.index') }}" class="transition hover:text-white">Keranjang
                                Belanja</a></li>
                    </ul>
                </div>

                {{-- Contact --}}
                <div>
                    <h4 class="mb-4 font-semibold text-white">Hubungi Kami</h4>
                    <div class="space-y-3 text-sm">
                        <a href="https://wa.me/{{ env('WHATSAPP_NUMBER', '6281234567890') }}"
                            class="flex items-center gap-2 transition hover:text-white">
                            <i data-lucide="message-circle" class="w-4 h-4 text-green-400"></i>
                            WhatsApp
                        </a>
                        <div class="flex items-center gap-2">
                            <i data-lucide="mail" class="w-4 h-4 text-navy-400"></i>
                            info@mitrast.com
                        </div>
                    </div>
                </div>
            </div>
            <div class="pt-6 mt-10 text-sm text-center border-t border-navy-800 text-navy-500">
                &copy; {{ date('Y') }} PT Mitra Sarana Technindo. All Rights Reserved.
            </div>
        </div>
    </footer>

    {{-- WhatsApp Float Button --}}
    <a href="https://wa.me/{{ env('WHATSAPP_NUMBER', '6281234567890') }}" target="_blank"
        class="fixed z-40 flex items-center justify-center w-12 h-12 text-white transition-transform bg-green-500 rounded-full shadow-lg bottom-6 right-6 hover:bg-green-600 hover:scale-110">
        <i data-lucide="message-circle" class="w-7 h-7"></i>
    </a>

    @stack('scripts')
</body>

</html>
