@extends('layouts.app')
@section('title', 'Tambah Kategori - SILAFCO Sucofindo')
@section('content')
<div class="mb-6"><h1 class="text-xl font-bold text-[#0B2A4A]">Tambah Kategori Baru</h1></div>
<div class="bg-white p-6 rounded-lg shadow-sm border border-slate-200 max-w-xl">
    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block text-xs font-semibold text-slate-700 mb-1">Nama Kategori</label>
            <input type="text" name="nama" class="w-full p-2.5 border border-slate-200 rounded-lg text-xs outline-none focus:border-[#0B2A4A]" placeholder="cth. Pengujian Laboratorium" required>
        </div>
        <div class="mb-4">
            <label class="block text-xs font-semibold text-slate-700 mb-1">Deskripsi (Opsional)</label>
            <textarea name="deskripsi" rows="3" class="w-full p-2.5 border border-slate-200 rounded-lg text-xs outline-none focus:border-[#0B2A4A]"></textarea>
        </div>
        <div class="flex justify-end gap-3">
            <a href="{{ route('admin.categories.index') }}" class="px-4 py-2 bg-slate-100 text-slate-700 rounded-lg text-xs font-semibold">Batal</a>
            <button type="submit" class="px-4 py-2 bg-[#0B2A4A] text-white rounded-lg text-xs font-semibold">Simpan</button>
        </div>
    </form>
</div>
@endsection