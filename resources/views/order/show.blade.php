@extends('layouts.app')

@section('title', 'Detail Order ' . $order->kode_order . ' - SILAFCO')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-10 space-y-6">

    <div class="flex items-center justify-between pb-6 border-b border-slate-200">
        <div>
            <p class="font-mono-code text-xs text-slate-400 mb-1">DETAIL ORDER</p>
            <h1 class="text-2xl font-semibold text-[#0B2A4A] font-mono-code">{{ $order->kode_order }}</h1>
        </div>
        <a href="{{ route('order.index') }}" class="text-xs font-semibold text-slate-600 hover:text-slate-800 transition">
            ← Kembali ke daftar order
        </a>
    </div>

    @if (session('success'))
        <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs rounded-md">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-md border border-slate-200 p-6 space-y-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pb-6 border-b border-slate-200 text-xs">
            <div>
                <span class="text-slate-400 block mb-1">Layanan / Produk</span>
                <span class="font-semibold text-slate-800 text-sm">{{ $order->product->nama_produk ?? '-' }}</span>
            </div>
            <div>
                <span class="text-slate-400 block mb-1">Cabang Penanggung Jawab</span>
                <span class="font-semibold text-slate-800 text-sm">{{ $order->branch->nama_cabang ?? '-' }}</span>
            </div>
            <div>
                <span class="text-slate-400 block mb-1">Tanggal Pengajuan</span>
                <span class="font-semibold text-slate-800">{{ $order->created_at->format('d F Y, H:i') }} WIB</span>
            </div>
            <div>
                <span class="text-slate-400 block mb-1">Status Order</span>
                <span class="inline-block px-2.5 py-1 rounded border text-[11px] font-semibold capitalize bg-amber-50 text-amber-700 border-amber-200">
                    {{ $order->status }}
                </span>
            </div>
        </div>

        <div class="text-xs space-y-2">
            <span class="text-slate-400 block">Catatan Pelanggan:</span>
            <p class="p-3 bg-slate-50 border border-slate-200 rounded-md text-slate-700 leading-relaxed">
                {{ $order->catatan_pelanggan ?? 'Tidak ada catatan tambahan.' }}
            </p>
        </div>
    </div>

</div>
@endsection