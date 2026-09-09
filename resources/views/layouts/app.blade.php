<!DOCTYPE html>
<html lang="id">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard - SILAFCO Sucofindo')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;500;600;700&family=IBM+Plex+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'IBM Plex Sans', sans-serif; 
        }
        .font-mono-code { 
            font-family: 'IBM Plex Mono', monospace; 
        }
    </style>
</head>
<body class="bg-slate-100/80 text-slate-800 antialiased min-h-screen flex">

    <div id="sidebarOverlay" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-40 hidden transition-opacity duration-300" onclick="toggleSidebar()"></div>

    <aside id="sidebar" class="w-64 bg-[#0B2A4A] text-white min-h-screen flex flex-col justify-between shrink-0 shadow-xl fixed left-0 top-0 bottom-0 z-50 transition-transform duration-300 -translate-x-full md:translate-x-0">
        <div>
            <div class="p-5 border-b border-white/10 flex items-center justify-between">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                    <img src="{{ asset('images/logo_sci.png') }}" alt="Sucofindo" class="h-8 w-auto bg-white p-1 rounded">
                    <div class="flex flex-col">
                        <span class="font-semibold text-base tracking-tight text-white leading-none">SILAFCO</span>
                        <span class="text-[9px] text-slate-400 font-medium tracking-wide mt-0.5">Sucofindo Franchise</span>
                    </div>
                </a>
                <button onclick="toggleSidebar()" class="md:hidden text-slate-300 hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <!-- SIDEBAR BERDASARKAN ROLE -->
            @auth
                @if(in_array(Auth::user()->role, ['admin_pusat', 'admin_cabang']))
                    <!-- SIDEBAR KHUSUS ADMIN -->
                    <div class="px-4 py-3 text-[10px] font-semibold text-slate-400 uppercase tracking-wider">
                        Panel Admin Pusat
                    </div>

                    <nav class="px-3 space-y-1">
                        <a href="{{ route('admin.dashboard') }}" 
                            class="flex items-center gap-3 px-3 py-2.5 rounded-md font-medium text-xs transition
                            {{ request()->routeIs('admin.dashboard') ? 'bg-[#B8872F] text-white shadow-sm font-semibold' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                            <span>Dashboard</span>
                        </a>

                        <a href="{{ route('admin.order_masuk') }}" 
                            class="flex items-center gap-3 px-3 py-2.5 rounded-md font-medium text-xs transition
                            {{ request()->routeIs('admin.order_masuk') ? 'bg-[#B8872F] text-white shadow-sm font-semibold' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                            <span>Order Masuk</span>
                        </a>

                        <a href="{{ route('admin.product_index') }}" 
                            class="flex items-center gap-3 px-3 py-2.5 rounded-md font-medium text-xs transition
                            {{ request()->routeIs('admin.product_index') ? 'bg-[#B8872F] text-white shadow-sm font-semibold' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                            <span>Kelola Layanan</span>
                        </a>

                        <a href="{{ route('admin.category_index') }}" 
                            class="flex items-center gap-3 px-3 py-2.5 rounded-md font-medium text-xs transition
                            {{ request()->routeIs('admin.category_index') ? 'bg-[#B8872F] text-white shadow-sm font-semibold' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                            <span>Kelola Kategori</span>
                        </a>

                        <a href="{{ route('admin.keuangan_index') }}" 
                            class="flex items-center gap-3 px-3 py-2.5 rounded-md font-medium text-xs transition
                            {{ request()->routeIs('admin.keuangan_index') || request()->routeIs('admin.va.*') ? 'bg-[#B8872F] text-white shadow-sm font-semibold' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>Keuangan & VA</span>
                        </a>

                        <a href="#" 
                            class="flex items-center gap-3 px-3 py-2.5 rounded-md font-medium text-xs transition
                            {{ request()->routeIs('admin.upload') ? 'bg-[#B8872F] text-white shadow-sm font-semibold' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                            <span>Upload Hasil & Sertifikat</span>
                        </a>

                        <a href="#" 
                            class="flex items-center gap-3 px-3 py-2.5 rounded-md font-medium text-xs transition
                            {{ request()->routeIs('admin.pendapatan') ? 'bg-[#B8872F] text-white shadow-sm font-semibold' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span>Laporan Pendapatan</span>
                        </a>
                        <a href="{{ route('admin.ta_index') }}" 
                            class="flex items-center gap-3 px-3 py-2.5 rounded-md font-medium text-xs transition
                            {{ request()->routeIs('admin.ta_index') ? 'bg-[#B8872F] text-white shadow-sm font-semibold' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                            <span>Kelola Tenaga Ahli</span>
                        </a>
                    </nav>
                @else
                    <!-- SIDEBAR KHUSUS PELANGGAN -->
                    <div class="px-4 py-3 text-[10px] font-semibold text-slate-400 uppercase tracking-wider">
                        Akun Pelanggan
                    </div>

                    <nav class="px-3 space-y-1">
                        <a href="{{ route('dashboard') }}"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-md font-semibold text-xs transition
                            {{ request()->routeIs('dashboard') ? 'bg-[#B8872F] text-white shadow-sm' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                            <span>Dashboard</span>
                        </a>
                    
                        <a href="{{ route('order.create') }}"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-md font-medium text-xs transition
                            {{ request()->routeIs('order.create') ? 'bg-[#B8872F] text-white shadow-sm font-semibold' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            <span>Buat Order Baru</span>
                        </a>
                            
                        <a href="{{ route('lacak.index') }}"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-md font-medium text-xs transition
                            {{ request()->routeIs('order.index', 'order.show') ? 'bg-[#B8872F] text-white shadow-sm font-semibold' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span>Lacak Order</span>
                        </a>
                    
                        <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-md font-medium text-xs text-slate-300 hover:bg-white/10 hover:text-white transition opacity-60 cursor-not-allowed">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span>Tagihan</span>
                        </a>
                    
                        <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-md font-medium text-xs text-slate-300 hover:bg-white/10 hover:text-white transition opacity-60 cursor-not-allowed">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            <span>Sertifikat & Laporan</span>
                        </a>
                            
                        <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-md font-medium text-xs text-slate-300 hover:bg-white/10 hover:text-white transition opacity-60 cursor-not-allowed" title="Belum tersedia">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span>Riwayat Transaksi</span>
                        </a>
                    </nav>
                    @endif
            @endauth
        </div>

        <!-- Tombol Keluar di Bawah Mentok -->
        <div class="p-3 border-t border-white/10">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-md font-medium text-xs text-red-300 hover:bg-red-500/20 hover:text-red-100 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    <span>Keluar</span>
                </button>
            </form>
        </div>
    </aside>

    <div id="mainContent" class="flex-1 transition-all duration-300 md:ml-64 flex flex-col min-h-screen">
        <header class="bg-white border-b border-slate-200/80 h-16 px-4 md:px-8 flex items-center justify-between sticky top-0 z-30">
            <div class="flex items-center gap-3">
                <button onclick="toggleSidebar()" class="p-2 rounded-md bg-slate-100 hover:bg-slate-200 text-[#0B2A4A] transition focus:outline-none">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
                <div class="text-xs font-medium text-slate-500 hidden sm:block">
                    Sistem Informasi Layanan Franchise Sucofindo
                </div>
            </div>

            <div class="flex items-center gap-3">
                @auth
                    <div class="text-right">
                        <div class="text-xs font-semibold text-[#0B2A4A]">{{ Auth::user()->name }}</div>
                        <div class="text-[10px] text-slate-400 capitalize">{{ str_replace('_', ' ', Auth::user()->role) }}</div>
                    </div>
                    <div class="w-9 h-9 rounded-full bg-[#0B2A4A] text-white font-semibold text-xs flex items-center justify-center shadow-sm">
                        {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                    </div>
                @endauth
            </div>
        </header>

        <main class="p-4 md:p-8 flex-1">
            @yield('content')
        </main>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            const overlay = document.getElementById('sidebarOverlay');
            const isDesktop = window.innerWidth >= 768;

            if (isDesktop) {
                if (sidebar.classList.contains('md:translate-x-0')) {
                    sidebar.classList.remove('md:translate-x-0');
                    sidebar.classList.add('-translate-x-full');
                    mainContent.classList.remove('md:ml-64');
                    mainContent.classList.add('md:ml-0');
                } else {
                    sidebar.classList.remove('-translate-x-full');
                    sidebar.classList.add('md:translate-x-0');
                    mainContent.classList.remove('md:ml-0');
                    mainContent.classList.add('md:ml-64');
                }
            } else {
                if (sidebar.classList.contains('-translate-x-full')) {
                    sidebar.classList.remove('-translate-x-full');
                    sidebar.classList.add('translate-x-0');
                    overlay.classList.remove('hidden');
                } else {
                    sidebar.classList.remove('translate-x-0');
                    sidebar.classList.add('-translate-x-full');
                    overlay.classList.add('hidden');
                }
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>