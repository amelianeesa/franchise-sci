<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - SILAFCO Sucofindo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-100/70 text-slate-800 antialiased min-h-screen flex flex-col justify-between">

    @include('partials.navbar-guest')

    <main class="flex-1 flex items-center justify-center px-4 py-8">
        <div class="w-full max-w-md bg-white rounded-2xl p-6 md:p-8 border border-slate-200/80 shadow-sm space-y-5">

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
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="nama@gmail.com"
                        class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-xs text-slate-800 focus:outline-none focus:bg-white focus:border-[#003366] focus:ring-1 focus:ring-[#003366] transition">
                </div>

                <div class="space-y-1">
                    <div class="flex justify-between items-center">
                        <label for="password" class="text-[11px] font-semibold text-slate-700">Kata Sandi</label>
                        <label class="inline-flex items-center gap-1 cursor-pointer text-[10px] text-slate-500">
                            <input type="checkbox" onclick="togglePassword()" class="rounded border-slate-300 text-[#003366] focus:ring-0">
                            <span>Lihat Password</span>
                        </label>
                    </div>
                    <input type="password" id="password" name="password" required placeholder="••••••••"
                        class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-xs text-slate-800 focus:outline-none focus:bg-white focus:border-[#003366] focus:ring-1 focus:ring-[#003366] transition">
                </div>

                <div class="flex items-center justify-between text-[11px]">
                    <label class="inline-flex items-center gap-1.5 cursor-pointer text-slate-600 font-medium">
                        <input type="checkbox" id="remember" name="remember" class="rounded border-slate-300 text-[#003366] focus:ring-0">
                        <span>Ingat saya</span>
                    </label>
                    <a href="#" class="font-semibold text-[#00A3E0] hover:underline">Lupa password?</a>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full py-3 bg-[#003366] hover:bg-[#002244] text-white font-bold text-xs rounded-xl shadow transition active:scale-[0.99] flex items-center justify-center gap-2">
                        <span>Masuk ke Akun</span>
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
            pass.type = pass.type === 'password' ? 'text' : 'password';
        }
    </script>

</body>
</html>