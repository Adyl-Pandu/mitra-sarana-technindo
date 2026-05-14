@extends('layouts.admin')
@section('title', 'Detail Pesanan #' . $order->order_number)

@section('content')
<a href="{{ route('admin.orders.index') }}" class="inline-flex items-center gap-1 text-sm text-gray-500 hover:text-navy-700 mb-6">
    <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali ke Daftar Pesanan
</a>

<div class="grid lg:grid-cols-3 gap-6">
    {{-- Order Info --}}
    <div class="lg:col-span-2 space-y-6">
        {{-- Items --}}
        <div class="bg-white rounded-xl border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="font-semibold text-navy-900">Item Pesanan</h3>
            </div>
            <table class="w-full text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="text-left px-6 py-2.5 font-medium text-gray-600">Produk</th>
                        <th class="text-center px-4 py-2.5 font-medium text-gray-600">Qty</th>
                        <th class="text-right px-4 py-2.5 font-medium text-gray-600">Harga</th>
                        <th class="text-right px-6 py-2.5 font-medium text-gray-600">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($order->items as $item)
                    <tr>
                        <td class="px-6 py-3 font-medium text-navy-900">{{ $item->product_name }}</td>
                        <td class="px-4 py-3 text-center">{{ $item->quantity }}</td>
                        <td class="px-4 py-3 text-right text-gray-600">Rp {{ number_format($item->product_price, 0, ',', '.') }}</td>
                        <td class="px-6 py-3 text-right font-medium text-navy-800">{{ $item->formatted_subtotal }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="bg-navy-50">
                        <td colspan="3" class="px-6 py-3 text-right font-semibold text-navy-900">Total</td>
                        <td class="px-6 py-3 text-right text-lg font-bold text-navy-900">{{ $order->formatted_total }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        {{-- Customer Info --}}
        <div class="bg-white rounded-xl border border-gray-100 p-6">
            <h3 class="font-semibold text-navy-900 mb-4">Data Pelanggan</h3>
            <div class="grid sm:grid-cols-2 gap-4 text-sm">
                <div>
                    <p class="text-gray-500 mb-0.5">Nama</p>
                    <p class="font-medium text-navy-900">{{ $order->customer_name }}</p>
                </div>
                <div>
                    <p class="text-gray-500 mb-0.5">Telepon</p>
                    <p class="font-medium text-navy-900">{{ $order->customer_phone }}</p>
                </div>
                @if($order->customer_email)
                <div>
                    <p class="text-gray-500 mb-0.5">Email</p>
                    <p class="font-medium text-navy-900">{{ $order->customer_email }}</p>
                </div>
                @endif
                <div class="sm:col-span-2">
                    <p class="text-gray-500 mb-0.5">Alamat</p>
                    <p class="font-medium text-navy-900">{{ $order->customer_address }}</p>
                </div>
                @if($order->notes)
                <div class="sm:col-span-2">
                    <p class="text-gray-500 mb-0.5">Catatan</p>
                    <p class="text-navy-800">{{ $order->notes }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Sidebar --}}
    <div class="space-y-6">
        {{-- Status --}}
        <div class="bg-white rounded-xl border border-gray-100 p-6">
            <h3 class="font-semibold text-navy-900 mb-4">Status Pesanan</h3>
            <span class="inline-block px-3 py-1 text-sm font-medium rounded-full mb-4
                @switch($order->status_color)
                    @case('yellow') bg-yellow-100 text-yellow-700 @break
                    @case('blue') bg-blue-100 text-blue-700 @break
                    @case('indigo') bg-indigo-100 text-indigo-700 @break
                    @case('green') bg-green-100 text-green-700 @break
                    @case('red') bg-red-100 text-red-700 @break
                @endswitch">
                {{ $order->status_label }}
            </span>

            <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST">
                @csrf @method('PATCH')
                <label class="block text-sm font-medium text-gray-700 mb-2">Ubah Status</label>
                <select name="status" class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm outline-none focus:ring-2 focus:ring-navy-300 mb-3">
                    @foreach(\App\Models\Order::STATUS_LABELS as $key => $label)
                        <option value="{{ $key }}" {{ $order->status == $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                <button type="submit" class="w-full bg-sky-500 hover:bg-sky-600 text-white font-medium py-2.5 rounded-lg transition text-sm">
                    Perbarui Status
                </button>
            </form>
        </div>

        {{-- Timeline --}}
        <div class="bg-white rounded-xl border border-gray-100 p-6">
            <h3 class="font-semibold text-navy-900 mb-4">Riwayat</h3>
            <div class="space-y-3 text-sm">
                <div class="flex items-center gap-3">
                    <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                    <div>
                        <p class="text-gray-700">Pesanan dibuat</p>
                        <p class="text-xs text-gray-400">{{ $order->created_at->format('d M Y H:i') }}</p>
                    </div>
                </div>
                @if($order->confirmed_at)
                <div class="flex items-center gap-3">
                    <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                    <div>
                        <p class="text-gray-700">Dikonfirmasi</p>
                        <p class="text-xs text-gray-400">{{ $order->confirmed_at->format('d M Y H:i') }}</p>
                    </div>
                </div>
                @endif
                @if($order->shipped_at)
                <div class="flex items-center gap-3">
                    <div class="w-2 h-2 bg-indigo-500 rounded-full"></div>
                    <div>
                        <p class="text-gray-700">Dikirim</p>
                        <p class="text-xs text-gray-400">{{ $order->shipped_at->format('d M Y H:i') }}</p>
                    </div>
                </div>
                @endif
                @if($order->completed_at)
                <div class="flex items-center gap-3">
                    <div class="w-2 h-2 bg-emerald-500 rounded-full"></div>
                    <div>
                        <p class="text-gray-700">Selesai</p>
                        <p class="text-xs text-gray-400">{{ $order->completed_at->format('d M Y H:i') }}</p>
                    </div>
                </div>
                @endif
            </div>
        </div>

        {{-- WhatsApp --}}
        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $order->customer_phone) }}" target="_blank"
           class="block w-full bg-green-500 hover:bg-green-600 text-white font-medium py-3 rounded-lg transition text-sm text-center flex items-center justify-center gap-2">
            <i data-lucide="message-circle" class="w-4 h-4"></i> Hubungi Pelanggan
        </a>
    </div>
</div>
@endsection
