@extends('layouts.app')

@section('title', 'Buat Order Baru - SILAFCO')

@section('content')
<div class="max-w-5xl mx-auto px-6 py-8 space-y-8">



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
            <div class="space-y-2.5" id="productList"></div>
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
    const CATEGORIES = [
        {
            id: 1,
            nama: "Inspeksi & Audit",
            deskripsi: "Layanan inspeksi teknis dan audit kepatuhan sesuai standar industri.",
            icon: `<svg class="w-5 h-5 text-[#0B2A4A]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>`,
            products: []
        },
        {
            id: 2,
            nama: "Konsultasi",
            deskripsi: "Layanan konsultasi teknis dan manajemen usaha secara berkelanjutan.",
            icon: `<svg class="w-5 h-5 text-[#0B2A4A]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/></svg>`,
            products: []
        },
        {
            id: 3,
            nama: "Pelatihan",
            deskripsi: "Layanan pelatihan dan sertifikasi kompetensi personel profesional.",
            icon: `<svg class="w-5 h-5 text-[#0B2A4A]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0112 20.055a11.952 11.952 0 01-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>`,
            products: []
        },
        {
            id: 4,
            nama: "Pengujian & Analisis",
            deskripsi: "Layanan pengujian laboratorium mutakhir dan analisis sampel.",
            icon: `<svg class="w-5 h-5 text-[#0B2A4A]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>`,
            products: []
        },
        {
            id: 5,
            nama: "Sertifikasi",
            deskripsi: "Layanan sertifikasi produk, sistem manajemen, serta personel.",
            icon: `<svg class="w-5 h-5 text-[#0B2A4A]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>`,
            products: []
        }
    ];

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
        grid.innerHTML = CATEGORIES.map(cat => `
            <div onclick="selectCategory(${cat.id})"
                class="group bg-white rounded-2xl p-6 border border-slate-200/80 hover:border-[#0B2A4A] hover:shadow-md transition-all duration-200 cursor-pointer flex flex-col justify-between">
                <div>
                    <div class="w-10 h-10 bg-slate-100 group-hover:bg-[#0B2A4A]/10 rounded-xl flex items-center justify-center mb-4 transition-colors">
                        ${cat.icon}
                    </div>
                    <h3 class="font-bold text-slate-800 text-sm group-hover:text-[#0B2A4A] transition-colors mb-1.5">${cat.nama}</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">${cat.deskripsi ?? ''}</p>
                </div>
                <div class="mt-5 pt-3 border-t border-slate-100 flex items-center justify-between text-[11px] font-semibold text-slate-400 group-hover:text-[#0B2A4A]">
                    <span>Pilih Layanan</span>
                    <span class="transition-transform group-hover:translate-x-1">→</span>
                </div>
            </div>
        `).join('');
    }

    function selectCategory(categoryId) {
        const category = CATEGORIES.find(c => c.id === categoryId);
        document.getElementById('selectedCategoryTitle').textContent = `Daftar Paket — ${category.nama}`;

        const list = document.getElementById('productList');

        if (!category.products || category.products.length === 0) {
            list.innerHTML = `<p class="text-xs text-slate-400 italic">Belum ada paket produk aktif pada kategori ini.</p>`;
        } else {
            list.innerHTML = category.products.map(p => `
                <div onclick="selectProduct(${p.id}, '${p.nama.replace(/'/g, "\\'")}')"
                    class="p-4 border border-slate-200/80 hover:border-[#0B2A4A] bg-white hover:bg-slate-50/80 rounded-xl cursor-pointer transition flex items-center justify-between group">
                    <div>
                        <p class="text-xs font-bold text-slate-800 group-hover:text-[#0B2A4A]">${p.nama}</p>
                        ${p.deskripsi ? `<p class="text-[11px] text-slate-500 mt-0.5">${p.deskripsi}</p>` : ''}
                    </div>
                    ${p.satuan ? `<span class="text-[10px] font-semibold bg-slate-100 text-slate-600 px-2.5 py-1 rounded-lg shrink-0 ml-3">${p.satuan}</span>` : ''}
                </div>
            `).join('');
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

        container.innerHTML = withDistance.map((b, index) => `
            <label class="flex items-center justify-between p-3.5 border rounded-xl cursor-pointer transition
                ${index === 0 ? 'border-[#0B2A4A] bg-sky-50/30' : 'border-slate-200 hover:border-slate-300'}">
                <div class="flex items-center gap-3">
                    <input type="radio" name="branchRadio" value="${b.id}" ${index === 0 ? 'checked' : ''}
                        onchange="document.getElementById('branchIdInput').value = ${b.id}; document.getElementById('submitBtn').disabled = false;"
                        class="text-[#0B2A4A] focus:ring-[#0B2A4A]">
                    <div>
                        <p class="text-xs font-bold text-slate-800">${b.nama}</p>
                        <p class="text-[11px] text-slate-500">${b.kota}</p>
                    </div>
                </div>
                ${b.distance !== null ? `<span class="text-[10px] font-bold text-emerald-700">± ${b.distance.toFixed(1)} km</span>` : ''}
            </label>
        `).join('');

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

        const titles = { 1: 'Pilih Jenis Layanan', 2: 'Pilih Paket Produk', 3: 'Lengkapi Detail Order' };
        const subTitles = { 
            1: 'Pilih kategori layanan yang sesuai dengan kebutuhan Anda.', 
            2: 'Pilih spesifikasi paket layanan yang akan diajukan.', 
            3: 'Tentukan lokasi dan cabang penanggung jawab order.' 
        };

        document.getElementById('stepTitle').textContent = titles[step];
        document.getElementById('stepSubTitle').textContent = subTitles[step];
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