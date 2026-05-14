@extends('layouts.app')

@section('meta_title', 'Checkout - PT Mitra Sarana Technindo')

@section('content')
<div class="bg-white border-b">
    <div class="max-w-7xl mx-auto px-4 py-4">
        <nav class="flex items-center gap-2 text-sm text-gray-500">
            <a href="{{ route('home') }}" class="hover:text-navy-700">Beranda</a>
            <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
            <a href="{{ route('cart.index') }}" class="hover:text-navy-700">Keranjang</a>
            <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
            <span class="text-navy-800 font-medium">Checkout</span>
        </nav>
    </div>
</div>

<div class="max-w-5xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-navy-900 mb-6">Checkout</h1>

    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf
        <div class="grid lg:grid-cols-5 gap-8">
            {{-- Form --}}
            <div class="lg:col-span-3">
                <div class="bg-white rounded-xl border border-gray-100 p-6">
                    <h2 class="text-lg font-semibold text-navy-900 mb-5 flex items-center gap-2">
                        <i data-lucide="user" class="w-5 h-5 text-navy-500"></i>
                        Data Pemesan
                    </h2>

                    <div class="space-y-4">
                        <div>
                            <label for="customer_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" name="customer_name" id="customer_name" required value="{{ old('customer_name') }}"
                                   class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-navy-300 focus:border-navy-400 outline-none"
                                   placeholder="Masukkan nama lengkap">
                            @error('customer_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="customer_phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon/WhatsApp <span class="text-red-500">*</span></label>
                            <input type="tel" name="customer_phone" id="customer_phone" required value="{{ old('customer_phone') }}"
                                   class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-navy-300 focus:border-navy-400 outline-none"
                                   placeholder="Contoh: 08123456789">
                            @error('customer_phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="customer_email" class="block text-sm font-medium text-gray-700 mb-1">Email (Opsional)</label>
                            <input type="email" name="customer_email" id="customer_email" value="{{ old('customer_email') }}"
                                   class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-navy-300 focus:border-navy-400 outline-none"
                                   placeholder="email@contoh.com">
                        </div>

                        <div>
                            <label for="customer_address" class="block text-sm font-medium text-gray-700 mb-1">Alamat Pengiriman <span class="text-red-500">*</span></label>
                            <textarea name="customer_address" id="customer_address" rows="3" required
                                      class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-navy-300 focus:border-navy-400 outline-none resize-none"
                                      placeholder="Masukkan alamat lengkap pengiriman">{{ old('customer_address') }}</textarea>
                            @error('customer_address') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Catatan (Opsional)</label>
                            <textarea name="notes" id="notes" rows="2"
                                      class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-navy-300 focus:border-navy-400 outline-none resize-none"
                                      placeholder="Catatan tambahan untuk pesanan Anda">{{ old('notes') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Order Summary --}}
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl border border-gray-100 p-6 sticky top-24">
                    <h2 class="text-lg font-semibold text-navy-900 mb-5 flex items-center gap-2">
                        <i data-lucide="clipboard-list" class="w-5 h-5 text-navy-500"></i>
                        Ringkasan Pesanan
                    </h2>

                    <div class="space-y-3 mb-5 max-h-64 overflow-y-auto">
                        @foreach($cartItems as $item)
                        <div class="flex justify-between items-start gap-3 text-sm">
                            <div class="min-w-0">
                                <p class="font-medium text-navy-800 truncate">{{ $item['product']->name }}</p>
                                <p class="text-gray-400 text-xs">{{ $item['quantity'] }} x {{ $item['product']->formatted_price }}</p>
                            </div>
                            <p class="font-medium text-navy-800 shrink-0">Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</p>
                        </div>
                        @endforeach
                    </div>

                    <div class="border-t border-gray-100 pt-4 mb-6">
                        <div class="flex justify-between items-center">
                            <span class="font-semibold text-navy-900">Total</span>
                            <span class="text-xl font-bold text-navy-900">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-3.5 rounded-lg transition flex items-center justify-center gap-2">
                        <i data-lucide="message-circle" class="w-5 h-5"></i>
                        Pesan via WhatsApp
                    </button>

                    <p class="text-xs text-gray-400 text-center mt-3">
                        Setelah menekan tombol, Anda akan diarahkan ke WhatsApp untuk konfirmasi pesanan dan pembayaran.
                    </p>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
