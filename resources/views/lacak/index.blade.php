@extends('layouts.app')

@section('title', 'Lacak Order - SILAFCO Sucofindo')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">
    <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200/80">
        <h2 class="text-lg font-bold text-[#0B2A4A] mb-4">Lacak Status Order</h2>
        <form action="{{ route('lacak.search') }}" method="POST" class="flex flex-col sm:flex-row gap-3">
            @csrf
            <div class="flex-1 relative">
                <input type="text" name="kode_order" value="{{ old('kode_order', $kodeOrder) }}"
                    placeholder="Masukkan Kode Order (Contoh: ORD/KDI/2026/09/0001)"
                    class="w-full px-4 py-2.5 rounded-lg border border-slate-300 text-xs focus:ring-2 focus:ring-[#0B2A4A] focus:border-[#0B2A4A] outline-none transition uppercase">
                @error('kode_order')
                    <span class="text-red-500 text-[11px] mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex items-center gap-2">
                <button type="submit"
                    class="px-6 py-2.5 bg-[#0B2A4A] hover:bg-[#071d33] text-white text-xs font-semibold rounded-lg transition shadow-sm flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <span>Cari Order</span>
                </button>

                @if($kodeOrder)
                    <a href="{{ route('lacak.index') }}"
                        class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-semibold rounded-lg transition border border-slate-200 flex items-center justify-center gap-1.5"
                        title="Reset Pencarian">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                        <span>Reset</span>
                    </a>
                @endif
            </div>
        </form>

        @if(isset($recentOrders) && $recentOrders->count() > 0)
            <div class="mt-6 pt-5 border-t border-slate-100">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-[11px] font-semibold text-slate-500 uppercase tracking-wider">
                        Riwayat Order Terakhir Anda
                    </span>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                    @foreach($recentOrders as $item)
                        <a href="{{ route('lacak.index', ['kode_order' => $item->kode_order]) }}"
                            class="p-3 rounded-lg border border-slate-200 hover:border-[#0B2A4A] bg-slate-50/50 hover:bg-white transition group flex flex-col justify-between">
                            <div>
                                <div class="flex items-center justify-between gap-2 mb-1">
                                    <span class="text-xs font-bold text-[#0B2A4A] font-mono-code group-hover:text-[#B8872F] transition">
                                        {{ $item->kode_order }}
                                    </span>
                                    <span class="px-2 py-0.5 text-[9px] font-semibold rounded-full shrink-0 {{ $item->statusBadgeClass() }}">
                                        {{ strtoupper(str_replace('_', ' ', $item->status)) }}
                                    </span>
                                </div>
                                <p class="text-[11px] text-slate-600 font-medium truncate">
                                    {{ $item->product->nama_produk ?? '-' }}
                                </p>
                            </div>
                            <div class="mt-2 text-[10px] text-slate-400 flex items-center justify-between pt-2 border-t border-slate-100">
                                <span>{{ $item->created_at ? $item->created_at->format('d M Y') : '-' }}</span>
                                <span class="text-[#0B2A4A] font-semibold group-hover:underline">Lacak</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    @if($kodeOrder && !$order)
        <div class="bg-amber-50 border border-amber-200 text-amber-800 p-4 rounded-xl text-xs flex items-center gap-3">
            <svg class="w-5 h-5 text-amber-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            <div>
                Data order dengan kode <span class="font-bold">{{ $kodeOrder }}</span> tidak ditemukan. Mohon periksa kembali kode order yang Anda masukkan.
            </div>
        </div>
    @endif

    @if($order)
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200/80 space-y-8">
            <div>
                <div class="flex flex-col sm:flex-row sm:items-center justify-between border-b border-slate-100 pb-4 gap-2">
                    <div>
                        <span class="text-[10px] font-semibold uppercase tracking-wider text-slate-400">Kode Order</span>
                        <h3 class="text-base font-bold text-[#0B2A4A] font-mono-code">{{ $order->kode_order }}</h3>
                    </div>
                    <div>
                        <span class="px-3 py-1 text-[11px] font-semibold rounded-full {{ $order->statusBadgeClass() }}">
                            {{ strtoupper(str_replace('_', ' ', $order->status)) }}
                        </span>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 text-xs mt-4">
                    <div>
                        <span class="text-slate-400 block text-[10px]">Tipe / Jenis Layanan</span>
                        <span class="font-semibold text-[#0B2A4A]">
                            {{ $order->product->kategori->nama_kategori ?? $order->product->kategori ?? $order->product->tipe_layanan ?? 'Pengujian & Inspeksi' }}
                        </span>
                    </div>
                    <div>
                        <span class="text-slate-400 block text-[10px]">Layanan / Produk</span>
                        <span class="font-semibold text-slate-700">{{ $order->product->nama_produk ?? '-' }}</span>
                    </div>
                    <div>
                        <span class="text-slate-400 block text-[10px]">Cabang Pelaksana</span>
                        <span class="font-semibold text-slate-700">{{ $order->branch->nama_cabang ?? '-' }}</span>
                    </div>
                    <div>
                        <span class="text-slate-400 block text-[10px]">Pemohon</span>
                        <span class="font-semibold text-slate-700">{{ $order->customer->name ?? '-' }}</span>
                    </div>
                </div>

                @if($order->status === 'ditolak')
                    <div class="mt-4 p-4 bg-rose-50 border border-rose-200 rounded-lg">
                        <div class="flex items-start gap-2.5">
                            <svg class="w-4 h-4 text-rose-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                            <div>
                                <p class="text-xs font-bold text-rose-700">Order Ditolak oleh Admin Pusat</p>
                                <p class="text-xs text-rose-600 mt-1 leading-relaxed">
                                    @if($order->alasan_penolakan)
                                        <span class="font-semibold">Catatan Admin:</span> {{ $order->alasan_penolakan }}
                                    @else
                                        Alasan penolakan belum dicantumkan oleh admin.
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="pt-6 border-t border-slate-100">
                <h3 class="text-xs font-bold uppercase tracking-wider text-[#0B2A4A] mb-8">
                    RIWAYAT PERKEMBANGAN PROGRES
                </h3>

                @php
                    $steps = [
                        'Pengajuan Disampaikan',
                        'Verifikasi',
                        'Pengujian Berlangsung',
                        'Tagihan & Pembayaran',
                        'Sertifikat / Laporan Terbit',
                    ];
                    $currentStepIndex = $order->currentStepIndex();
                @endphp

                @if($order->status === 'ditolak')
                    <div class="flex items-center gap-3 p-4 bg-rose-50 border border-rose-200 rounded-lg">
                        <div class="w-8 h-8 rounded-full bg-rose-600 flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </div>
                        <p class="text-xs font-semibold text-rose-700">Proses order dihentikan karena pengajuan ditolak oleh Admin Pusat.</p>
                    </div>
                @else
                    @php
                        $stepCount = count($steps);
                        $progressPercent = $stepCount > 1 ? ($currentStepIndex / ($stepCount - 1)) * 100 : 0;
                        $edgeInset = 100 / ($stepCount * 2);
                    @endphp

                    <div class="relative w-full">
                        <div class="absolute h-0.5 bg-slate-200 top-4"
                            style="left: {{ $edgeInset }}%; right: {{ $edgeInset }}%;"></div>
                        <div class="absolute h-0.5 bg-[#0B2A4A] top-4 transition-all duration-500"
                            style="left: {{ $edgeInset }}%; width: calc({{ 100 - 2 * $edgeInset }}% * {{ $progressPercent / 100 }});"></div>

                        <div class="relative flex items-start justify-between">
                            @foreach($steps as $index => $stepTitle)
                                @php
                                    $isCompleted = $index < $currentStepIndex;
                                    $isCurrent = $index === $currentStepIndex;
                                @endphp

                                <div class="flex flex-col items-center text-center" style="width: {{ 100 / $stepCount }}%;">
                                    <div class="w-8 h-8 rounded-full border-2 flex items-center justify-center shrink-0 z-10 bg-white transition-all duration-300
                                        {{ $isCurrent || $isCompleted ? 'bg-[#0B2A4A] border-[#0B2A4A] text-white shadow-md ring-4 ring-[#0B2A4A]/10' : 'border-slate-300 text-slate-400' }}">
                                        @if($isCompleted)
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                            </svg>
                                        @else
                                            <span class="text-xs font-semibold">{{ $index + 1 }}</span>
                                        @endif
                                    </div>

                                    <div class="px-2 mt-3">
                                        <p class="text-xs font-semibold {{ $isCurrent || $isCompleted ? 'text-[#0B2A4A]' : 'text-slate-400' }}">
                                            {{ $stepTitle }}
                                        </p>
                                        <p class="text-[10px] mt-1 {{ $isCurrent ? 'text-amber-600 font-medium' : 'text-slate-400' }}">
                                            @if($isCurrent)
                                                Tahap saat ini sedang berlangsung
                                            @elseif($isCompleted)
                                                Selesai
                                            @else
                                                Tahap selanjutnya
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endif
</div>
@endsection