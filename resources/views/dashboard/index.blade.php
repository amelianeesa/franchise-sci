@extends('layouts.app')

@section('title', 'Dashboard Pelanggan - SILAFCO')

@section('content')
<div class="space-y-6 -mt-2">

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-[#0B2A4A] tracking-tight">Selamat datang, {{ $user->name }}</h1>
            <p class="text-xs text-slate-500 mt-1">Pantau status layanan, pengajuan, dan dokumen sertifikasi Anda secara real-time.</p>
        </div>
        <a href="{{ route('order.create') }}" class="px-5 py-2.5 bg-[#B8872F] hover:bg-[#a07427] text-white text-xs font-semibold rounded-lg shadow-sm transition w-fit flex items-center gap-1.5">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            <span>Buat Order Baru</span>
        </a>
    </div>

    @if(session('success'))
        <div class="p-3.5 bg-emerald-50 border border-emerald-200 rounded-lg text-xs text-emerald-700 flex items-center gap-2">
            <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Cards Statistics Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        <!-- Order Aktif -->
        <div class="bg-white border-t-4 border-t-[#0B2A4A] border-x border-b border-slate-200/80 rounded-xl p-5 shadow-sm flex items-center justify-between">
            <div class="space-y-1">
                <p class="text-xs font-medium text-slate-500">Order aktif</p>
                <h3 class="text-2xl font-bold text-[#0B2A4A]">{{ $stats['order_aktif'] }}</h3>
                <span class="inline-flex items-center gap-1.5 text-[11px] font-medium text-emerald-600 pt-1">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>Sedang berjalan
                </span>
            </div>
            <div class="w-11 h-11 rounded-xl bg-slate-100 text-[#0B2A4A] flex items-center justify-center shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            </div>
        </div>

        <!-- Menunggu Pembayaran -->
        <div class="bg-white border-t-4 border-t-[#B8872F] border-x border-b border-slate-200/80 rounded-xl p-5 shadow-sm flex items-center justify-between">
            <div class="space-y-1">
                <p class="text-xs font-medium text-slate-500">Menunggu pembayaran</p>
                <h3 class="text-2xl font-bold text-[#0B2A4A]">{{ $stats['menunggu_pembayaran'] }}</h3>
                <span class="inline-flex items-center gap-1.5 text-[11px] font-medium text-[#B8872F] pt-1">
                    <span class="w-2 h-2 rounded-full bg-[#B8872F]"></span>Perlu tindakan
                </span>
            </div>
            <div class="w-11 h-11 rounded-xl bg-amber-50 text-[#B8872F] flex items-center justify-center shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>

        <!-- Sertifikat Terbit -->
        <div class="bg-white border-t-4 border-t-emerald-500 border-x border-b border-slate-200/80 rounded-xl p-5 shadow-sm flex items-center justify-between">
            <div class="space-y-1">
                <p class="text-xs font-medium text-slate-500">Sertifikat terbit</p>
                <h3 class="text-2xl font-bold text-[#0B2A4A]">{{ $stats['sertifikat_terbit'] }}</h3>
                <span class="inline-flex items-center gap-1.5 text-[11px] font-medium text-slate-500 pt-1">
                    <span class="w-2 h-2 rounded-full bg-slate-400"></span>Siap diunduh
                </span>
            </div>
            <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200/80 overflow-hidden">
        <div class="p-5 border-b border-slate-100 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <h2 class="text-sm font-bold text-[#0B2A4A]">Riwayat order terbaru</h2>
            </div>
            <a href="{{ route('order.index') }}" class="text-xs font-semibold text-[#B8872F] hover:underline">Lihat semua</a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50/50 text-slate-400 font-semibold uppercase tracking-wider text-[10px] border-b border-slate-100">
                    <tr>
                        <th class="py-3.5 px-6">No. Order</th>
                        <th class="py-3.5 px-6">Layanan</th>
                        <th class="py-3.5 px-6">Cabang</th>
                        <th class="py-3.5 px-6 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-normal">
                    @forelse($recentOrders->take(3) as $order)
                        <tr class="hover:bg-slate-50/80 transition cursor-pointer" onclick="window.location='{{ route('order.show', $order) }}'">
                            <td class="py-4 px-6 font-mono-code font-medium text-[#0B2A4A]">{{ $order->kode_order }}</td>
                            <td class="py-4 px-6 text-slate-800 font-medium">{{ $order->product?->nama_produk ?? '-' }}</td>
                            <td class="py-4 px-6 text-slate-500">{{ $order->branch?->nama_cabang ?? '-' }}</td>
                            <td class="py-4 px-6 text-center">
                                <span class="inline-block px-3 py-1 rounded-md text-[11px] font-semibold bg-slate-100 text-slate-700 border border-slate-200/80">
                                    {{ Str::headline($order->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-12 text-center text-slate-400">
                                <p class="text-sm">Belum ada order layanan yang diajukan.</p>
                                <a href="{{ route('order.create') }}" class="inline-block mt-2 text-xs font-semibold text-[#B8872F] hover:underline">
                                    Buat order pertama Anda
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection