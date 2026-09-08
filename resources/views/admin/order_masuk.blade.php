@extends('layouts.app')

@section('title', 'Order Masuk - Admin Pusat Sucofindo')

@section('content')
<!-- Custom CSS Styling untuk Halaman Order Masuk -->
<style>
    .admin-card {
        background: #ffffff;
        border: 1px solid #DCE7F5;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }
    .admin-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }
    .admin-table th {
        text-align: left;
        color: #5B6B7E;
        font-size: 11.5px;
        text-transform: uppercase;
        padding: 12px;
        border-bottom: 1.5px solid #DCE7F5;
        background-color: #F8FAFC;
    }
    .admin-table td {
        padding: 14px 12px;
        border-bottom: 1px solid #DCE7F5;
        vertical-align: middle;
    }
    .badge-status {
        display: inline-flex;
        padding: 5px 12px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 700;
    }
    .badge-pengajuan { background: #FFF3D6; color: #946200; }
    .badge-po_terbit { background: #DCEBFF; color: #0B63C5; }
    .badge-ditolak { background: #FBE7E4; color: #D9432F; }
    .badge-progress { background: #E7E2FF; color: #5B3FD1; }
    
    .btn-action {
        padding: 6px 14px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 12px;
        cursor: pointer;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: opacity 0.2s;
    }
    .btn-action:hover { opacity: 0.85; }
    .btn-success-custom { background: #DDF5E7; color: #1E9E5A; }
    .btn-danger-custom { background: #FBE7E4; color: #D9432F; }
    .btn-secondary-custom { background: #E2E8F0; color: #334155; }

    /* Modal Styling */
    .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(10, 20, 35, 0.5);
        backdrop-filter: blur(2px);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 999;
    }
    .modal-box {
        background: #ffffff;
        padding: 24px;
        border-radius: 14px;
        width: 100%;
        max-width: 420px;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
    }
    .modal-box textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #CBD5E1;
        border-radius: 8px;
        margin: 12px 0;
        font-family: inherit;
        font-size: 13px;
        outline: none;
    }
    .modal-box textarea:focus {
        border-color: #0B63C5;
        ring: 2px solid #0B63C5;
    }
</style>

<div class="mb-6">
    <h1 class="text-xl font-bold text-[#0B2A4A]" style="font-family: 'IBM Plex Sans', sans-serif;">Manajemen Order Masuk</h1>
    <p class="text-xs text-slate-500 mt-0.5">Validasi dan kelola pengajuan layanan dari pelanggan lintas cabang secara terpusat.</p>
</div>

@if(session('success'))
    <div class="mb-4 p-3 bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-lg text-xs font-medium">
        {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div class="mb-4 p-3 bg-rose-50 text-rose-700 border border-rose-200 rounded-lg text-xs font-medium">
        {{ session('error') }}
    </div>
@endif

<!-- Tabel Order Masuk -->
<div class="admin-card">
    <div class="flex items-center justify-between mb-4">
        <h3 class="font-bold text-sm text-[#0B2A4A]">Daftar Pengajuan Order Pelanggan</h3>
        <span class="text-xs bg-sky-50 text-sky-700 px-2.5 py-1 rounded-full font-semibold border border-sky-100">Pusat Kendali</span>
    </div>

    <div class="overflow-x-auto">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>No. Order</th>
                    <th>Pelanggan</th>
                    <th>Layanan / Produk</th>
                    <th>Cabang</th>
                    <th>Status</th>
                    <th class="text-center">Aksi Admin</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td class="font-mono-code font-bold text-[#0B2A4A]">{{ $order->kode_order }}</td>
                    <td>
                        <div class="font-semibold text-slate-800">{{ $order->customer->name ?? 'Pelanggan' }}</div>
                        <div class="text-[10px] text-slate-400">{{ $order->customer->email ?? '' }}</div>
                    </td>
                    <td>{{ $order->produk ?? $order->layanan }}</td>
                    <td>
                        <span class="font-medium text-slate-700">{{ $order->branch->nama_cabang ?? '-' }}</span>
                    </td>
                    <td>
                        <span class="badge-status badge-{{ $order->status }}">
                            {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                        </span>
                    </td>
                    <td class="text-center">
                        @if($order->status == 'pengajuan')
                            <div class="inline-flex items-center gap-1.5">
                                <form action="{{ route('admin.orders.approve', $order->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn-action btn-success-custom">✔ Setujui</button>
                                </form>
                                <button type="button" class="btn-action btn-danger-custom" onclick="openRejectModal('{{ $order->id }}')">✕ Tolak</button>
                            </div>
                        @else
                            <span class="text-xs text-slate-400 italic font-medium">Telah Diproses</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-slate-400 py-8">Belum ada order masuk dari pelanggan</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Informasi Sistem -->
<div class="bg-[#EAF4FF] border border-blue-100 text-[#084A99] p-4 rounded-xl text-xs flex items-start gap-3 mb-6">
    <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
    <div>
        <span class="font-bold">Ketentuan Sistem Pusat:</span> Admin pusat bertugas memvalidasi, menyetujui, atau menolak order masuk. Seluruh proses pelaksanaan teknis di lapangan sepenuhnya dikoordinasikan melalui mitra tenaga ahli cabang terkait
    </div>
</div>

<!-- Tabel Monitoring Progres Tenaga Ahli -->
<div class="admin-card">
    <h3 class="font-bold text-sm text-[#0B2A4A] mb-4">Monitoring Progres Lapangan (Tenaga Ahli)</h3>
    <div class="overflow-x-auto">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>No. Order</th>
                    <th>Nama Pekerja (Mitra)</th>
                    <th>Tahap Pengerjaan</th>
                    <th>Catatan Lapangan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jobFeeds as $feed)
                <tr>
                    <td class="font-mono-code font-bold text-[#0B2A4A]">{{ $feed->order->kode_order ?? '-' }}</td>
                    <td>{{ $feed->tenagaAhli->name ?? 'Mitra Ahli' }}</td>
                    <td><span class="badge-status badge-progress">{{ ucfirst($feed->status) }}</span></td>
                    <td class="text-slate-600">{{ $feed->catatan ?? 'Sedang dikerjakan di lokasi' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-slate-400 py-6">Belum ada aktivitas pengerjaan lapangan dari tenaga ahli</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Alasan Penolakan -->
<div class="modal-overlay" id="rejectModal">
    <div class="modal-box">
        <h3 class="font-bold text-base text-rose-600 mb-1">Alasan Penolakan Order</h3>
        <p class="text-xs text-slate-500 mb-3">Tuliskan alasan penolakan secara transparan agar informasi dapat diterima oleh pelanggan</p>
        <form id="rejectForm" method="POST">
            @csrf
            <textarea name="alasan_penolakan" rows="3" placeholder="cth. Dokumen persyaratan uji lab belum lengkap..." required></textarea>
            <div class="flex justify-end gap-2 mt-2">
                <button type="button" class="btn-action btn-secondary-custom" onclick="closeRejectModal()">Batal</button>
                <button type="submit" class="btn-action btn-danger-custom">Kirim Penolakan</button>
            </div>
        </form>
    </div>
</div>

<script>
function openRejectModal(orderId) {
    const modal = document.getElementById('rejectModal');
    const form = document.getElementById('rejectForm');
    form.action = `/admin/orders/${orderId}/reject`;
    modal.style.display = 'flex';
}
function closeRejectModal() {
    document.getElementById('rejectModal').style.display = 'none';
}
</script>
@endsection