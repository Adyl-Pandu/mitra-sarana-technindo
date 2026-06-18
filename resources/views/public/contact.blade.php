@extends('layouts.app')

@section('meta_title', 'Hubungi Kami - PT Mitra Sarana Technindo')
@section('meta_description', 'Hubungi PT Mitra Sarana Technindo untuk kebutuhan sparepart dan suku cadang pelayaran. WhatsApp, email, atau kunjungi langsung lokasi kami di Jakarta Barat.')

@section('content')

    {{-- HERO --}}
    <section class="relative overflow-hidden h-[420px] sm:h-[520px] lg:h-[620px]">
        <img src="{{ asset('images/warehouse.jpg') }}" alt="Hubungi PT Mitra Sarana Technindo"
            class="object-cover w-full h-full">
        <div class="absolute inset-0 bg-black/65"></div>
        <div class="absolute inset-0 z-10 flex items-center justify-center px-5 text-center">
            <div class="w-full max-w-4xl">
                <p class="mb-4 text-[11px] sm:text-sm font-semibold tracking-[4px] sm:tracking-[6px] text-sky-400 uppercase">
                    Hubungi Kami
                </p>
                <h1 class="text-4xl font-extrabold leading-tight text-white sm:text-5xl lg:text-7xl font-heading">
                    Hubungi
                    <span class="text-sky-400">Kami</span>
                </h1>
                <p class="max-w-2xl mx-auto mt-5 text-sm leading-relaxed text-gray-200 sm:text-base lg:text-lg">
                    Tim kami siap membantu Anda menemukan sparepart dan perlengkapan kapal
                    yang sesuai dengan kebutuhan industri pelayaran Anda.
                </p>
            </div>
        </div>
    </section>

    {{-- CONTACT INFO + FORM --}}
    <section class="relative z-20 px-5 py-10 mx-4 -mt-16 bg-white shadow-2xl sm:px-8 lg:px-14 rounded-3xl max-w-7xl lg:py-20 lg:mx-auto">
        <div class="grid gap-12 lg:grid-cols-2">
            {{-- LEFT: Contact Info --}}
            <div>
                <span class="inline-block mb-3 text-xs font-bold tracking-[3px] uppercase text-sky-400">
                    Informasi Kontak
                </span>
                <h2 class="mb-5 text-3xl font-extrabold leading-tight text-gray-900 sm:text-4xl lg:text-5xl font-heading">
                    Mari Berdiskusi
                </h2>
                <p class="mb-8 text-sm leading-relaxed text-gray-600 sm:text-base">
                    Jangan ragu untuk menghubungi kami melalui berbagai saluran
                    berikut. Kami akan merespon dengan cepat.
                </p>

                <div class="space-y-6">
                    {{-- Address --}}
                    <div class="flex gap-5 p-5 transition bg-white border border-gray-100 rounded-2xl hover:shadow-lg">
                        <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 rounded-xl bg-sky-50">
                            <i data-lucide="map-pin" class="w-6 h-6 text-sky-500"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 font-heading">Alamat</h4>
                            <p class="mt-1 text-sm text-gray-500">
                                Pasar Asem Reges Blok Alooaks No.055,<br>
                                Jl. Tamansari Raya, Jakarta Barat
                            </p>
                        </div>
                    </div>

                    {{-- WhatsApp --}}
                    <div class="flex gap-5 p-5 transition bg-white border border-gray-100 rounded-2xl hover:shadow-lg">
                        <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 rounded-xl bg-green-50">
                            <i data-lucide="message-circle" class="w-6 h-6 text-green-500"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 font-heading">WhatsApp</h4>
                            <a href="https://wa.me/{{ config('app.whatsapp_number') }}" target="_blank"
                                class="mt-1 text-sm text-sky-600 hover:underline">
                                +62 812-8791-3680
                            </a>
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="flex gap-5 p-5 transition bg-white border border-gray-100 rounded-2xl hover:shadow-lg">
                        <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 rounded-xl bg-purple-50">
                            <i data-lucide="mail" class="w-6 h-6 text-purple-500"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 font-heading">Email</h4>
                            <a href="mailto:info@mitrast.com"
                                class="mt-1 text-sm text-sky-600 hover:underline">
                                info@mitrast.com
                            </a>
                        </div>
                    </div>

                    {{-- Operating Hours --}}
                    <div class="flex gap-5 p-5 transition bg-white border border-gray-100 rounded-2xl hover:shadow-lg">
                        <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 rounded-xl bg-amber-50">
                            <i data-lucide="clock" class="w-6 h-6 text-amber-500"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 font-heading">Jam Operasional</h4>
                            <p class="mt-1 text-sm text-gray-500">
                                Senin - Sabtu: 08.00 - 17.00 WIB
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- RIGHT: Contact Form --}}
            <div>
                <span class="inline-block mb-3 text-xs font-bold tracking-[3px] uppercase text-sky-400">
                    Kirim Pesan
                </span>
                <h2 class="mb-5 text-3xl font-extrabold leading-tight text-gray-900 sm:text-4xl lg:text-5xl font-heading">
                    Kirim Pesan
                </h2>
                <p class="mb-8 text-sm leading-relaxed text-gray-600 sm:text-base">
                    Isi form di bawah ini dan tim kami akan menghubungi Anda segera.
                </p>

                <form action="https://formspree.io/f/yourFormID" method="POST"
                    class="p-6 space-y-5 bg-gray-50 rounded-2xl sm:p-8">
                    @csrf

                    <div class="grid gap-5 sm:grid-cols-2">
                        <div>
                            <label for="name" class="block mb-1.5 text-sm font-semibold text-gray-700">Nama Lengkap</label>
                            <input type="text" id="name" name="name" required
                                class="w-full px-4 py-3 text-sm transition bg-white border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-transparent"
                                placeholder="Masukkan nama Anda">
                        </div>
                        <div>
                            <label for="email" class="block mb-1.5 text-sm font-semibold text-gray-700">Email</label>
                            <input type="email" id="email" name="email" required
                                class="w-full px-4 py-3 text-sm transition bg-white border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-transparent"
                                placeholder="Masukkan email Anda">
                        </div>
                    </div>

                    <div>
                        <label for="subject" class="block mb-1.5 text-sm font-semibold text-gray-700">Subjek</label>
                        <input type="text" id="subject" name="subject" required
                            class="w-full px-4 py-3 text-sm transition bg-white border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-transparent"
                            placeholder="Subjek pesan">
                    </div>

                    <div>
                        <label for="message" class="block mb-1.5 text-sm font-semibold text-gray-700">Pesan</label>
                        <textarea id="message" name="message" rows="5" required
                            class="w-full px-4 py-3 text-sm transition bg-white border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-transparent resize-none"
                            placeholder="Tulis pesan Anda di sini..."></textarea>
                    </div>

                    <button type="submit"
                        class="w-full px-6 py-3.5 text-sm font-bold text-white transition-all duration-300 shadow-xl bg-sky-500 hover:bg-sky-600 rounded-xl hover:-translate-y-0.5 shadow-sky-500/25">
                        <span class="flex items-center justify-center gap-2">
                            <i data-lucide="send" class="w-4 h-4"></i>
                            Kirim Pesan
                        </span>
                    </button>
                </form>
            </div>
        </div>
    </section>

    {{-- MAPS --}}
    <section class="px-4 py-16 mx-auto max-w-7xl sm:px-6 lg:px-8 lg:py-24">
        <div class="text-center mb-14">
            <span class="inline-block px-4 py-1 mb-4 text-xs font-semibold tracking-wider uppercase rounded-full bg-navy-100 text-navy-700">
                Lokasi Kami
            </span>
            <h2 class="mb-4 text-3xl font-extrabold leading-tight lg:text-5xl text-navy-900 font-heading">
                Temukan Kami
            </h2>
            <p class="max-w-xl mx-auto text-base leading-relaxed text-gray-500 lg:text-lg">
                Kunjungi langsung lokasi kami untuk konsultasi dan pembelian produk.
            </p>
        </div>

        <div class="overflow-hidden shadow-2xl rounded-3xl">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.7!2d106.8!3d-6.15!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMDknMDAuMCJTIDEwNsKwNDgnMDAuMCJF!5e0!3m2!1sid!2sid!4v1"
                width="100%" height="450" style="border:0;" allowfullscreen loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                title="Lokasi PT Mitra Sarana Technindo">
            </iframe>
        </div>
    </section>

    {{-- CTA --}}
    <section class="px-4 py-16 bg-navy-900 lg:py-24">
        <div class="mx-auto text-center max-w-7xl">
            <span class="inline-block px-4 py-1 mb-4 text-xs font-semibold tracking-wider uppercase rounded-full bg-white/10 text-sky-400">
                Siap Memesan?
            </span>
            <h2 class="mb-4 text-3xl font-extrabold leading-tight text-white lg:text-5xl font-heading">
                Butuh Bantuan Memilih Produk?
            </h2>
            <p class="max-w-2xl mx-auto mb-8 text-base leading-relaxed text-navy-200 lg:text-lg">
                Tim sales kami siap membantu Anda menemukan sparepart yang tepat
                untuk kebutuhan kapal dan industri Anda.
            </p>
            <div class="flex flex-col items-center justify-center gap-4 sm:flex-row">
                <a href="https://wa.me/{{ config('app.whatsapp_number') }}" target="_blank"
                    class="inline-flex items-center gap-2 px-8 py-4 text-sm font-bold text-white transition-all duration-300 shadow-xl bg-green-500 hover:bg-green-600 rounded-xl hover:-translate-y-1 shadow-green-500/25">
                    <i data-lucide="message-circle" class="w-5 h-5"></i>
                    Konsultasi via WhatsApp
                </a>
                <a href="{{ route('products.index') }}"
                    class="inline-flex items-center gap-2 px-8 py-4 text-sm font-bold text-white transition-all duration-300 border border-white/30 hover:bg-white/10 rounded-xl">
                    <i data-lucide="grid-3x3" class="w-5 h-5"></i>
                    Lihat Katalog Produk
                </a>
            </div>
        </div>
    </section>

@endsection
