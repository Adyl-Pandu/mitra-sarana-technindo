<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') - PT Mitra Sarana Technindo</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logoKapalJaki.png') }}">
    <meta name="robots" content="noindex, nofollow">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        navy: { 50:'#f0f4f8',100:'#d9e2ec',200:'#bcccdc',300:'#9fb3c8',400:'#829ab1',500:'#627d98',600:'#486581',700:'#334e68',800:'#243b53',900:'#102a43',950:'#0a1929' }
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', '-apple-system', 'sans-serif'],
                        heading: ['Montserrat', 'system-ui', '-apple-system', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>[x-cloak]{display:none!important}</style>
</head>
<body class="font-sans bg-gray-100" x-data="{ sidebarOpen: false }">

<div class="flex min-h-screen">
    {{-- Sidebar --}}
    <aside class="fixed inset-y-0 left-0 z-30 w-64 transition-transform transform bg-navy-950 lg:translate-x-0"
           :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
        <div class="flex items-center gap-3 px-5 py-5 border-b border-navy-800">
            <div class="flex items-center justify-center rounded-lg w-9 h-9 bg-sky-500">
                <i data-lucide="anchor" class="w-5 h-5 text-white"></i>
            </div>
            <div>
                <h1 class="text-sm font-bold text-white">Mitra Sarana</h1>
                <p class="text-navy-400 text-[10px] uppercase tracking-widest">Admin Panel</p>
            </div>
        </div>

        <nav class="px-3 mt-4 space-y-1 overflow-y-auto" style="max-height: calc(100vh - 80px);">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition font-heading {{ request()->routeIs('admin.dashboard') ? 'bg-navy-800 text-white' : 'text-navy-300 hover:bg-navy-900 hover:text-white' }}">
                <i data-lucide="layout-dashboard" class="w-4.5 h-4.5"></i> Dashboard
            </a>
            <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition font-heading {{ request()->routeIs('admin.products.*') ? 'bg-navy-800 text-white' : 'text-navy-300 hover:bg-navy-900 hover:text-white' }}">
                <i data-lucide="package" class="w-4.5 h-4.5"></i> Produk
            </a>
            <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition font-heading {{ request()->routeIs('admin.categories.*') ? 'bg-navy-800 text-white' : 'text-navy-300 hover:bg-navy-900 hover:text-white' }}">
                <i data-lucide="tag" class="w-4.5 h-4.5"></i> Kategori
            </a>
            <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition font-heading {{ request()->routeIs('admin.orders.*') ? 'bg-navy-800 text-white' : 'text-navy-300 hover:bg-navy-900 hover:text-white' }}">
                <i data-lucide="shopping-bag" class="w-4.5 h-4.5"></i> Pesanan
            </a>
            <a href="{{ route('admin.stock-movements.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition font-heading {{ request()->routeIs('admin.stock-movements.*') ? 'bg-navy-800 text-white' : 'text-navy-300 hover:bg-navy-900 hover:text-white' }}">
                <i data-lucide="history" class="w-4.5 h-4.5"></i> Riwayat Stok
            </a>
            <a href="{{ route('admin.reports.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition font-heading {{ request()->routeIs('admin.reports.*') ? 'bg-navy-800 text-white' : 'text-navy-300 hover:bg-navy-900 hover:text-white' }}">
                <i data-lucide="bar-chart-3" class="w-4.5 h-4.5"></i> Laporan
            </a>

            <div class="pt-4 mt-4 border-t border-navy-800">
                <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-navy-400 hover:bg-navy-900 hover:text-white transition">
                    <i data-lucide="external-link" class="w-4.5 h-4.5"></i> Lihat Website
                </a>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-red-400 hover:bg-navy-900 hover:text-red-300 transition">
                        <i data-lucide="log-out" class="w-4.5 h-4.5"></i> Logout
                    </button>
                </form>
            </div>
        </nav>
    </aside>

    {{-- Overlay --}}
    <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 z-20 bg-black/50 lg:hidden" x-cloak></div>

    {{-- Main Content --}}
    <div class="flex-1 lg:ml-64">
        {{-- Top Bar --}}
        <header class="sticky top-0 z-10 flex items-center justify-between px-4 py-4 bg-white shadow-sm lg:px-8">
            <button @click="sidebarOpen = !sidebarOpen" class="p-1 text-gray-600 lg:hidden">
                <i data-lucide="menu" class="w-6 h-6"></i>
            </button>
            <h2 class="text-lg font-semibold text-navy-900">@yield('title', 'Dashboard')</h2>
            <div class="flex items-center gap-2">
                <span class="hidden text-sm text-gray-500 sm:block">{{ Auth::user()->name ?? 'Admin' }}</span>
                <div class="flex items-center justify-center w-8 h-8 rounded-full bg-navy-200">
                    <i data-lucide="user" class="w-4 h-4 text-navy-700"></i>
                </div>
            </div>
        </header>

        {{-- Flash --}}
        @if(session('success'))
            <div x-data="{show:true}" x-show="show" x-init="setTimeout(()=>show=false,4000)" x-transition class="flex items-center gap-2 px-4 py-3 mx-4 mt-4 text-sm text-green-700 border border-green-200 rounded-lg lg:mx-8 bg-green-50">
                <i data-lucide="check-circle" class="w-4 h-4"></i> {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div x-data="{show:true}" x-show="show" x-init="setTimeout(()=>show=false,4000)" x-transition class="flex items-center gap-2 px-4 py-3 mx-4 mt-4 text-sm text-red-700 border border-red-200 rounded-lg lg:mx-8 bg-red-50">
                <i data-lucide="alert-circle" class="w-4 h-4"></i> {{ session('error') }}
            </div>
        @endif

        <main class="p-4 lg:p-8">
            @yield('content')
        </main>
    </div>
</div>

<script>lucide.createIcons();</script>
@stack('scripts')
</body>
</html>
