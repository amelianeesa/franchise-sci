@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Judul di kiri dan tombol tambah selaras dengan tema -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="text-xl font-bold text-[#0B2A4A] mb-0">Kelola Akun Tenaga Ahli</h1>
        <button type="button" class="btn text-white px-3 py-2 rounded-3 shadow-sm" style="background-color: #0B2A4A; font-size: 14px;" data-bs-toggle="modal" data-bs-target="#addModal">
            + Tambah Tenaga Ahli
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

    <!-- Tabel Daftar Tenaga Ahli -->
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <table class="table table-bordered table-striped align-middle">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Waktu</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tenagaAhliList as $index => $ta)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $ta->name }}</td>
                        <td>{{ $ta->email }}</td>
                        <td>{{ $ta->created_at->format('d-m-Y H:i') }}</td>
                        <td class="text-center">
                            <!-- Tombol Edit dengan gaya kuning/oranye seperti contoh -->
                            <button type="button" class="btn btn-sm text-white px-3 py-1" style="background-color: #f39c12; border-radius: 6px;" data-bs-toggle="modal" data-bs-target="#editModal{{ $ta->id }}">
                                Edit
                            </button>
                        </td>
                    </tr>

                    <!-- Modal Edit & Reset Password Terpadu per Item -->
                    <div class="modal fade" id="editModal{{ $ta->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <form action="{{ route('admin.ta_update', $ta->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Kelola Akun: {{ $ta->name }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body text-start">
                                        <div class="mb-3">
                                            <label class="form-label">Nama Lengkap</label>
                                            <input type="text" name="name" class="form-control" required value="{{ old('name', $ta->name) }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Username</label>
                                            <input type="text" name="username" class="form-control" value="{{ old('username', $ta->username) }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Email Aktif</label>
                                            <input type="email" name="email" class="form-control" required value="{{ old('email', $ta->email) }}">
                                        </div>
                                        <hr>
                                        <div class="mb-3">
                                            <label class="form-label">Password Baru (Opsional)</label>
                                            <input type="password" name="password" class="form-control" minlength="6" placeholder="Kosongkan jika tidak ingin mengubah password">
                                            <small class="text-muted">Isi hanya jika ingin mereset password baru karena lupa.</small>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary" style="background-color: #0B2A4A;">Simpan Perubahan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Belum ada data tenaga ahli.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Tenaga Ahli -->
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('admin.ta_store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Tenaga Ahli Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email Aktif</label>
                        <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
                        <small class="text-muted">Info login & password sementara akan dikirim otomatis ke email ini.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn text-white" style="background-color: #0B2A4A;">Simpan & Kirim Email</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection