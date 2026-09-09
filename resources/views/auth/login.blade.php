<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - SILAFCO Sucofindo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 500; }
        h1, h2, h3, h4, h5, h6 { font-weight: 700; }
    </style>
</head>
<body class="bg-slate-100/70 text-slate-800 antialiased min-h-screen flex flex-col justify-between">

    @include('partials.navbar-guest', ['authPage' => 'login'])

    <main class="flex-1 flex items-center justify-center px-4 py-8">
        <div class="w-full max-w-md space-y-3">

            <a href="{{ route('landing') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-400 hover:text-[#003366] transition">
                <span>←</span>
                <span>Kembali ke Beranda</span>
            </a>

            <div class="bg-white rounded-2xl p-6 md:p-8 border border-slate-200/80 shadow-sm space-y-5">

                <div class="border-b border-slate-100 pb-4">
                    <span class="text-[10px] font-extrabold text-[#00A3E0] uppercase tracking-wider">Akses Pengguna</span>
                    <h1 class="text-xl font-extrabold text-[#003366] mt-0.5">Masuk ke Akun</h1>
                </div>

                @if ($errors->any())
                    <div class="p-3 bg-red-50 border border-red-200 rounded-lg text-xs text-red-600">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST" class="space-y-4">
                    @csrf

                    <div class="space-y-1">
                        <label for="email" class="text-[11px] font-semibold text-slate-700">Alamat Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-xs text-slate-800 focus:outline-none focus:bg-white focus:border-[#003366] focus:ring-1 focus:ring-[#003366] transition">
                    </div>

                    <div class="space-y-1">
                        <label for="password" class="text-[11px] font-semibold text-slate-700">Kata Sandi</label>
                        <div class="relative">
                            <input type="password" id="password" name="password" required placeholder="••••••••"
                                class="w-full pl-3 pr-10 py-2 bg-slate-50 border border-slate-200 rounded-lg text-xs text-slate-800 focus:outline-none focus:bg-white focus:border-[#003366] focus:ring-1 focus:ring-[#003366] transition">
                            <button type="button" onclick="togglePassword()"
                                class="absolute right-2.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 transition">
                                <svg id="eyeOpen" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <svg id="eyeClosed" class="w-4 h-4 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.025 10.025 0 012.132-3.411m3.412-2.652A9.958 9.958 0 0112 5c4.478 0 8.268 2.943 9.542 7a9.973 9.973 0 01-1.563 3.029m-5.858.908a3 3 0 11-4.243-4.243M3 3l18 18"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full py-3 bg-[#003366] hover:bg-[#002244] text-white font-bold text-xs rounded-xl shadow transition active:scale-[0.99] flex items-center justify-center gap-2">
                            <span>Masuk ke Akun</span>
                            <span>→</span>
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </main>

    @include('partials.footer-guest')

    <script>
        function togglePassword() {
            const pass = document.getElementById('password');
            const eyeOpen = document.getElementById('eyeOpen');
            const eyeClosed = document.getElementById('eyeClosed');
            const isPassword = pass.type === 'password';

            pass.type = isPassword ? 'text' : 'password';
            eyeOpen.classList.toggle('hidden', isPassword);
            eyeClosed.classList.toggle('hidden', !isPassword);
        }
    </script>

</body>
</html>