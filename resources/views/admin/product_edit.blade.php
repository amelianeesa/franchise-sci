@extends('layouts.app')

@section('title', 'Edit Layanan - SILAFCO Sucofindo')

@section('content')
<div class="mb-6">
    <h1 class="text-xl font-bold text-[#0B2A4A]">Edit Layanan</h1>
    <p class="text-xs text-slate-500 mt-1">Perbarui informasi layanan, deskripsi, atau harga dasar.</p>
</div>

<div class="bg-white p-6 rounded-lg shadow-sm border border-slate-200 max-w-2xl">
    <form action="{{ route('admin.product_update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label class="block text-xs font-semibold text-slate-700 mb-1">Kategori Layanan</label>
            <select name="service_category_id" class="w-full p-2.5 border border-slate-200 rounded-lg text-xs outline-none focus:border-[#0B2A4A]" required>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $product->service_category_id == $cat->id ? 'selected' : '' }}>{{ $cat->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-xs font-semibold text-slate-700 mb-1">Nama Layanan / Produk</label>
            <input type="text" name="nama_produk" value="{{ $product->nama_produk }}" class="w-full p-2.5 border border-slate-200 rounded-lg text-xs outline-none focus:border-[#0B2A4A]" required>
        </div>

        <div class="mb-4">
            <label class="block text-xs font-semibold text-slate-700 mb-1">Deskripsi Layanan</label>
            <textarea name="deskripsi" rows="3" class="w-full p-2.5 border border-slate-200 rounded-lg text-xs outline-none focus:border-[#0B2A4A]">{{ $product->deskripsi }}</textarea>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-6">
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Harga Dasar (Rp)</label>
                <input type="number" name="harga_dasar" value="{{ $product->harga_dasar }}" class="w-full p-2.5 border border-slate-200 rounded-lg text-xs outline-none focus:border-[#0B2A4A]" required>
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Satuan (Opsional)</label>
                <input type="text" name="satuan" value="{{ $product->satuan }}" class="w-full p-2.5 border border-slate-200 rounded-lg text-xs outline-none focus:border-[#0B2A4A]">
            </div>
        </div>

        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('admin.product_index') }}" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg text-xs font-semibold transition">Batal</a>
            <button type="submit" class="px-4 py-2 bg-[#0B2A4A] hover:bg-[#081e36] text-white rounded-lg text-xs font-semibold transition">Perbarui Layanan</button>
        </div>
    </form>
</div>
@endsection