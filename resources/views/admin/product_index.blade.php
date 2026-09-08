@extends('layouts.app')

@section('title', 'Manajemen Layanan - SILAFCO Sucofindo')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-xl font-bold text-[#0B2A4A]">Manajemen Layanan & Produk</h1>
        <p class="text-xs text-slate-500 mt-1">Kelola daftar layanan, deskripsi, dan harga dasar yang akan tampil pada pilihan order pelanggan.</p>
    </div>
    <a href="{{ route('admin.products.create') }}" class="px-4 py-2 bg-[#0B2A4A] hover:bg-[#081e36] text-white rounded-lg text-xs font-semibold shadow-sm transition">
        + Tambah Layanan Baru
    </a>
</div>

@if(session('success'))
    <div class="mb-4 p-3 bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-lg text-xs font-medium">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-lg shadow-sm border border-slate-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse text-xs">
            <thead>
                <tr class="bg-slate-50 text-slate-600 border-b border-slate-200">
                    <th class="p-3 font-semibold">Nama Layanan</th>
                    <th class="p-3 font-semibold">Kategori</th>
                    <th class="p-3 font-semibold">Harga Dasar</th>
                    <th class="p-3 font-semibold">Satuan</th>
                    <th class="p-3 font-semibold text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @forelse($products as $product)
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="p-3">
                            <div class="font-bold text-[#0B2A4A]">{{ $product->nama_produk }}</div>
                            <div class="text-[11px] text-slate-400 truncate max-w-xs">{{ $product->deskripsi ?? '-' }}</div>
                        </td>
                        <td class="p-3">
                            <span class="px-2 py-0.5 bg-slate-100 text-slate-700 rounded text-[11px] font-medium">
                                {{ $product->category->nama ?? '-' }}
                            </span>
                        </td>
                        <td class="p-3 font-semibold text-emerald-600">Rp {{ number_format($product->harga_dasar, 0, ',', '.') }}</td>
                        <td class="p-3 text-slate-600">{{ $product->satuan ?? '-' }}</td>
                        <td class="p-3 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="px-2.5 py-1 bg-amber-500 hover:bg-amber-600 text-white rounded text-[11px] font-medium transition">
                                    Edit
                                </a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus layanan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-2.5 py-1 bg-red-600 hover:bg-red-700 text-white rounded text-[11px] font-medium transition">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-6 text-center text-slate-400">Belum ada data layanan tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection