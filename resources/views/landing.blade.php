<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SILAFCO - Sucofindo Franchise Hub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;500;600;700&family=IBM+Plex+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'IBM Plex Sans', sans-serif; }
        .font-mono-code { font-family: 'IBM Plex Mono', monospace; }
    </style>
</head>
<body class="bg-white text-slate-800 antialiased selection:bg-[#B8872F] selection:text-white">

    @include('partials.navbar-guest', ['showMenu' => true])

    {{-- HERO --}}
    <section class="bg-[#0B2A4A] text-white px-6 pt-16 pb-16">
        <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-14 items-center">
            <div class="lg:col-span-7">
                <p class="font-mono-code text-xs text-slate-400 mb-6">PT SUCOFINDO (PERSERO) — CABANG CILACAP</p>

                <h1 class="text-3xl md:text-4xl lg:text-[2.75rem] font-semibold leading-[1.15] tracking-tight">
                    Pesan dan lacak layanan sertifikasi Sucofindo dari cabang mana pun
                </h1>

                <p class="text-slate-300 text-base leading-relaxed max-w-lg mt-6">
                    Satu sistem terpusat untuk mengajukan order, memantau progres pekerjaan, membayar melalui Virtual Account resmi cabang, dan mengunduh sertifikat dengan kode verifikasi QR.
                </p>

                <div class="flex flex-wrap items-center gap-4 mt-8">
                    <a href="{{ route('register') }}" class="px-6 py-3 bg-[#B8872F] hover:bg-[#9c7327] text-white font-semibold rounded-md transition">
                        Daftar Akun
                    </a>
                    <a href="#verifikasi" class="px-6 py-3 border border-white/25 hover:border-white/50 text-white font-medium rounded-md transition">
                        Cek Keaslian Sertifikat
                    </a>
                </div>

                <div class="grid grid-cols-3 max-w-md mt-14 pt-8 border-t border-white/15">
                    <div class="pr-4">
                        <div class="text-2xl font-semibold">142</div>
                        <div class="text-xs text-slate-400 mt-1">Cabang terhubung</div>
                    </div>
                    <div class="px-4 border-l border-white/15">
                        <div class="text-2xl font-semibold">18.400+</div>
                        <div class="text-xs text-slate-400 mt-1">Sertifikat terbit</div>
                    </div>
                    <div class="pl-4 border-l border-white/15">
                        <div class="text-2xl font-semibold">100%</div>
                        <div class="text-xs text-slate-400 mt-1">Tervalidasi pusat</div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-5">
                <div class="bg-white text-slate-800 rounded-md border border-slate-200 p-6 shadow-[0_20px_50px_-20px_rgba(0,0,0,0.35)]">
                    <div class="text-xs text-slate-500 mb-5">Keunggulan Sistem</div>

                    <div class="space-y-5">
                        <div class="flex gap-3">
                            <svg class="w-5 h-5 text-emerald-600 shrink-0 mt-0.5" viewBox="0 0 20 20" fill="none"><path d="M4 10.5l3.5 3.5L16 5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            <div>
                                <div class="text-sm font-medium text-slate-800">Order resmi &amp; terlacak</div>
                                <div class="text-xs text-slate-500 mt-0.5">Tercatat di sistem pusat, bukan transaksi informal ke petugas.</div>
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <svg class="w-5 h-5 text-emerald-600 shrink-0 mt-0.5" viewBox="0 0 20 20" fill="none"><path d="M4 10.5l3.5 3.5L16 5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            <div>
                                <div class="text-sm font-medium text-slate-800">Bayar via VA resmi cabang</div>
                                <div class="text-xs text-slate-500 mt-0.5">Transfer langsung ke rekening cabang, tanpa perantara tunai.</div>
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <svg class="w-5 h-5 text-emerald-600 shrink-0 mt-0.5" viewBox="0 0 20 20" fill="none"><path d="M4 10.5l3.5 3.5L16 5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            <div>
                                <div class="text-sm font-medium text-slate-800">Sertifikat ber-kode QR</div>
                                <div class="text-xs text-slate-500 mt-0.5">Keasliannya dapat diverifikasi oleh siapa saja, kapan saja.</div>
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <svg class="w-5 h-5 text-emerald-600 shrink-0 mt-0.5" viewBox="0 0 20 20" fill="none"><path d="M4 10.5l3.5 3.5L16 5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            <div>
                                <div class="text-sm font-medium text-slate-800">Progres real-time</div>
                                <div class="text-xs text-slate-500 mt-0.5">Pantau setiap tahap pekerjaan dari order sampai selesai.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- LAYANAN --}}
    <section id="layanan" class="py-20 px-6 bg-white">
        <div class="max-w-5xl mx-auto">
            <div class="max-w-lg mb-12">
                <h2 class="text-2xl md:text-3xl font-semibold text-[#0B2A4A] tracking-tight">Lima lini layanan, satu sistem</h2>
                <p class="text-slate-500 text-sm leading-relaxed mt-3">
                    Pilih kategori layanan yang dibutuhkan. Sistem akan mencocokkan dengan cabang Sucofindo terdekat berdasarkan wilayah Anda.
                </p>
            </div>

            <div class="flex flex-wrap justify-center gap-4">
                @foreach($layanan as $item)
                    <div class="border border-slate-200 hover:border-slate-300 rounded-md p-6 transition w-full sm:w-[calc(50%-0.5rem)] lg:w-[calc(33.333%-0.667rem)]">
                        <div class="w-9 h-9 bg-[#0B2A4A] text-white rounded flex items-center justify-center text-base mb-4">
                            {{ $item['icon'] }}
                        </div>
                        <h3 class="font-semibold text-slate-800 text-sm mb-1.5">{{ $item['judul'] }}</h3>
                        <p class="text-slate-500 text-xs leading-relaxed">{{ $item['deskripsi'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CARA KERJA --}}
    <section id="cara-kerja" class="py-20 px-6 bg-slate-50 border-y border-slate-200">
        <div class="max-w-5xl mx-auto">
            <h2 class="text-2xl md:text-3xl font-semibold text-[#0B2A4A] tracking-tight mb-12">Dari order sampai sertifikat di tangan</h2>

            <div class="grid grid-cols-1 md:grid-cols-4">
                <div class="py-6 md:py-0 md:pr-6 border-t md:border-t-0 md:border-l border-slate-300 md:pl-6 first:border-t-0 first:pt-0 first:md:border-l-0 first:md:pl-0">
                    <div class="font-mono-code text-sm text-[#B8872F] mb-2">01</div>
                    <h3 class="font-semibold text-slate-800 text-sm mb-1.5">Order &amp; disetujui</h3>
                    <p class="text-slate-500 text-xs leading-relaxed">Pilih layanan &amp; cabang, dapat nomor order resmi.</p>
                </div>
                <div class="py-6 md:py-0 md:px-6 border-t md:border-t-0 md:border-l border-slate-300">
                    <div class="font-mono-code text-sm text-[#B8872F] mb-2">02</div>
                    <h3 class="font-semibold text-slate-800 text-sm mb-1.5">Dikerjakan</h3>
                    <p class="text-slate-500 text-xs leading-relaxed">Cabang/tenaga ahli mengerjakan atas nama Sucofindo.</p>
                </div>
                <div class="py-6 md:py-0 md:px-6 border-t md:border-t-0 md:border-l border-slate-300">
                    <div class="font-mono-code text-sm text-[#B8872F] mb-2">03</div>
                    <h3 class="font-semibold text-slate-800 text-sm mb-1.5">Bayar via VA</h3>
                    <p class="text-slate-500 text-xs leading-relaxed">Transfer ke VA cabang — bukan tunai ke petugas.</p>
                </div>
                <div class="py-6 md:py-0 md:pl-6 border-t md:border-t-0 md:border-l border-slate-300">
                    <div class="font-mono-code text-sm text-[#B8872F] mb-2">04</div>
                    <h3 class="font-semibold text-slate-800 text-sm mb-1.5">Unduh &amp; verifikasi</h3>
                    <p class="text-slate-500 text-xs leading-relaxed">Sertifikat ber-QR aktif otomatis setelah lunas.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- JARINGAN CABANG --}}
    <section id="cabang" class="py-20 px-6 bg-white">
        <div class="max-w-5xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
            <div class="lg:col-span-5">
                <h2 class="text-2xl md:text-3xl font-semibold text-[#0B2A4A] tracking-tight leading-tight">Terdeteksi otomatis dari wilayah Anda</h2>
                <p class="text-slate-500 text-sm leading-relaxed mt-4">
                    Saat mengajukan order, cukup pilih provinsi dan kota — sistem menampilkan cabang resmi terdekat lengkap dengan nomor Virtual Account masing-masing.
                </p>
            </div>

            <div class="lg:col-span-7 border-t border-slate-200">
                <div class="flex justify-between items-center py-3.5 border-b border-slate-200">
                    <span class="text-sm text-slate-700">Cabang Cilacap</span>
                    <span class="flex items-center gap-1.5 text-xs text-emerald-700"><span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span>Aktif</span>
                </div>
                <div class="flex justify-between items-center py-3.5 border-b border-slate-200">
                    <span class="text-sm text-slate-700">Cabang Bandar Lampung</span>
                    <span class="flex items-center gap-1.5 text-xs text-emerald-700"><span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span>Aktif</span>
                </div>
                <div class="flex justify-between items-center py-3.5 border-b border-slate-200">
                    <span class="text-sm text-slate-700">Cabang Surabaya</span>
                    <span class="flex items-center gap-1.5 text-xs text-emerald-700"><span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span>Aktif</span>
                </div>
                <div class="flex justify-between items-center py-3.5 border-b border-slate-200">
                    <span class="text-sm text-slate-700">Cabang Makassar</span>
                    <span class="flex items-center gap-1.5 text-xs text-emerald-700"><span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span>Aktif</span>
                </div>
                <div class="flex justify-between items-center py-3.5 border-b border-slate-200">
                    <span class="text-sm text-slate-700">Cabang Medan</span>
                    <span class="flex items-center gap-1.5 text-xs text-emerald-700"><span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span>Aktif</span>
                </div>
                <div class="flex justify-between items-center py-3.5 border-b border-slate-200">
                    <span class="text-sm text-slate-700">Cabang Balikpapan</span>
                    <span class="flex items-center gap-1.5 text-xs text-emerald-700"><span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span>Aktif</span>
                </div>
            </div>
        </div>
    </section>

    {{-- TESTIMONI --}}
    <section id="testimoni" class="py-20 px-6 bg-slate-50 border-t border-slate-200">
        <div class="max-w-5xl mx-auto">
            <h2 class="text-2xl md:text-3xl font-semibold text-[#0B2A4A] tracking-tight mb-12">Kata mereka yang sudah order</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                @php
                    $testimoniList = $testimoni ?? [
                        [
                            'pesan' => 'Nomor order langsung keluar, jadi gampang ditanyain progresnya ke tim internal.',
                            'nama' => 'Rudi D.',
                            'jabatan' => 'QA Manager, Manufaktur'
                        ],
                        [
                            'pesan' => 'VA per cabang bikin tenang, transfernya jelas atas nama Sucofindo.',
                            'nama' => 'Sinta N.',
                            'jabatan' => 'Procurement Lead'
                        ],
                        [
                            'pesan' => 'QR di sertifikat kepake buat meyakinkan klien kami sendiri.',
                            'nama' => 'Andi H.',
                            'jabatan' => 'Direktur Operasional'
                        ]
                    ];
                @endphp

                @foreach($testimoniList as $item)
                    <div class="border-l-2 border-[#B8872F] pl-5">
                        <p class="text-slate-700 text-sm leading-relaxed">
                            &ldquo;{{ $item['pesan'] }}&rdquo;
                        </p>
                        <div class="mt-4">
                            <div class="font-semibold text-slate-800 text-xs">{{ $item['nama'] }}</div>
                            <div class="text-slate-400 text-xs mt-0.5">{{ $item['jabatan'] }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- VERIFIKASI --}}
    <section id="verifikasi" class="py-20 px-6 bg-[#0B2A4A]">
        <div class="max-w-lg mx-auto text-center">
            <h2 class="text-2xl md:text-3xl font-semibold text-white tracking-tight">Cek keaslian sertifikat</h2>
            <p class="text-slate-300 text-sm leading-relaxed mt-3">
                Masukkan nomor order atau nomor sertifikat untuk memastikan dokumen ini diterbitkan oleh PT Sucofindo.
            </p>

            <form action="{{ route('verifikasi') }}" method="GET" class="flex flex-col sm:flex-row gap-3 mt-7">
                <input type="text" name="kode" placeholder="cth. LAP/CIL/2026/08/0142" required
                    class="font-mono-code flex-1 px-4 py-3 rounded-md bg-white border border-white/20 text-slate-800 placeholder-slate-400 text-sm focus:outline-none focus:ring-2 focus:ring-[#B8872F]">
                <button type="submit" class="px-6 py-3 bg-[#B8872F] hover:bg-[#9c7327] text-white font-semibold rounded-md transition shrink-0">
                    Cek Keaslian
                </button>
            </form>
        </div>
    </section>

</body>
</html>