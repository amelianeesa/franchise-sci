@extends('layouts.app')

@section('title', 'Buat Order Baru - SILAFCO')

@section('content')
<div class="max-w-5xl mx-auto px-6 -mt-6 space-y-4">

    <div class="flex items-center gap-3 pb-2 border-b border-slate-200">
        <button type="button" id="backBtn" onclick="handleBack()"
            class="hidden p-1 text-slate-500 hover:text-slate-800 hover:bg-slate-100 rounded-lg transition shrink-0"
            title="Kembali">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
        </button>

        <div>
            <h1 class="text-xl font-bold text-[#0B2A4A] tracking-tight" id="stepTitle">Pilih Jenis Layanan</h1>
        </div>
    </div>

    @if ($errors->any())
        <div class="p-4 bg-rose-50 border border-rose-200 rounded-lg text-xs text-rose-700 font-medium">
            {{ $errors->first() }}
        </div>
    @endif

    <div id="step1">
        <div id="categoryGrid" class="space-y-5"></div>
    </div>

    <div id="step2" class="hidden space-y-4">
        <div class="bg-white rounded-xl border border-slate-200 p-6 shadow-sm">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4 pb-3 border-b border-slate-100">
                <h2 class="text-sm font-bold text-[#0B2A4A]" id="selectedCategoryTitle"></h2>
                <div class="relative w-full sm:w-64">
                    <svg class="w-4 h-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 10.5A6.5 6.5 0 114 10.5a6.5 6.5 0 0113 0z"/>
                    </svg>
                    <input type="text" id="productSearch" placeholder="Cari layanan..."
                        class="w-full pl-9 pr-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-xs font-medium focus:outline-none focus:bg-white focus:border-[#0B2A4A] transition">
                </div>
            </div>
            <p class="text-[11px] text-slate-400 mb-3" id="productCountLabel"></p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3" id="productList"></div>
            <p class="hidden text-xs text-slate-400 italic text-center py-6" id="noResultLabel">Tidak ada layanan yang cocok dengan pencarian Anda.</p>
        </div>
    </div>

    <div id="step3" class="hidden grid grid-cols-1 lg:grid-cols-12 gap-6">
        <div class="lg:col-span-8 bg-white rounded-xl border border-slate-200 p-6 shadow-sm space-y-5">
            <div class="p-4 bg-slate-50 border border-slate-200 rounded-lg">
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Layanan Terpilih</span>
                <p class="text-sm font-bold text-[#0B2A4A] mt-0.5" id="selectedProductLabel"></p>
            </div>

            <form action="{{ route('order.store') }}" method="POST" id="orderForm" class="space-y-4">
                @csrf
                <input type="hidden" name="product_id" id="productIdInput">
                <input type="hidden" name="branch_id" id="branchIdInput">

                <div class="space-y-1.5">
                    <label class="text-xs font-semibold text-slate-700">Wilayah Lokasi Anda</label>
                    <select id="wilayahSelect"
                        class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-xs font-medium focus:outline-none focus:bg-white focus:border-[#0B2A4A] transition">
                        <option value="">— Pilih Wilayah —</option>
                        @foreach($wilayahList as $namaWilayah => $provinsiDalamWilayah)
                            <option value="{{ $namaWilayah }}">{{ $namaWilayah }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="space-y-1.5">
                    <div class="flex items-center justify-between">
                        <label class="text-xs font-semibold text-slate-700" id="branchSectionLabel">Cabang Penanggung Jawab</label>
                        <span class="hidden text-[10px] font-bold text-amber-600 bg-amber-50 px-2 py-0.5 rounded-full" id="fallbackBadge">Rekomendasi Terdekat</span>
                    </div>
                    <div id="branchOptions" class="space-y-2">
                        <p class="text-xs text-slate-400 italic">Silakan pilih wilayah terlebih dahulu untuk menampilkan cabang.</p>
                    </div>
                    <p class="text-[11px] text-slate-500 mt-1.5 flex items-start gap-1.5" id="locationHint"></p>
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-semibold text-slate-700">Catatan Pelanggan (Opsional)</label>
                    <textarea name="catatan_pelanggan" rows="3" placeholder="Tuliskan spesifikasi lokasi sampel atau instruksi khusus..."
                        class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-xs font-medium focus:outline-none focus:bg-white focus:border-[#0B2A4A] transition">{{ old('catatan_pelanggan') }}</textarea>
                </div>

                <button type="submit" id="submitBtn" disabled
                    class="w-full py-3 bg-[#B8872F] hover:bg-[#9c7327] disabled:opacity-40 disabled:cursor-not-allowed text-white font-bold text-xs rounded-lg transition shadow-sm active:scale-[0.99]">
                    Kirim Pengajuan Order
                </button>
            </form>
        </div>

        <div class="lg:col-span-4 bg-slate-50 border border-slate-200 rounded-xl p-5 h-fit text-xs space-y-2.5">
            <div class="font-bold text-[#0B2A4A]">Informasi Pengajuan</div>
            <p class="text-slate-600 leading-relaxed">
                Pengajuan order Anda akan diverifikasi oleh Admin Pusat. Kode order resmi akan diterbitkan otomatis untuk pemantauan progres.
            </p>
        </div>
    </div>

</div>

<script>
    let CURRENT_STEP = 1;
    let CURRENT_CATEGORY = null;

    const CATEGORIES = @json($categories);
    const BRANCHES = @json($branchesJson);
    const WILAYAH_MAP = @json($wilayahList);

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
        if (CURRENT_STEP > 1) {
            goToStep(CURRENT_STEP - 1);
        }
    }

    function renderCategories() {
        const grid = document.getElementById('categoryGrid');

        if (!CATEGORIES || CATEGORIES.length === 0) {
            grid.innerHTML = `<div class="bg-white border border-slate-200 rounded-xl p-6 text-center">
                <p class="text-sm font-medium text-slate-500">Belum ada kategori layanan yang tersedia.</p>
                <p class="text-xs text-slate-400 mt-1">Jalankan <span class="font-mono bg-slate-100 px-1.5 py-0.5 rounded">php artisan db:seed --class=ProductSeeder</span> untuk mengisi data layanan.</p>
            </div>`;
            return;
        }

        const topRowCategories = CATEGORIES.slice(0, 3);
        const bottomRowCategories = CATEGORIES.slice(3);

        const createCardHtml = (cat) => {
            const catName = cat.nama ?? cat.name ?? cat.title;
            const catDesc = cat.deskripsi ?? cat.description ?? '';
            const prodCount = cat.products ? cat.products.length : 0;

            return `
                <div onclick="selectCategory(${cat.id})"
                    class="group bg-white rounded-xl border border-slate-200 p-5 hover:border-[#0B2A4A] hover:shadow-sm transition cursor-pointer flex flex-col justify-between h-full">
                    <div>
                        <h3 class="font-bold text-slate-800 text-sm mb-1 group-hover:text-[#0B2A4A] transition-colors">${catName}</h3>
                        <p class="text-xs text-slate-500 leading-relaxed">${catDesc}</p>
                    </div>
                    <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-[11px] font-semibold text-slate-400 group-hover:text-[#0B2A4A]">
                        <span>${prodCount} layanan tersedia</span>
                        <span>→</span>
                    </div>
                </div>
            `;
        };

        grid.innerHTML = `
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                ${topRowCategories.map(createCardHtml).join('')}
            </div>
            ${bottomRowCategories.length > 0 ? `
                <div class="flex justify-center gap-5">
                    ${bottomRowCategories.map(cat => `
                        <div class="w-full md:w-[calc(33.333%-0.85rem)]">
                            ${createCardHtml(cat)}
                        </div>
                    `).join('')}
                </div>
            ` : ''}
        `;
    }

    function selectCategory(categoryId) {
        CURRENT_CATEGORY = CATEGORIES.find(c => c.id === categoryId);
        const categoryName = CURRENT_CATEGORY.nama ?? CURRENT_CATEGORY.name ?? CURRENT_CATEGORY.title;
        document.getElementById('selectedCategoryTitle').textContent = `Daftar Layanan — ${categoryName}`;
        document.getElementById('productSearch').value = '';

        renderProductList('');
        goToStep(2);
    }

    function renderProductList(keyword) {
        const list = document.getElementById('productList');
        const countLabel = document.getElementById('productCountLabel');
        const noResultLabel = document.getElementById('noResultLabel');

        const allProducts = CURRENT_CATEGORY.products || [];
        const query = keyword.trim().toLowerCase();

        const filtered = query
            ? allProducts.filter(p => (p.nama_produk ?? p.nama ?? p.name ?? p.title ?? '').toLowerCase().includes(query))
            : allProducts;

        countLabel.textContent = query
            ? `Menampilkan ${filtered.length} dari ${allProducts.length} layanan`
            : `${allProducts.length} layanan tersedia`;

        if (allProducts.length === 0) {
            list.innerHTML = '';
            noResultLabel.textContent = 'Belum ada paket produk aktif pada kategori ini.';
            noResultLabel.classList.remove('hidden');
            return;
        }

        if (filtered.length === 0) {
            list.innerHTML = '';
            noResultLabel.textContent = 'Tidak ada layanan yang cocok dengan pencarian Anda.';
            noResultLabel.classList.remove('hidden');
            return;
        }

        noResultLabel.classList.add('hidden');

        list.innerHTML = filtered.map(p => {
            const pName = p.nama_produk ?? p.nama ?? p.name ?? p.title;
            const pDesc = p.deskripsi ?? p.description;
            const pSatuan = p.satuan ?? p.unit;

            return `
                <div onclick="selectProduct(${p.id}, '${pName.replace(/'/g, "\\'")}')"
                    class="p-4 border border-slate-200 hover:border-[#0B2A4A] bg-white rounded-lg cursor-pointer transition flex items-center justify-between group">
                    <div>
                        <p class="text-xs font-bold text-slate-800 group-hover:text-[#0B2A4A] transition-colors">${pName}</p>
                        ${pDesc ? `<p class="text-[11px] text-slate-500 mt-0.5 line-clamp-2">${pDesc}</p>` : ''}
                    </div>
                    ${pSatuan ? `<span class="text-[10px] font-semibold bg-slate-100 text-slate-600 px-2 py-1 rounded shrink-0 ml-3">${pSatuan}</span>` : ''}
                </div>
            `;
        }).join('');
    }

    document.getElementById('productSearch').addEventListener('input', function () {
        renderProductList(this.value);
    });

    function selectProduct(productId, productName) {
        document.getElementById('productIdInput').value = productId;
        document.getElementById('selectedProductLabel').textContent = productName;
        goToStep(3);
    }

    function renderBranchOptions(wilayah) {
        const container = document.getElementById('branchOptions');
        const hint = document.getElementById('locationHint');
        const branchIdInput = document.getElementById('branchIdInput');
        const submitBtn = document.getElementById('submitBtn');
        const sectionLabel = document.getElementById('branchSectionLabel');
        const fallbackBadge = document.getElementById('fallbackBadge');

        branchIdInput.value = '';
        submitBtn.disabled = true;

        if (BRANCHES.length === 0) {
            container.innerHTML = `<p class="text-xs text-rose-600 font-medium">Belum ada cabang resmi yang aktif di sistem.</p>`;
            hint.textContent = '';
            fallbackBadge.classList.add('hidden');
            return;
        }

        const provinsiDalamWilayah = WILAYAH_MAP[wilayah] || [];
        let matches = BRANCHES.filter(b => provinsiDalamWilayah.includes(b.provinsi));
        let isFallback = false;

        if (matches.length === 0) {
            matches = BRANCHES;
            isFallback = true;
        }

        sectionLabel.textContent = isFallback ? 'Cabang Terdekat yang Dapat Melayani' : 'Cabang Penanggung Jawab';
        fallbackBadge.classList.toggle('hidden', !isFallback);

        const withDistance = matches.map(b => {
            let distance = null;
            if (USER_COORDS && b.latitude && b.longitude) {
                distance = haversineKm(USER_COORDS.lat, USER_COORDS.lng, parseFloat(b.latitude), parseFloat(b.longitude));
            }
            return { ...b, distance };
        });

        withDistance.sort((a, b) => {
            if (a.distance === null) return 1;
            if (b.distance === null) return -1;
            return a.distance - b.distance;
        });

        const showAsSingleCard = !isFallback && withDistance.length === 1;

        container.innerHTML = withDistance.map((b, index) => {
            const bName = b.nama_cabang ?? b.nama ?? b.name;
            const bCity = b.kota ?? b.city;
            const isSelected = index === 0;

            return `
                <label class="flex items-center justify-between gap-3 p-3.5 border rounded-lg transition
                    ${showAsSingleCard ? 'cursor-default' : 'cursor-pointer'}
                    ${isSelected ? 'border-[#0B2A4A] bg-sky-50/60 ring-1 ring-[#0B2A4A]/10' : 'border-slate-200 hover:border-slate-300'}">
                    <div class="flex items-center gap-3 min-w-0">
                        ${showAsSingleCard
                            ? `<div class="w-4 h-4 rounded-full bg-[#0B2A4A] flex items-center justify-center shrink-0">
                                   <div class="w-1.5 h-1.5 rounded-full bg-white"></div>
                               </div>`
                            : `<input type="radio" name="branchRadio" value="${b.id}" ${isSelected ? 'checked' : ''}
                                   onchange="document.getElementById('branchIdInput').value = ${b.id}; document.getElementById('submitBtn').disabled = false;"
                                   class="text-[#0B2A4A] focus:ring-[#0B2A4A] shrink-0">`
                        }
                        <div class="min-w-0">
                            <p class="text-xs font-bold text-slate-800 truncate">${bName}</p>
                            <p class="text-[11px] text-slate-500">${bCity}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 shrink-0">
                        ${isSelected && isFallback ? `<span class="text-[10px] font-bold text-[#0B2A4A] bg-white border border-[#0B2A4A]/20 px-2 py-0.5 rounded-full">Terdekat</span>` : ''}
                        ${b.distance !== null ? `<span class="text-[10px] font-bold text-emerald-700">± ${b.distance.toFixed(1)} km</span>` : ''}
                    </div>
                </label>
            `;
        }).join('');

        branchIdInput.value = withDistance[0].id;
        submitBtn.disabled = false;

        if (isFallback) {
            hint.innerHTML = USER_COORDS
                ? '<span>📍</span><span>Wilayah Anda belum memiliki cabang resmi. Cabang di atas diurutkan dari yang terdekat berdasarkan lokasi Anda saat ini.</span>'
                : '<span>💡</span><span>Wilayah Anda belum memiliki cabang resmi. Izinkan akses lokasi browser agar sistem dapat mengurutkan cabang dari yang terdekat.</span>';
        } else {
            hint.innerHTML = USER_COORDS
                ? '<span>📍</span><span>Jarak dihitung otomatis berdasarkan lokasi Anda saat ini.</span>'
                : '<span>💡</span><span>Izinkan akses lokasi browser untuk menampilkan estimasi jarak.</span>';
        }
    }

    function goToStep(step) {
        CURRENT_STEP = step;

        document.getElementById('step1').classList.toggle('hidden', step !== 1);
        document.getElementById('step2').classList.toggle('hidden', step !== 2);
        document.getElementById('step3').classList.toggle('hidden', step !== 3);

        const backBtn = document.getElementById('backBtn');
        if (step === 1) {
            backBtn.classList.add('hidden');
        } else {
            backBtn.classList.remove('hidden');
        }

        const titles = { 1: 'Pilih Jenis Layanan', 2: 'Pilih Layanan Produk', 3: 'Lengkapi Detail Order' };
        document.getElementById('stepTitle').textContent = titles[step];
    }

    document.getElementById('wilayahSelect').addEventListener('change', function () {
        if (!this.value) {
            document.getElementById('branchOptions').innerHTML = '<p class="text-xs text-slate-400 italic">Silakan pilih wilayah terlebih dahulu untuk menampilkan cabang.</p>';
            document.getElementById('branchIdInput').value = '';
            document.getElementById('submitBtn').disabled = true;
            document.getElementById('fallbackBadge').classList.add('hidden');
            document.getElementById('branchSectionLabel').textContent = 'Cabang Penanggung Jawab';
            return;
        }
        renderBranchOptions(this.value);
    });

    renderCategories();
</script>
@endsection