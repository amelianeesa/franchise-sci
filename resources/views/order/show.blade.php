@extends('layouts.app')

@section('title', 'Detail Order ' . $order->kode_order . ' - SILAFCO')

@section('content')
<div class="max-w-5xl space-y-6">

    <div class="space-y-1">
        <p class="font-mono-code text-xs text-slate-400">DETAIL ORDER</p>
        <div class="flex items-center gap-2">
            <a href="{{ route('dashboard') }}"
                class="p-2 -ml-2 text-slate-500 hover:text-slate-800 hover:bg-slate-100 rounded-md transition shrink-0"
                title="Kembali ke Dashboard">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <h1 class="text-2xl font-semibold text-[#0B2A4A] font-mono-code">{{ $order->kode_order }}</h1>
        </div>
    </div>

    @if (session('success'))
        <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs rounded-md">
            {{ session('success') }}
        </div>
    @endif

    @php
        $badgeClass = match($order->status) {
            'lunas', 'selesai' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
            'menunggu_pembayaran' => 'bg-[#B8872F]/10 text-[#9c7327] border-[#B8872F]/30',
            'ditolak', 'dibatalkan' => 'bg-rose-50 text-rose-700 border-rose-200',
            default => 'bg-[#0B2A4A]/5 text-[#0B2A4A] border-[#0B2A4A]/20',
        };

        $steps = [
            'Diajukan',
            'Disetujui, PO Terbit',
            'Dikerjakan',
            'Menunggu Pembayaran',
            'Lunas & Selesai',
        ];

        $stepIndex = match($order->status) {
            'pengajuan' => 0,
            'menunggu_persetujuan_penawaran', 'po_terbit' => 1,
            'dikerjakan' => 2,
            'menunggu_pembayaran' => 3,
            'lunas', 'selesai' => 4,
            default => null,
        };
    @endphp

    <div class="bg-white rounded-lg border border-slate-200 p-6 space-y-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 pb-6 border-b border-slate-200 text-xs">
            <div>
                <span class="text-slate-400 block mb-1.5">Layanan / Produk</span>
                @if($order->product?->category?->nama)
                    <span class="inline-block text-[10px] font-medium text-[#0B2A4A] bg-[#0B2A4A]/5 border border-[#0B2A4A]/20 rounded px-2 py-0.5 mb-1.5">
                        {{ $order->product->category->nama }}
                    </span>
                @endif
                <span class="font-semibold text-slate-800 text-sm block">{{ $order->product?->nama_produk ?? '-' }}</span>
            </div>
            <div>
                <span class="text-slate-400 block mb-1">Cabang Penanggung Jawab</span>
                <span class="font-semibold text-slate-800 text-sm">{{ $order->branch?->nama_cabang ?? '-' }}</span>
            </div>
            <div>
                <span class="text-slate-400 block mb-1">Tanggal Pengajuan</span>
                <span class="font-semibold text-slate-800">{{ $order->created_at->format('d F Y, H:i') }} WIB</span>
            </div>
            <div>
                <span class="text-slate-400 block mb-1">Status Order</span>
                <span class="inline-block px-2.5 py-1 rounded border text-[11px] font-semibold {{ $badgeClass }}">
                    {{ Str::headline($order->status) }}
                </span>
            </div>
        </div>

        <div class="pb-6 border-b border-slate-200">
            <span class="text-slate-400 text-xs block mb-6">Progres Order</span>

            @if($stepIndex !== null)
                <div class="relative">
                    <div class="absolute top-2.5 left-0 right-0 h-0.5 bg-slate-200"></div>
                    <div class="absolute top-2.5 left-0 h-0.5 bg-[#0B2A4A] transition-all" style="width: {{ $stepIndex / (count($steps) - 1) * 100 }}%"></div>
                    <div class="relative flex justify-between">
                        @foreach($steps as $i => $label)
                            <div class="flex flex-col items-center text-center px-1" style="width: {{ 100 / count($steps) }}%">
                                <span class="w-5 h-5 rounded-full border-2 border-white shrink-0
                                    {{ $i < $stepIndex ? 'bg-[#0B2A4A]' : ($i === $stepIndex ? 'bg-[#B8872F]' : 'bg-slate-200') }}">
                                </span>
                                <span class="text-[11px] mt-2 leading-tight {{ $i <= $stepIndex ? 'text-slate-800 font-medium' : 'text-slate-400' }}">
                                    {{ $label }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="p-3 bg-rose-50 border border-rose-200 rounded-md text-xs text-rose-700">
                    Order ini berstatus <strong>{{ Str::headline($order->status) }}</strong> dan tidak dilanjutkan prosesnya.
                </div>
            @endif
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