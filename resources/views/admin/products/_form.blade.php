<div class="grid gap-6 lg:grid-cols-3">
    <div class="space-y-6 lg:col-span-2">
        <div class="p-6 bg-white border border-gray-100 rounded-xl">
            <h3 class="mb-4 font-semibold text-navy-900">Informasi Produk</h3>
            <div class="space-y-4">
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Nama Produk <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="name" required value="{{ old('name', $product->name ?? '') }}"
                        class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-navy-300">
                    @error('name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">SKU</label>
                        <input type="text" name="sku" value="{{ old('sku', $product->sku ?? '') }}"
                            class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-navy-300">
                    </div>
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">Kategori <span
                                class="text-red-500">*</span></label>
                        <select name="category_id" required
                            class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-navy-300">
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id ?? '') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea name="description" rows="4"
                        class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-navy-300 resize-none">{{ old('description', $product->description ?? '') }}</textarea>
                </div>
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Spesifikasi</label>
                    <textarea name="specifications" rows="4" placeholder="Pisahkan tiap spesifikasi dengan baris baru"
                        class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-navy-300 resize-none">{{ old('specifications', $product->specifications ?? '') }}</textarea>
                </div>
            </div>
        </div>

        {{-- SEO --}}
        <div class="p-6 bg-white border border-gray-100 rounded-xl">
            <h3 class="flex items-center gap-2 mb-4 font-semibold text-navy-900">
                <i data-lucide="search" class="w-4 h-4 text-gray-400"></i> SEO (Opsional)
            </h3>
            <div class="space-y-4">
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Meta Title <span
                            class="text-xs text-gray-400">(maks. 70 karakter)</span></label>
                    <input type="text" name="meta_title" maxlength="70"
                        value="{{ old('meta_title', $product->meta_title ?? '') }}"
                        class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-navy-300"
                        placeholder="Otomatis jika dikosongkan">
                </div>
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Meta Description <span
                            class="text-xs text-gray-400">(maks. 160 karakter)</span></label>
                    <textarea name="meta_description" rows="2" maxlength="160"
                        class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-navy-300 resize-none"
                        placeholder="Otomatis jika dikosongkan">{{ old('meta_description', $product->meta_description ?? '') }}</textarea>
                </div>
            </div>
        </div>
    </div>

    <div class="space-y-6">
        {{-- Pricing & Stock --}}
        <div class="p-6 bg-white border border-gray-100 rounded-xl">
            <h3 class="mb-4 font-semibold text-navy-900">Harga & Stok</h3>
            <div class="space-y-4">
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Harga (Rp) <span
                            class="text-red-500">*</span></label>
                    <input type="number" name="price" required min="0" step="1"
                        value="{{ old('price', $product ? intval($product->price) : '') }}"
                        class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-navy-300">
                </div>
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Stok <span
                            class="text-red-500">*</span></label>
                    <input type="number" name="stock" required min="0" value="{{ old('stock', $product->stock ?? 0) }}"
                        class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-navy-300">
                </div>
            </div>
        </div>

        {{-- Image --}}
        <div class="p-6 bg-white border border-gray-100 rounded-xl">
            <h3 class="mb-4 font-semibold text-navy-900">Foto Produk</h3>
            @if($product && $product->image)
                <div class="mb-3 overflow-hidden bg-gray-100 rounded-lg aspect-square">
                    <img src="{{ asset('storage/' . $product->image) }}" class="object-cover w-full h-full">
                </div>
            @endif
            <input type="file" name="image" accept="image/*"
                class="w-full text-sm text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-navy-100 file:text-navy-700 hover:file:bg-navy-200">
            <p class="mt-2 text-xs text-gray-400">Format: JPG, PNG, WebP. Maks 2MB.</p>
        </div>

        {{-- Status --}}
        <div class="p-6 bg-white border border-gray-100 rounded-xl">
            <h3 class="mb-4 font-semibold text-navy-900">Status</h3>

            {{-- is_active --}}
            <input type="hidden" name="is_active" value="0">

            <label class="flex items-center gap-3 mb-3 cursor-pointer">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active ?? 1) ? 'checked' : '' }} class="border-gray-300 rounded text-navy-800 focus:ring-navy-300">

                <span class="text-sm text-gray-700">Produk Aktif</span>
            </label>

            {{-- is_featured --}}
            <input type="hidden" name="is_featured" value="0">

            <label class="flex items-center gap-3 cursor-pointer">
                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $product->is_featured ?? 0) ? 'checked' : '' }} class="border-gray-300 rounded text-navy-800 focus:ring-navy-300">

                <span class="text-sm text-gray-700">Produk Unggulan</span>
            </label>
        </div>

        {{-- Actions --}}
        <div class="flex gap-3">
            <button type="submit"
                class="flex-1 py-3 text-sm font-medium text-white transition rounded-lg bg-sky-500 hover:bg-sky-600">
                {{ $product ? 'Simpan Perubahan' : 'Tambah Produk' }}
            </button>
            <a href="{{ route('admin.products.index') }}"
                class="px-5 py-3 text-sm text-gray-600 transition border border-gray-200 rounded-lg hover:bg-gray-50">
                Batal
            </a>
        </div>
    </div>
</div>