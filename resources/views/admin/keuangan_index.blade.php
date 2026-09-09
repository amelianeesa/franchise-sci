@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Judul & Tombol Tambah VA -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="text-xl font-bold text-[#0B2A4A] mb-0">Kelola Nomor Virtual Account</h1>
        <button type="button" class="btn text-white px-3 py-2 rounded-3 shadow-sm" style="background-color: #0B2A4A; font-size: 14px;" data-bs-toggle="modal" data-bs-target="#addVaModal">
            + Tambah Bank / VA
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Tabel Daftar Virtual Account -->
    <div class="card shadow-sm border-0 mb-5">
        <div class="card-body">
            <h5 class="card-title mb-3">Daftar Virtual Account Cabang</h5>
            <table class="table table-bordered table-striped align-middle">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th>Nama Bank</th>
                        <th>Atas Nama</th>
                        <th>Nomor Virtual Account</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($virtualAccounts as $index => $va)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $va->bank_name }}</td>
                        <td>{{ $va->atas_nama }}</td>
                        <td><code>{{ $va->va_number }}</code></td>
                        <td class="text-center">
                            @if($va->is_active)
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-secondary">Nonaktif</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <!-- Tombol Edit -->
                            <button type="button" class="btn btn-sm text-white px-3 py-1" style="background-color: #f39c12; border-radius: 6px;" data-bs-toggle="modal" data-bs-target="#editVaModal{{ $va->id }}">
                                Edit
                            </button>

                            <!-- Tombol Hapus -->
                            <form action="{{ route('admin.va_destroy', $va->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus VA ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm text-white px-3 py-1 bg-danger" style="border-radius: 6px;">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal Edit VA -->
                    <div class="modal fade" id="editVaModal{{ $va->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <form action="{{ route('admin.va_update', $va->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Virtual Account</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body text-start">
                                        <div class="mb-3">
                                            <label class="form-label">Nama Bank</label>
                                            <input type="text" name="bank_name" class="form-control" required value="{{ old('bank_name', $va->bank_name) }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Atas Nama</label>
                                            <input type="text" name="atas_nama" class="form-control" required value="{{ old('atas_nama', $va->atas_nama) }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Nomor Virtual Account</label>
                                            <input type="text" name="va_number" class="form-control" required value="{{ old('va_number', $va->va_number) }}">
                                        </div>
                                        <div class="mb-3 form-check">
                                            <input type="checkbox" name="is_active" class="form-check-input" id="isActive{{ $va->id }}" value="1" {{ $va->is_active ? 'checked' : '' }}>
                                            <label class="form-check-label" for="isActive{{ $va->id }}">Aktifkan Virtual Account</label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn text-white" style="background-color: #0B2A4A;">Simpan Perubahan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Belum ada data Virtual Account.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Tabel Daftar Tagihan / Invoices -->
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h5 class="card-title mb-3">Daftar Tagihan Pelanggan</h5>
            <table class="table table-bordered table-striped align-middle">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th>Kode Invoice</th>
                        <th>Total Tagihan</th>
                        <th>Batas Waktu</th>
                        <th class="text-center">Status Bayar</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($invoices as $index => $inv)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $inv->kode_invoice }}</td>
                        <td>Rp {{ number_format($inv->total_tagihan, 0, ',', '.') }}</td>
                        <td>{{ $inv->batas_waktu_pembayaran }}</td>
                        <td class="text-center">
                            @if($inv->status_bayar == 'lunas')
                                <span class="badge bg-success">Lunas</span>
                            @elseif($inv->status_bayar == 'kedaluwarsa')
                                <span class="badge bg-danger">Kedaluwarsa</span>
                            @else
                                <span class="badge bg-warning text-dark">Belum Bayar</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Belum ada data tagihan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah VA -->
<div class="modal fade" id="addVaModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('admin.va_store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Virtual Account Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-start">
                    <div class="mb-3">
                        <label class="form-label">Nama Bank</label>
                        <input type="text" name="bank_name" class="form-control" placeholder="Contoh: BNI, Mandiri, BRI" required value="{{ old('bank_name') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Atas Nama</label>
                        <input type="text" name="atas_nama" class="form-control" placeholder="Contoh: PT Sucofindo Cabang Bandar Lampung" required value="{{ old('atas_nama') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nomor Virtual Account</label>
                        <input type="text" name="va_number" class="form-control" placeholder="Contoh: 880701422026" required value="{{ old('va_number') }}">
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" name="is_active" class="form-check-input" id="isActiveAdd" value="1" checked>
                        <label class="form-check-label" for="isActiveAdd">Aktifkan Virtual Account</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn text-white" style="background-color: #0B2A4A;">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection