@extends('layouts.app')

@section('meta_title', 'PT Mitra Sarana Technindo - Supplier Sparepart Pelayaran Terpercaya Sejak 2008')
@section('meta_description', 'PT Mitra Sarana Technindo menyediakan sparepart dan suku cadang pelayaran berkualitas. Komponen mesin kapal, peralatan navigasi, keselamatan, dan perlengkapan kapal. Sejak 2008.')

@section('content')

    {{-- COMPANY PROFILE SECTION --}}
    <section class="relative overflow-hidden bg-white">

        {{-- HERO --}}
        <div class="relative overflow-hidden h-[520px] sm:h-[620px] lg:h-[720px]">

            {{-- Background Image --}}
            <img src="{{ asset('images/warehouse.jpg') }}" alt="PT Mitra Sarana Technindo"
                class="object-cover w-full h-full">

            {{-- Overlay --}}
            <div class="absolute inset-0 bg-black/65"></div>

            {{-- Hero Content --}}
            <div class="absolute inset-0 z-10 flex items-center justify-center px-5 text-center">

                <div class="w-full max-w-5xl">

                    <p
                        class="mb-4 text-[11px] sm:text-sm font-semibold tracking-[4px] sm:tracking-[6px] text-sky-400 uppercase">
                        Marine & Industrial Supplier
                    </p>

                    <h1 class="text-4xl font-extrabold leading-tight text-white sm:text-5xl lg:text-7xl">
                        Smart Industrial
                        <span class="text-sky-400">
                            Partner
                        </span>
                    </h1>

                    <p class="max-w-2xl mx-auto mt-5 text-sm leading-relaxed text-gray-200 sm:text-base lg:text-lg">
                        PT Mitra Sarana Technindo menyediakan sparepart pelayaran,
                        perlengkapan kapal, dan solusi industrial terpercaya untuk
                        kebutuhan industri maritim Indonesia.
                    </p>

                    <div class="flex flex-col items-center justify-center gap-4 mt-8 sm:flex-row">

                        <a href="{{ route('products.index') }}"
                            class="w-full px-6 py-3 text-sm font-semibold text-center text-white transition-all duration-300 shadow-xl sm:w-auto bg-sky-400 rounded-xl hover:bg-sky-700">

                            Explore Products
                        </a>

                        <a href="#about"
                            class="w-full px-6 py-3 text-sm font-semibold text-center text-white transition-all duration-300 border border-white sm:w-auto rounded-xl hover:bg-white hover:text-black">

                            Learn More
                        </a>

                    </div>

                </div>

            </div>

        </div>

        {{-- ABOUT COMPANY --}}
        <div id="about"
            class="relative z-20 px-5 py-10 mx-4 -mt-16 bg-white shadow-2xl sm:px-8 lg:px-14 rounded-3xl max-w-7xl lg:py-20 lg:mx-auto">

            <div class="grid items-center gap-12 lg:grid-cols-2">

                {{-- LEFT --}}
                <div class="order-2 lg:order-1">

                    <span class="inline-block mb-3 text-xs font-bold tracking-[3px] uppercase text-sky-400">
                        Get To Know
                    </span>

                    <h2 class="mb-5 text-3xl font-extrabold leading-tight text-gray-900 sm:text-4xl lg:text-5xl">
                        PT Mitra Sarana Technindo
                    </h2>

                    <p class="mb-5 text-sm leading-relaxed text-gray-600 sm:text-base">
                        PT Mitra Sarana Technindo adalah perusahaan supplier sparepart
                        pelayaran dan perlengkapan kapal terpercaya yang telah melayani
                        kebutuhan industri maritim sejak tahun 2008.
                    </p>

                    <p class="mb-8 text-sm leading-relaxed text-gray-600 sm:text-base">
                        Kami menyediakan berbagai produk berkualitas mulai dari komponen
                        mesin kapal, sistem navigasi, perlengkapan dek, kelistrikan,
                        hingga peralatan keselamatan dengan standar industri terbaik.
                    </p>

                    <div class="flex flex-col gap-4 sm:flex-row">

                        <a href="{{ route('products.index') }}"
                            class="px-6 py-3 text-sm font-semibold text-center text-white transition rounded-xl bg-sky-400 hover:bg-sky-700">

                            Discover Our Products
                        </a>

                        <a href="#contact"
                            class="px-6 py-3 text-sm font-semibold text-center text-gray-700 transition border border-gray-300 rounded-xl hover:bg-gray-100">

                            Contact Us
                        </a>

                    </div>

                </div>

                {{-- RIGHT --}}
                <div class="flex items-center justify-center order-1 lg:order-2">

                    <img src="{{ asset('images/logo.png') }}" alt="PT Mitra Sarana Technindo"
                        class="object-contain w-full max-w-[260px] sm:max-w-sm lg:max-w-lg">

                </div>

            </div>

        </div>

        {{-- WHAT WE DO --}}
        <div id="services" class="px-5 py-16 mx-auto max-w-7xl sm:px-6 lg:px-8 lg:py-24">

            <div class="grid items-center gap-12 lg:grid-cols-2">

                {{-- IMAGE --}}
                <div class="relative overflow-hidden shadow-2xl rounded-3xl">

                    <img src="{{ asset('images/warehouse-2.jpg') }}" alt="Warehouse"
                        class="object-cover w-full h-[300px] sm:h-[400px] lg:h-[520px] transition duration-500 hover:scale-105">

                </div>

                {{-- CONTENT --}}
                <div>

                    <span class="inline-block mb-3 text-xs font-bold tracking-[3px] uppercase text-sky-400">
                        What We Do
                    </span>

                    <h2 class="mb-6 text-3xl font-extrabold leading-tight text-gray-900 sm:text-4xl lg:text-5xl">
                        Solusi Sparepart &
                        <span class="text-sky-400">
                            Perlengkapan Kapal
                        </span>
                    </h2>

                    <p class="mb-5 text-sm leading-relaxed text-gray-600 sm:text-base">
                        Kami berkomitmen menyediakan produk original dan berkualitas
                        tinggi untuk memenuhi kebutuhan operasional kapal dan industri maritim.
                    </p>

                    <p class="mb-5 text-sm leading-relaxed text-gray-600 sm:text-base">
                        Dengan pengalaman lebih dari 17 tahun, PT Mitra Sarana Technindo
                        telah dipercaya oleh berbagai perusahaan pelayaran, galangan kapal,
                        dan industri marine di Indonesia.
                    </p>

                    <p class="text-sm leading-relaxed text-gray-600 sm:text-base">
                        Didukung tim profesional dan jaringan supplier terpercaya,
                        kami memastikan setiap produk memiliki kualitas terbaik,
                        pengiriman cepat, dan pelayanan maksimal.
                    </p>

                    {{-- Features --}}
                    <div class="grid gap-5 mt-10 sm:grid-cols-2">

                        {{-- ITEM --}}
                        <div class="flex gap-4 p-4 transition bg-white border border-gray-100 rounded-2xl hover:shadow-lg">

                            <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 rounded-xl bg-sky-50">
                                <i data-lucide="shield-check" class="w-6 h-6 text-sky-400"></i>
                            </div>

                            <div>
                                <h4 class="font-bold text-gray-900">
                                    Original Product
                                </h4>

                                <p class="mt-1 text-sm text-gray-500">
                                    Produk original dan berkualitas tinggi
                                </p>
                            </div>

                        </div>

                        {{-- ITEM --}}
                        <div class="flex gap-4 p-4 transition bg-white border border-gray-100 rounded-2xl hover:shadow-lg">

                            <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 rounded-xl bg-sky-50">
                                <i data-lucide="ship" class="w-6 h-6 text-sky-400"></i>
                            </div>

                            <div>
                                <h4 class="font-bold text-gray-900">
                                    Marine Specialist
                                </h4>

                                <p class="mt-1 text-sm text-gray-500">
                                    Fokus pada kebutuhan industri pelayaran
                                </p>
                            </div>

                        </div>

                        {{-- ITEM --}}
                        <div class="flex gap-4 p-4 transition bg-white border border-gray-100 rounded-2xl hover:shadow-lg">

                            <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 rounded-xl bg-sky-50">
                                <i data-lucide="truck" class="w-6 h-6 text-sky-400"></i>
                            </div>

                            <div>
                                <h4 class="font-bold text-gray-900">
                                    Fast Delivery
                                </h4>

                                <p class="mt-1 text-sm text-gray-500">
                                    Pengiriman cepat dan aman
                                </p>
                            </div>

                        </div>

                        {{-- ITEM --}}
                        <div class="flex gap-4 p-4 transition bg-white border border-gray-100 rounded-2xl hover:shadow-lg">

                            <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 rounded-xl bg-sky-50">
                                <i data-lucide="users" class="w-6 h-6 text-sky-400"></i>
                            </div>

                            <div>
                                <h4 class="font-bold text-gray-900">
                                    Professional Team
                                </h4>

                                <p class="mt-1 text-sm text-gray-500">
                                    Tim berpengalaman dan responsif
                                </p>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

@endsection
