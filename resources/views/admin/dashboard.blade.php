@extends('layouts.app')

@section('title', 'Dashboard Admin - SILAFCO Sucofindo')

@section('content')
<div class="mb-6">
    <h1 class="text-xl font-bold text-[#0B2A4A]">Dashboard Admin Pusat / Cabang</h1>
    <p class="text-xs text-slate-500 mt-1">Selamat datang kembali, {{ Auth::user()->name }}! Silakan kelola layanan dan order masuk melalui menu navigasi.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
    <div class="bg-white p-5 rounded-lg shadow-sm border border-slate-200">
        <div class="text-xs font-semibold text-slate-400 uppercase">Total Order Masuk</div>
        <div class="text-2xl font-bold text-[#0B2A4A] mt-2">{{ $totalOrder ?? 0 }}</div>
    </div>
    <div class="bg-white p-5 rounded-lg shadow-sm border border-slate-200">
        <div class="text-xs font-semibold text-slate-400 uppercase">Menunggu Verifikasi</div>
        <div class="text-2xl font-bold text-[#B8872F] mt-2">{{ $menungguVerifikasi ?? 0 }}</div>
    </div>
    <div class="bg-white p-5 rounded-lg shadow-sm border border-slate-200">
        <div class="text-xs font-semibold text-slate-400 uppercase">Selesai Diproses</div>
        <div class="text-2xl font-bold text-emerald-600 mt-2">{{ $selesaiDiproses ?? 0 }}</div>
    </div>
</div>

<div class="bg-white p-6 rounded-lg shadow-sm border border-slate-200">
    <h2 class="text-sm font-semibold text-[#0B2A4A] mb-2">Aktivitas Sistem</h2>
    <p class="text-xs text-slate-600">Sistem manajemen franchise Sucofindo siap digunakan. Anda dapat mengakses menu **Order Masuk** di sidebar untuk memproses pengajuan dari pelanggan.</p>
</div>
@endsection