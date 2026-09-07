@extends('layouts.app')

@section('title', 'Buat Order Baru - SILAFCO')

@section('content')
<div class="max-w-5xl mx-auto px-6 py-8 space-y-8">

    {{-- Header Section Clean --}}
    <div class="flex items-center gap-4 pb-6 border-b border-slate-200/80">
        <button type="button" id="backBtn" onclick="handleBack()" 
            class="p-2 text-slate-500 hover:text-slate-800 hover:bg-slate-100 rounded-xl transition shrink-0" 
            title="Kembali">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
        </button>

        <div>
            <h1 class="text-2xl font-bold text-[#0B2A4A] tracking-tight" id="stepTitle">Pilih Jenis Layanan</h1>
        </div>
    </div>

    @if ($errors->any())
        <div class="p-4 bg-rose-50 border border-rose-200 rounded-xl text-xs text-rose-700 font-medium">
            {{ $errors->first() }}
        </div>
    @endif

    {{-- STEP 1: Pilih Kategori --}}
    <div id="step1">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5" id="categoryGrid"></div>
    </div>

    {{-- STEP 2: Pilih Produk --}}
    <div id="step2" class="hidden space-y-4">
        <div class="bg-white rounded-2xl border border-slate-200/80 p-6 shadow-sm">
            <h2 class="text-sm font-bold text-[#0B2A4A] mb-4 pb-3 border-b border-slate-100" id="selectedCategoryTitle"></h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3" id="productList"></div>
        </div>
    </div>

    {{-- STEP 3: Form Detail --}}
    <div id="step3" class="hidden grid grid-cols-1 lg:grid-cols-12 gap-6">
        <div class="lg:col-span-8 bg-white rounded-2xl border border-slate-200/80 p-6 shadow-sm space-y-6">
            <div class="p-4 bg-slate-50 border border-slate-200/80 rounded-xl">
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Layanan Terpilih</span>
                <p class="text-sm font-bold text-[#0B2A4A] mt-0.5" id="selectedProductLabel"></p>
            </div>

            <form action="{{ route('order.store') }}" method="POST" id="orderForm" class="space-y-5">
                @csrf
                <input type="hidden" name="product_id" id="productIdInput">
                <input type="hidden" name="branch_id" id="branchIdInput">

                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-700">Provinsi Lokasi Anda</label>
                    <select id="provinsiSelect"
                        class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-medium focus:outline-none focus:bg-white focus:border-[#0B2A4A] transition">
                        <option value="">— Pilih Provinsi —</option>
                        @foreach($provinsiList as $provinsi)
                            <option value="{{ $provinsi }}">{{ $provinsi }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-700">Cabang Penanggung Jawab</label>
                    <div id="branchOptions" class="space-y-2">
                        <p class="text-xs text-slate-400 italic">Silakan pilih provinsi terlebih dahulu untuk menampilkan cabang.</p>
                    </div>
                    <p class="text-[11px] text-slate-500 mt-1" id="locationHint"></p>
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-700">Catatan Pelanggan (Opsional)</label>
                    <textarea name="catatan_pelanggan" rows="3" placeholder="Tuliskan spesifikasi lokasi sampel atau instruksi khusus..."
                        class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-medium focus:outline-none focus:bg-white focus:border-[#0B2A4A] transition">{{ old('catatan_pelanggan') }}</textarea>
                </div>

                <button type="submit" id="submitBtn" disabled
                    class="w-full py-3 bg-[#B8872F] hover:bg-[#a07527] disabled:opacity-40 disabled:cursor-not-allowed text-white font-bold text-xs rounded-xl transition shadow-sm active:scale-[0.99]">
                    Kirim Pengajuan Order
                </button>
            </form>
        </div>

        <div class="lg:col-span-4 bg-slate-50 border border-slate-200/80 rounded-2xl p-5 h-fit text-xs space-y-3">
            <div class="font-bold text-[#0B2A4A]">Informasi Pengajuan</div>
            <p class="text-slate-600 leading-relaxed">
                Pengajuan order Anda akan diverifikasi oleh Admin Pusat. Kode order resmi akan diterbitkan otomatis untuk pemantauan progres.
            </p>
        </div>
    </div>

</div>

<script>
    let CURRENT_STEP = 1;
    
    // Mengambil data riil dari database service_categories & products
    const CATEGORIES = @json($categories);
    const BRANCHES = @json($branchesJson);
    
    let USER_COORDS = null;

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            (pos) => { USER_COORDS = { lat: pos.coords.latitude, lng: pos.coords.longitude }; },
            () => { USER_COORDS = null; },
            { timeout: 5000 }
        );
    }

    function haversineKm(lat1, lon1, lat2, lon2) {
        const toRad = (deg) => deg * Math.PI / 180;
        const R = 6371;
        const dLat = toRad(lat2 - lat1);
        const dLon = toRad(lon2 - lon1);
        const a = Math.sin(dLat / 2) ** 2 + Math.cos(toRad(lat1)) * Math.cos(toRad(lat2)) * Math.sin(dLon / 2) ** 2;
        return R * (2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a)));
    }

    function handleBack() {
        if (CURRENT_STEP === 1) {
            window.location.href = "{{ route('order.index') }}";
        } else {
            goToStep(CURRENT_STEP - 1);
        }
    }

    function renderCategories() {
        const grid = document.getElementById('categoryGrid');
        const defaultIcon = `<svg class="w-5 h-5 text-[#0B2A4A]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>`;

        grid.innerHTML = CATEGORIES.map(cat => {
            const catName = cat.nama ?? cat.name ?? cat.title;
            const catDesc = cat.deskripsi ?? cat.description ?? '';
            const prodCount = cat.products ? cat.products.length : 0;

            return `
                <div onclick="selectCategory(${cat.id})"
                    class="group bg-white rounded-2xl p-6 border border-slate-200/80 hover:border-[#0B2A4A] hover:shadow-md transition-all duration-200 cursor-pointer flex flex-col justify-between">
                    <div>
                        <div class="w-10 h-10 bg-slate-100 group-hover:bg-[#0B2A4A]/10 rounded-xl flex items-center justify-center mb-4 transition-colors">
                            ${cat.icon ?? defaultIcon}
                        </div>
                        <h3 class="font-bold text-slate-800 text-sm group-hover:text-[#0B2A4A] transition-colors mb-1.5">${catName}</h3>
                        <p class="text-xs text-slate-500 leading-relaxed">${catDesc}</p>
                    </div>
                    <div class="mt-5 pt-3 border-t border-slate-100 flex items-center justify-between text-[11px] font-semibold text-slate-400 group-hover:text-[#0B2A4A]">
                        <span>${prodCount} Layanan Tersedia</span>
                        <span class="transition-transform group-hover:translate-x-1">→</span>
                    </div>
                </div>
            `;
        }).join('');
    }

    function selectCategory(categoryId) {
        const category = CATEGORIES.find(c => c.id === categoryId);
        const categoryName = category.nama ?? category.name ?? category.title;
        document.getElementById('selectedCategoryTitle').textContent = `Daftar Layanan — ${categoryName}`;

        const list = document.getElementById('productList');
        const products = category.products || [];

        if (products.length === 0) {
            list.innerHTML = `<p class="col-span-2 text-xs text-slate-400 italic py-2">Belum ada paket produk aktif pada kategori ini.</p>`;
        } else {
            list.innerHTML = products.map(p => {
                const pName = p.nama ?? p.name ?? p.title;
                const pDesc = p.deskripsi ?? p.description;
                const pSatuan = p.satuan ?? p.unit;

                return `
                    <div onclick="selectProduct(${p.id}, '${pName.replace(/'/g, "\\'")}')"
                        class="p-4 border border-slate-200/80 hover:border-[#0B2A4A] bg-white hover:bg-slate-50/80 rounded-xl cursor-pointer transition flex items-center justify-between group">
                        <div>
                            <p class="text-xs font-bold text-slate-800 group-hover:text-[#0B2A4A]">${pName}</p>
                            ${pDesc ? `<p class="text-[11px] text-slate-500 mt-0.5 line-clamp-2">${pDesc}</p>` : ''}
                        </div>
                        ${pSatuan ? `<span class="text-[10px] font-semibold bg-slate-100 text-slate-600 px-2.5 py-1 rounded-lg shrink-0 ml-3">${pSatuan}</span>` : ''}
                    </div>
                `;
            }).join('');
        }

        goToStep(2);
    }

    function selectProduct(productId, productName) {
        document.getElementById('productIdInput').value = productId;
        document.getElementById('selectedProductLabel').textContent = productName;
        goToStep(3);
    }

    function renderBranchOptions(provinsi) {
        const container = document.getElementById('branchOptions');
        const hint = document.getElementById('locationHint');
        const branchIdInput = document.getElementById('branchIdInput');
        const submitBtn = document.getElementById('submitBtn');

        branchIdInput.value = '';
        submitBtn.disabled = true;

        let matches = BRANCHES.filter(b => b.provinsi === provinsi);

        if (matches.length === 0) {
            container.innerHTML = `<p class="text-xs text-rose-600 font-medium">Belum ada cabang resmi aktif di wilayah provinsi ini.</p>`;
            hint.textContent = '';
            return;
        }

        const withDistance = matches.map(b => {
            let distance = null;
            if (USER_COORDS && b.lat && b.lng) {
                distance = haversineKm(USER_COORDS.lat, USER_COORDS.lng, parseFloat(b.lat), parseFloat(b.lng));
            }
            return { ...b, distance };
        });

        withDistance.sort((a, b) => {
            if (a.distance === null) return 1;
            if (b.distance === null) return -1;
            return a.distance - b.distance;
        });

        container.innerHTML = withDistance.map((b, index) => {
            const bName = b.nama ?? b.name;
            const bCity = b.kota ?? b.city;

            return `
                <label class="flex items-center justify-between p-3.5 border rounded-xl cursor-pointer transition
                    ${index === 0 ? 'border-[#0B2A4A] bg-sky-50/30' : 'border-slate-200 hover:border-slate-300'}">
                    <div class="flex items-center gap-3">
                        <input type="radio" name="branchRadio" value="${b.id}" ${index === 0 ? 'checked' : ''}
                            onchange="document.getElementById('branchIdInput').value = ${b.id}; document.getElementById('submitBtn').disabled = false;"
                            class="text-[#0B2A4A] focus:ring-[#0B2A4A]">
                        <div>
                            <p class="text-xs font-bold text-slate-800">${bName}</p>
                            <p class="text-[11px] text-slate-500">${bCity}</p>
                        </div>
                    </div>
                    ${b.distance !== null ? `<span class="text-[10px] font-bold text-emerald-700">± ${b.distance.toFixed(1)} km</span>` : ''}
                </label>
            `;
        }).join('');

        branchIdInput.value = withDistance[0].id;
        submitBtn.disabled = false;

        hint.textContent = USER_COORDS
            ? 'Cabang terdekat diurutkan otomatis berdasarkan posisi Anda.'
            : 'Aktifkan izin lokasi browser untuk estimasi jarak cabang yang presisi.';
    }

    function goToStep(step) {
        CURRENT_STEP = step;

        document.getElementById('step1').classList.toggle('hidden', step !== 1);
        document.getElementById('step2').classList.toggle('hidden', step !== 2);
        document.getElementById('step3').classList.toggle('hidden', step !== 3);

        const titles = { 1: 'Pilih Jenis Layanan', 2: 'Pilih Layanan Produk', 3: 'Lengkapi Detail Order' };
        document.getElementById('stepTitle').textContent = titles[step];
    }

    document.getElementById('provinsiSelect').addEventListener('change', function () {
        if (!this.value) {
            document.getElementById('branchOptions').innerHTML = '<p class="text-xs text-slate-400 italic">Silakan pilih provinsi terlebih dahulu untuk menampilkan cabang.</p>';
            document.getElementById('branchIdInput').value = '';
            document.getElementById('submitBtn').disabled = true;
            return;
        }
        renderBranchOptions(this.value);
    });

    renderCategories();
</script>
@endsection