@extends('layouts.app')

@section('title', 'Kelola Kategori - SILAFCO Sucofindo')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-xl font-bold text-[#0B2A4A]">Kelola Kategori Layanan</h1>
        <p class="text-xs text-slate-500 mt-1">Daftar kategori utama yang menaungi produk atau layanan</p>
    </div>
    <a href="{{ route('admin.category_create') }}" class="px-4 py-2 bg-[#0B2A4A] hover:bg-[#081e36] text-white rounded-lg text-xs font-semibold shadow-sm transition">
        + Tambah Kategori
    </a>
</div>

@if(session('success'))
    <div class="mb-4 p-3 bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-lg text-xs font-medium">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-lg shadow-sm border border-slate-200 overflow-hidden">
    <table class="w-full text-left border-collapse text-xs">
        <thead>
            <tr class="bg-slate-50 text-slate-600 border-b border-slate-200">
                <th class="p-3 font-semibold">Nama Kategori</th>
                <th class="p-3 font-semibold">Slug (URL)</th>
                <th class="p-3 font-semibold">Deskripsi</th>
                <th class="p-3 font-semibold text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-200">
            @forelse($categories as $cat)
                <tr class="hover:bg-slate-50/50 transition">
                    <td class="p-3 font-bold text-[#0B2A4A]">{{ $cat->nama }}</td>
                    <td class="p-3 text-slate-500 font-mono">{{ $cat->slug }}</td>
                    <td class="p-3 text-slate-600">{{ $cat->deskripsi ?? '-' }}</td>
                    <td class="p-3 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.category_edit', $cat->id) }}" class="px-2.5 py-1 bg-amber-500 hover:bg-amber-600 text-white rounded text-[11px] font-medium transition">Edit</a>
                            <form action="{{ route('admin.category_destroy', $cat->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus kategori ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="px-2.5 py-1 bg-red-600 hover:bg-red-700 text-white rounded text-[11px] font-medium transition">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="p-6 text-center text-slate-400">Belum ada kategori tersedia.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection