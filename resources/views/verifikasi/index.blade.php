<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Sertifikat - SILAFCO Sucofindo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-100/70 text-slate-800 antialiased min-h-screen flex flex-col justify-between">

    @include('partials.navbar-guest')

    <main class="flex-1 flex items-center justify-center px-4 py-8">
        <div class="w-full max-w-md bg-white rounded-2xl p-6 md:p-8 border border-slate-200/80 shadow-sm text-center space-y-3">
            <h1 class="text-xl font-extrabold text-[#003366]">Hasil Verifikasi</h1>
            <p class="text-sm text-slate-500">Kode yang dicek: <span class="font-semibold text-slate-700">{{ $kode ?? '-' }}</span></p>
            <p class="text-xs text-slate-400">Fitur pengecekan ke database sertifikat masih dalam pengembangan.</p>
        </div>
    </main>

    @include('partials.footer-guest')

</body>
</html>