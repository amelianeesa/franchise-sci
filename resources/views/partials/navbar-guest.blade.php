<nav class="bg-white/95 backdrop-blur-md border-b border-slate-200/80 sticky top-0 z-50 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 h-16 flex items-center justify-between">
        <a href="{{ route('landing') }}" class="flex items-center gap-3 group">
            <img src="{{ asset('images/logo_sci.png') }}" alt="Logo Sucofindo" class="h-9 w-auto object-contain transition duration-300 group-hover:scale-105">
            <div class="flex flex-col border-l border-slate-200 pl-3">
                <span class="font-extrabold text-lg tracking-tight text-[#003366] leading-none">SILAFCO</span>
                <span class="text-[10px] text-slate-500 font-semibold tracking-tight mt-0.5">Sistem Informasi Layanan Franchise Sucofindo</span>
            </div>
        </a>
   
        @if(!empty($showMenu))
            <div class="hidden md:flex items-center space-x-8 text-sm font-semibold text-slate-600">
                <a href="{{ route('landing') }}#layanan" class="hover:text-[#003366] transition">Layanan</a>
                <a href="{{ route('landing') }}#cara-kerja" class="hover:text-[#003366] transition">Cara Kerja</a>
                <a href="{{ route('landing') }}#cabang" class="hover:text-[#003366] transition">Cabang</a>
                <a href="{{ route('landing') }}#testimoni" class="hover:text-[#003366] transition">Testimoni</a>
                <a href="{{ route('landing') }}#verifikasi" class="hover:text-[#003366] transition">Verifikasi</a>
            </div>
        @else
            <a href="{{ route('landing') }}" class="hidden sm:flex items-center gap-1.5 text-sm font-semibold text-slate-500 hover:text-[#003366] transition">
                <span>←</span>
                <span>Kembali ke Beranda</span>
            </a>
        @endif

        <div class="flex items-center gap-3">
            <a href="{{ route('login') }}" class="text-sm font-semibold text-[#003366] hover:text-[#00A3E0] px-4 py-2.5 rounded-xl hover:bg-slate-100 transition">Masuk</a>
            <a href="{{ route('register') }}" class="text-sm font-bold px-5 py-2.5 rounded-xl bg-[#003366] text-white  hover:bg-[#002244] transition shadow-sm active:scale-95">Daftar Akun</a>
        </div>
    </div>
</nav>