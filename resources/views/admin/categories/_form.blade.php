<div class="p-6 space-y-4 bg-white border border-gray-100 rounded-xl">
    <div>
        <label class="block mb-1 text-sm font-medium text-gray-700">Nama Kategori <span class="text-red-500">*</span></label>
        <input type="text" name="name" required value="{{ old('name', $category->name ?? '') }}"
               class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-navy-300">
        @error('name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="block mb-1 text-sm font-medium text-gray-700">Deskripsi</label>
        <textarea name="description" rows="3" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-navy-300 resize-none">{{ old('description', $category->description ?? '') }}</textarea>
    </div>
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Meta Title</label>
            <input type="text" name="meta_title" maxlength="70" value="{{ old('meta_title', $category->meta_title ?? '') }}"
                   class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-navy-300" placeholder="Otomatis">
        </div>
        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Urutan</label>
            <input type="number" name="sort_order" min="0" value="{{ old('sort_order', $category->sort_order ?? 0) }}"
                   class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-navy-300">
        </div>
    </div>
    <div>
        <label class="block mb-1 text-sm font-medium text-gray-700">Meta Description</label>
        <textarea name="meta_description" rows="2" maxlength="160" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-navy-300 resize-none" placeholder="Otomatis">{{ old('meta_description', $category->meta_description ?? '') }}</textarea>
    </div>
    <div>
        <label class="block mb-1 text-sm font-medium text-gray-700">Gambar Kategori</label>
        @if($category && $category->image)
            <img src="{{ asset('storage/' . $category->image) }}" class="object-cover w-24 h-24 mb-2 rounded-lg">
        @endif
        <input type="file" name="image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-navy-100 file:text-navy-700">
    </div>
    <input type="hidden" name="is_active" value="0">

    <label class="flex items-center gap-3 cursor-pointer">
        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $category->is_active ?? 1) ? 'checked' : '' }}
            class="border-gray-300 rounded text-navy-800">

        <span class="text-sm text-gray-700">Kategori Aktif</span>
    </label>
    <div class="flex gap-3 pt-2">
        <button type="submit" type="hidden" class="px-6 py-3 text-sm font-medium text-white transition rounded-lg bg-sky-500 hover:bg-sky-600">
            {{ $category ? 'Simpan Perubahan' : 'Tambah Kategori' }}
        </button>
        <a href="{{ route('admin.categories.index') }}" class="px-5 py-3 text-sm text-gray-600 transition border border-gray-200 rounded-lg hover:bg-gray-50">Batal</a>
    </div>
</div>
