@extends('layouts.app')

@section('meta_title', 'Pesanan Berhasil - PT Mitra Sarana Technindo')

@section('content')
<div class="max-w-xl mx-auto px-4 py-16 text-center">
    <div class="bg-white rounded-2xl border border-gray-100 p-8 lg:p-12">
        <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
            <i data-lucide="check-circle" class="w-10 h-10 text-green-500"></i>
        </div>

        <h1 class="text-2xl font-bold text-navy-900 mb-3">Pesanan Berhasil Dibuat!</h1>

        @if($orderNumber)
            <p class="text-gray-500 mb-2">Nomor Pesanan Anda:</p>
            <p class="text-xl font-bold text-navy-800 bg-navy-50 inline-block px-6 py-2 rounded-lg mb-6">{{ $orderNumber }}</p>
        @endif

        <p class="text-gray-600 mb-8 leading-relaxed">
            Silakan lanjutkan ke WhatsApp untuk konfirmasi pesanan dan pembayaran Anda.
            Tim kami akan segera merespons pesanan Anda.
        </p>

        <div class="space-y-3">
            @if($whatsappUrl)
            <a href="{{ $whatsappUrl }}" target="_blank"
               class="block w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-3.5 rounded-lg transition flex items-center justify-center gap-2">
                <i data-lucide="message-circle" class="w-5 h-5"></i>
                Konfirmasi via WhatsApp
            </a>
            @endif

            <a href="{{ route('products.index') }}"
               class="block w-full bg-navy-100 hover:bg-navy-200 text-navy-800 font-medium py-3 rounded-lg transition">
                Lanjut Belanja
            </a>

            <a href="{{ route('home') }}" class="block text-sm text-gray-500 hover:text-navy-700 transition mt-2">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</div>
@endsection
