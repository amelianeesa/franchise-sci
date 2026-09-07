@extends('layouts.app')

@section('title', 'Dashboard Pelanggan - SILAFCO')

@section('content')
<div class="space-y-6">

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-semibold text-[#0B2A4A]">Selamat datang, {{ $user->name }} 👋</h1>
            <p class="text-xs text-slate-500 mt-1">Pantau status layanan, pengajuan, dan dokumen sertifikasi Anda secara real-time.</p>
        </div>
        <a href="{{ route('order.create') }}" class="px-4 py-2.5 bg-[#B8872F] hover:bg-[#9c7327] text-white text-xs font-semibold rounded-md shadow-sm transition flex items-center gap-2 w-fit">
            <span>+ Buat Order Baru</span>
        </a>
    </div>

    @if(session('success'))
        <div class="p-3 bg-emerald-50 border border-emerald-200 rounded-md text-xs text-emerald-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        <div class="bg-white rounded-md p-5 border border-slate-200/80 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Order Aktif</p>
                <h3 class="text-3xl font-semibold text-[#0B2A4A] mt-1">{{ $stats['order_aktif'] }}</h3>
                <span class="text-[11px] text-emerald-600 font-medium mt-1 inline-block">● Sedang berjalan</span>
            </div>
            <div class="w-12 h-12 rounded-md bg-blue-50 text-[#0B2A4A] flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            </div>
        </div>

        <div class="bg-white rounded-md p-5 border border-slate-200/80 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Menunggu Pembayaran</p>
                <h3 class="text-3xl font-semibold text-[#0B2A4A] mt-1">{{ $stats['menunggu_pembayaran'] }}</h3>
                <span class="text-[11px] text-amber-600 font-medium mt-1 inline-block">● Perlu tindakan</span>
            </div>
            <div class="w-12 h-12 rounded-md bg-amber-50 text-amber-600 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>

        <div class="bg-white rounded-md p-5 border border-slate-200/80 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Sertifikat Terbit</p>
                <h3 class="text-3xl font-semibold text-[#0B2A4A] mt-1">{{ $stats['sertifikat_terbit'] }}</h3>
                <span class="text-[11px] text-[#B8872F] font-medium mt-1 inline-block">● Siap diunduh</span>
            </div>
            <div class="w-12 h-12 rounded-md bg-amber-50 text-[#B8872F] flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-md border border-slate-200/80 shadow-sm overflow-hidden">
        <div class="p-5 border-b border-slate-100 flex items-center justify-between">
            <h2 class="text-base font-semibold text-[#0B2A4A]">Riwayat Order Terbaru</h2>
            <a href="{{ route('order.index') }}" class="text-xs font-semibold text-[#B8872F] hover:underline">Lihat Semua →</a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 text-slate-500 font-semibold uppercase tracking-wider border-b border-slate-100">
                    <tr>
                        <th class="py-3.5 px-6">No. Order</th>
                        <th class="py-3.5 px-6">Layanan</th>
                        <th class="py-3.5 px-6">Cabang</th>
                        <th class="py-3.5 px-6 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($recentOrders as $order)
                        <tr class="hover:bg-slate-50/50 cursor-pointer" onclick="window.location='{{ route('order.show', $order) }}'">
                            <td class="py-4 px-6 font-semibold text-[#0B2A4A]">{{ $order->kode_order }}</td>
                            <td class="py-4 px-6 font-medium text-slate-700">{{ $order->product->nama_produk }}</td>
                            <td class="py-4 px-6 text-slate-500">{{ $order->branch->nama_cabang }}</td>
                            <td class="py-4 px-6 text-center">
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-semibold bg-blue-50 text-blue-600">
                                    {{ Str::headline($order->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-12 text-center text-slate-400">
                                <p class="text-sm font-medium">Belum ada order layanan yang diajukan.</p>
                                <a href="{{ route('order.create') }}" class="inline-block mt-2 text-xs font-semibold text-[#B8872F] hover:underline">
                                    Buat order pertama Anda →
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