<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - SILAFCO Sucofindo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-100/70 text-slate-800 antialiased min-h-screen flex flex-col justify-between">

    @include('partials.navbar-guest')

    <main class="flex-1 flex items-center justify-center px-4 py-8">
        <div class="w-full max-w-2xl bg-white rounded-2xl p-6 md:p-8 border border-slate-200/80 shadow-sm space-y-6">

            <div class="border-b border-slate-100 pb-4 flex justify-between items-end">
                <div>
                    <span class="text-[10px] font-extrabold text-[#00A3E0] uppercase tracking-wider">Registrasi Pelanggan</span>
                    <h1 class="text-xl font-extrabold text-[#003366] mt-0.5">Informasi Pengguna</h1>
                </div>
                <span class="text-[10px] text-slate-400 bg-slate-50 px-2.5 py-1 rounded-md border border-slate-200/60">Langkah 1 dari 1</span>
            </div>

            @if ($errors->any())
                <div class="p-3 bg-red-50 border border-red-200 rounded-lg text-xs text-red-600">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST" class="space-y-5">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div class="space-y-1">
                        <label for="name" class="text-[11px] font-semibold text-slate-700">Nama Lengkap</label>
                        <input type="text" id="name" name="name" required value="{{ old('name') }}" placeholder="Ahmad Fauzi"
                            class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-xs text-slate-800 focus:outline-none focus:bg-white focus:border-[#003366] focus:ring-1 focus:ring-[#003366] transition">
                    </div>

                    <div class="space-y-1">
                        <label for="jenis_pelanggan" class="text-[11px] font-semibold text-slate-700">Jenis Pelanggan</label>
                        <select id="jenis_pelanggan" name="jenis_pelanggan" required
                            class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-xs text-slate-800 focus:outline-none focus:bg-white focus:border-[#003366] focus:ring-1 focus:ring-[#003366] transition cursor-pointer">
                            <option value="" disabled {{ old('jenis_pelanggan') ? '' : 'selected' }}>-- Pilih Jenis --</option>
                            <option value="perorangan" {{ old('jenis_pelanggan') == 'perorangan' ? 'selected' : '' }}>Perorangan</option>
                            <option value="perusahaan" {{ old('jenis_pelanggan') == 'perusahaan' ? 'selected' : '' }}>Perusahaan</option>
                        </select>
                    </div>

                    <div class="space-y-1">
                        <label for="company_name" class="text-[11px] font-semibold text-slate-700">Nama Perusahaan / Instansi</label>
                        <input type="text" id="company_name" name="company_name" value="{{ old('company_name') }}" placeholder="PT Contoh Sejahtera"
                            class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-xs text-slate-800 focus:outline-none focus:bg-white focus:border-[#003366] focus:ring-1 focus:ring-[#003366] transition">
                    </div>

                    <div class="space-y-1">
                        <label for="jabatan" class="text-[11px] font-semibold text-slate-700">Jabatan</label>
                        <input type="text" id="jabatan" name="jabatan" value="{{ old('jabatan') }}" placeholder="Manager / Staff"
                            class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-xs text-slate-800 focus:outline-none focus:bg-white focus:border-[#003366] focus:ring-1 focus:ring-[#003366] transition">
                    </div>

                    <div class="space-y-1 md:col-span-2">
                        <label for="npwp" class="text-[11px] font-semibold text-slate-700">Nomor NPWP</label>
                        <input type="text" id="npwp" name="npwp" value="{{ old('npwp') }}" placeholder="Masukkan nomor NPWP tanpa spasi/titik"
                            class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-xs text-slate-800 focus:outline-none focus:bg-white focus:border-[#003366] focus:ring-1 focus:ring-[#003366] transition">
                    </div>

                    <div class="space-y-1">
                        <label for="whatsapp" class="text-[11px] font-semibold text-slate-700">Nomor WhatsApp</label>
                        <input type="tel" id="whatsapp" name="whatsapp" value="{{ old('whatsapp') }}" required placeholder="081234567890"
                            class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-xs text-slate-800 focus:outline-none focus:bg-white focus:border-[#003366] focus:ring-1 focus:ring-[#003366] transition">
                    </div>

                    <div class="space-y-1">
                        <label for="phone" class="text-[11px] font-semibold text-slate-700">Telepon Kantor / Rumah</label>
                        <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" placeholder="0211234567"
                            class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-xs text-slate-800 focus:outline-none focus:bg-white focus:border-[#003366] focus:ring-1 focus:ring-[#003366] transition">
                    </div>

                    <div class="space-y-1 md:col-span-2">
                        <label for="email" class="text-[11px] font-semibold text-slate-700">Alamat Email Aktif</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="nama@perusahaan.com"
                            class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-xs text-slate-800 focus:outline-none focus:bg-white focus:border-[#003366] focus:ring-1 focus:ring-[#003366] transition">
                    </div>

                    <div class="space-y-1">
                        <label for="password" class="text-[11px] font-semibold text-slate-700">Password</label>
                        <input type="password" id="password" name="password" required placeholder="••••••••"
                            class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-xs text-slate-800 focus:outline-none focus:bg-white focus:border-[#003366] focus:ring-1 focus:ring-[#003366] transition">
                    </div>

                    <div class="space-y-1">
                        <div class="flex justify-between items-center">
                            <label for="password_confirmation" class="text-[11px] font-semibold text-slate-700">Konfirmasi Password</label>
                            <label class="inline-flex items-center gap-1 cursor-pointer text-[10px] text-slate-500">
                                <input type="checkbox" onclick="togglePassword()" class="rounded border-slate-300 text-[#003366] focus:ring-0">
                                <span>Lihat Password</span>
                            </label>
                        </div>
                        <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="••••••••"
                            class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-xs text-slate-800 focus:outline-none focus:bg-white focus:border-[#003366] focus:ring-1 focus:ring-[#003366] transition">
                    </div>

                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full py-3 bg-[#003366] hover:bg-[#002244] text-white font-bold text-xs rounded-xl shadow transition active:scale-[0.99] flex items-center justify-center gap-2">
                        <span>Daftarkan Akun Baru</span>
                        <span>→</span>
                    </button>
                </div>
            </form>

        </div>
    </main>

    @include('partials.footer-guest')

    <script>
        function togglePassword() {
            const pass = document.getElementById('password');
            const passConfirm = document.getElementById('password_confirmation');
            const isPassword = pass.type === 'password';

            pass.type = isPassword ? 'text' : 'password';
            passConfirm.type = isPassword ? 'text' : 'password';
        }
    </script>

</body>
</html>