<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ServiceCategory;
use App\Models\Product;
use Illuminate\Support\Str;
// use DB;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Product::truncate();
        ServiceCategory::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $sertifikasi = ServiceCategory::create([
            'nama' => 'Sertifikasi',
            'slug' => Str::slug('Sertifikasi'),
            'deskripsi' => 'Layanan sertifikasi produk, sistem manajemen, serta personel.'
        ]);

        $inspeksi = ServiceCategory::create([
            'nama' => 'Inspeksi & Audit',
            'slug' => Str::slug('Inspeksi & Audit'),
            'deskripsi' => 'Layanan inspeksi teknis dan audit kepatuhan sesuai standar industri.'
        ]);

        $pengujian = ServiceCategory::create([
            'nama' => 'Pengujian & Analisis',
            'slug' => Str::slug('Pengujian & Analisis'),
            'deskripsi' => 'Layanan pengujian laboratorium mutakhir dan analisis sampel.'
        ]);

        $konsultasi = ServiceCategory::create([
            'nama' => 'Konsultasi',
            'slug' => Str::slug('Konsultasi'),
            'deskripsi' => 'Layanan konsultasi teknis dan manajemen usaha secara berkelanjutan.'
        ]);

        $pelatihan = ServiceCategory::create([
            'nama' => 'Pelatihan',
            'slug' => Str::slug('Pelatihan'),
            'deskripsi' => 'Layanan pelatihan dan sertifikasi kompetensi personel profesional.'
        ]);

        $produkSertifikasi = [
'Asset Management System – ISO 55001',
            'Audit Air',
            'Audit Energi',
            'Audit Sistem Pemerintahan Berbasis Elektronik (SPBE)',
            'Corporate Social Responsibility',
            'Environmental Baseline Assessment',
            'Good Distribution Practices – Cara Distribusi yang Baik',
            'Green Building',
            'Green Building Greenship',
            'Green Gold Label (GGL)',
            'ISO 13485 – Sistem Manajemen Mutu Alat Kesehatan (SMMAK)',
            'ISO 14001 – Sistem Manajemen Lingkungan',
            'ISO 21001 – Sistem Manajemen Organisasi Pendidikan',
            'Green Building EDGE (IFC)',
            'ISO 22000 – Sistem Manajemen Keamanan Pangan',
            'ISO 28000 – Lembaga Manajemen Keamanan pada Rantai Pasokan',
            'ISO 29993:2017 – Layanan Pembelajaran di Luar Pendidikan Formal',
            'ISO 45001 – Sistem Manajemen Kesehatan dan Keselamatan Kerja',
            'ISO 9001 – Sistem Manajemen Mutu',
            'ISO/IEC 27001 – Sistem Manajemen Keamanan Informasi (SMKI)',
            'Layanan Sertifikasi Sistem Manajemen Kepatuhan – ISO 37301:2021',
            'Lembaga Validasi/Verifikasi Gas Rumah Kaca',
            'Lembaga Verifikasi Ekolabel',
            'Monitoring Kualitas Limbah',
            'Pengurusan Izin Pengusahaan Air Tanah (SIPA) dan Izin Pengusahaan Sumber Daya Air (IPSDA)',
            'Program Penilaian Peringkat Kinerja Perusahaan Dalam Pengelolaan Lingkungan Hidup (PROPER)',
            'Riksa Uji (Verifikasi, Inspeksi dan Pengujian Peralatan (Non NDT) dan Instalasi Industri Non Migas',
            'Sertifikasi Green Port',
            'Sertifikasi HACCP',
            'Sertifikasi Halal',
            'Sertifikasi Industri Hijau',
            'Sertifikasi Keberlanjutan (ISPO dan SVLK)',
            'Sertifikasi Laik Operasi (SLO)',
            'Sertifikasi Manajemen Terpadu',
            'Sertifikasi Pariwisata & SNI CHSE',
            'Sertifikasi Penyelenggara Umrah dan Haji Khusus',
            'Sertifikasi Produk',
            'Sertifikasi Produk (Standar Nasional Indonesia)',
            'Sertifikasi Produk Organik',
            'Sertifikasi Sistem Manajemen ISO',
            'Sertifikasi Sistem Manajemen Keselamatan Pertambangan',
            'Sertifikasi Sistem Pangan',
            'Sertifikasi SMK3 dan SMKP Mineral dan Batu Bara',
            'Sistem Manajemen Anti Penyuapan ISO 37001:2016',
            'Sistem Manajemen Integrasi (SMI)',
            'Sistem Manajemen Keselamatan dan Kesehatan Kerja (SMK3)',
            'Sistem Sertifikasi ISPO',
            'Sistem Verifikasi Legalitas dan Kelestarian (SVLK)',
            'SNI Pasar Rakyat',
            'Verifikasi Dokumen Pengendalian Potensi Bahaya Bahan Kimia',
            'Verifikasi Mekanisme Transisi Energi'
        ];
        foreach ($produkSertifikasi as $item) {
            Product::create([
                'service_category_id' => $sertifikasi->id,
                'nama_produk' => $item,
                'deskripsi' => 'Layanan Sertifikasi ' . $item . ' PT SUCOFINDO',
                'satuan' => 'Paket',
                'harga_dasar' => 0,
                'is_active' => true,
            ]);
        }

        $produkKonsultasi = [
'Asset Management System – ISO 55001',
            'Audit Air',
            'Audit Energi',
            'Audit Sistem Pemerintahan Berbasis Elektronik (SPBE)',
            'Corporate Social Responsibility',
            'Environmental Baseline Assessment',
            'Good Distribution Practices – Cara Distribusi yang Baik',
            'Green Building',
            'Green Building Greenship',
            'Green Gold Label (GGL)',
            'ISO 13485 – Sistem Manajemen Mutu Alat Kesehatan (SMMAK)',
            'ISO 14001 – Sistem Manajemen Lingkungan',
            'ISO 21001 – Sistem Manajemen Organisasi Pendidikan',
            'Green Building EDGE (IFC)',
            'ISO 22000 – Sistem Manajemen Keamanan Pangan',
            'ISO 28000 – Lembaga Manajemen Keamanan pada Rantai Pasokan',
            'ISO 29993:2017 – Layanan Pembelajaran di Luar Pendidikan Formal',
            'ISO 45001 – Sistem Manajemen Kesehatan dan Keselamatan Kerja',
            'ISO 9001 – Sistem Manajemen Mutu',
            'ISO/IEC 27001 – Sistem Manajemen Keamanan Informasi (SMKI)',
            'Layanan Sertifikasi Sistem Manajemen Kepatuhan – ISO 37301:2021',
            'Lembaga Validasi/Verifikasi Gas Rumah Kaca',
            'Lembaga Verifikasi Ekolabel',
            'Monitoring Kualitas Limbah',
            'Pengurusan Izin Pengusahaan Air Tanah (SIPA) dan Izin Pengusahaan Sumber Daya Air (IPSDA)',
            'Program Penilaian Peringkat Kinerja Perusahaan Dalam Pengelolaan Lingkungan Hidup (PROPER)',
            'Riksa Uji (Verifikasi, Inspeksi dan Pengujian Peralatan (Non NDT) dan Instalasi Industri Non Migas',
            'Sertifikasi Green Port',
            'Sertifikasi HACCP',
            'Sertifikasi Halal',
            'Sertifikasi Industri Hijau',
            'Sertifikasi Keberlanjutan (ISPO dan SVLK)',
            'Sertifikasi Laik Operasi (SLO)',
            'Sertifikasi Manajemen Terpadu',
            'Sertifikasi Pariwisata & SNI CHSE',
            'Sertifikasi Penyelenggara Umrah dan Haji Khusus',
            'Sertifikasi Produk',
            'Sertifikasi Produk (Standar Nasional Indonesia)',
            'Sertifikasi Produk Organik',
            'Sertifikasi Sistem Manajemen ISO',
            'Sertifikasi Sistem Manajemen Keselamatan Pertambangan',
            'Sertifikasi Sistem Pangan',
            'Sertifikasi SMK3 dan SMKP Mineral dan Batu Bara',
            'Sistem Manajemen Anti Penyuapan ISO 37001:2016',
            'Sistem Manajemen Integrasi (SMI)',
            'Sistem Manajemen Keselamatan dan Kesehatan Kerja (SMK3)',
            'Sistem Sertifikasi ISPO',
            'Sistem Verifikasi Legalitas dan Kelestarian (SVLK)',
            'SNI Pasar Rakyat',
            'Verifikasi Dokumen Pengendalian Potensi Bahaya Bahan Kimia',
            'Verifikasi Mekanisme Transisi Energi'
        ];
        foreach ($produkKonsultasi as $item) {
            Product::create([
                'service_category_id' => $konsultasi->id,
                'nama_produk' => $item,
                'deskripsi' => 'Layanan Konsultasi ' . $item . ' PT SUCOFINDO',
                'satuan' => 'Dokumen / Proyek',
                'harga_dasar' => 0,
                'is_active' => true,
            ]);
        }

        $produkInspeksi = [
            'Asset Management System – ISO 55001',
            'Audit Air',
            'Audit Energi',
            'Audit Sistem Pemerintahan Berbasis Elektronik (SPBE)',
            'Corporate Social Responsibility',
            'Environmental Baseline Assessment',
            'Good Distribution Practices – Cara Distribusi yang Baik',
            'Green Building',
            'Green Building Greenship',
            'Green Gold Label (GGL)',
            'ISO 13485 – Sistem Manajemen Mutu Alat Kesehatan (SMMAK)',
            'ISO 14001 – Sistem Manajemen Lingkungan',
            'ISO 21001 – Sistem Manajemen Organisasi Pendidikan',
            'Green Building EDGE (IFC)',
            'ISO 22000 – Sistem Manajemen Keamanan Pangan',
            'ISO 28000 – Lembaga Manajemen Keamanan pada Rantai Pasokan',
            'ISO 29993:2017 – Layanan Pembelajaran di Luar Pendidikan Formal',
            'ISO 45001 – Sistem Manajemen Kesehatan dan Keselamatan Kerja',
            'ISO 9001 – Sistem Manajemen Mutu',
            'ISO/IEC 27001 – Sistem Manajemen Keamanan Informasi (SMKI)',
            'Layanan Sertifikasi Sistem Manajemen Kepatuhan – ISO 37301:2021',
            'Lembaga Validasi/Verifikasi Gas Rumah Kaca',
            'Lembaga Verifikasi Ekolabel',
            'Monitoring Kualitas Limbah',
            'Pengurusan Izin Pengusahaan Air Tanah (SIPA) dan Izin Pengusahaan Sumber Daya Air (IPSDA)',
            'Program Penilaian Peringkat Kinerja Perusahaan Dalam Pengelolaan Lingkungan Hidup (PROPER)',
            'Riksa Uji (Verifikasi, Inspeksi dan Pengujian Peralatan (Non NDT) dan Instalasi Industri Non Migas',
            'Sertifikasi Green Port',
            'Sertifikasi HACCP',
            'Sertifikasi Halal',
            'Sertifikasi Industri Hijau',
            'Sertifikasi Keberlanjutan (ISPO dan SVLK)',
            'Sertifikasi Laik Operasi (SLO)',
            'Sertifikasi Manajemen Terpadu',
            'Sertifikasi Pariwisata & SNI CHSE',
            'Sertifikasi Penyelenggara Umrah dan Haji Khusus',
            'Sertifikasi Produk',
            'Sertifikasi Produk (Standar Nasional Indonesia)',
            'Sertifikasi Produk Organik',
            'Sertifikasi Sistem Manajemen ISO',
            'Sertifikasi Sistem Manajemen Keselamatan Pertambangan',
            'Sertifikasi Sistem Pangan',
            'Sertifikasi SMK3 dan SMKP Mineral dan Batu Bara',
            'Sistem Manajemen Anti Penyuapan ISO 37001:2016',
            'Sistem Manajemen Integrasi (SMI)',
            'Sistem Manajemen Keselamatan dan Kesehatan Kerja (SMK3)',
            'Sistem Sertifikasi ISPO',
            'Sistem Verifikasi Legalitas dan Kelestarian (SVLK)',
            'SNI Pasar Rakyat',
            'Verifikasi Dokumen Pengendalian Potensi Bahaya Bahan Kimia',
            'Verifikasi Mekanisme Transisi Energi'

        ];
        foreach ($produkInspeksi as $item) {
            Product::create([
                'service_category_id' => $inspeksi->id,
                'nama_produk' => $item,
                'deskripsi' => 'Layanan Inspeksi & Audit ' . $item . ' PT SUCOFINDO',
                'satuan' => 'Laporan / Unit',
                'harga_dasar' => 0,
                'is_active' => true,
            ]);
        }

        $produkPelatihan = [
            'Bimbingan Teknis dan Pelatihan TIC Pertambangan Mineral',
            'Bimbingan Teknis Pengembangan, Penyelenggaraan dan Pembangunan Telematika Terpadu di Sektor Pemerintahan Terkait Investasi',
            'Bimbingan Teknis Perencanaan, Pelaksanaan, Pemantauan, dan Evaluasi di Sektor Pemerintahan Terkait Investasi',
            'Fasilitas Bimbingan dan Pendampingan Teknis Program Layanan Publik',
            'Fasilitas Bimbingan Teknis, Pelaksanaan, dan Pemantauan Program Layanan Publik',
            'Pelatihan Industri Halal', 'Pelatihan Pemastian Mutu Kegiatan Industri',
            'Pelatihan Pengukuran Minyak dan Pengendalian Kebocoran'
        ];
        foreach ($produkPelatihan as $item) {
            Product::create([
                'service_category_id' => $pelatihan->id,
                'nama_produk' => $item,
                'deskripsi' => 'Layanan Pelatihan ' . $item . ' PT SUCOFINDO',
                'satuan' => 'Peserta / Sesi',
                'harga_dasar' => 0,
                'is_active' => true,
            ]);
        }

        $produkPengujian = [
'Analisis Coal Bed Methane',
            'Analisis dan Sertifikasi Kelayakan, Keamanan, Komposisi serta Kehalalan Pangan',
            'Analisis dan Sertifikasi Kosmetik, Obat, dan Obat Tradisional',
            'Analisis dan Sertifikasi Mainan, Tekstil, Kemasan, Keramik, Mebel, Karet, Plastik, serta Produk Konsumen Lainnya',
            'Analisis Petrokimia, Pupuk, Bahan Kimia, dan Pestisida Formulasi',
            'Analisis Produk Pertanian, Minyak dan Lemak, Hortikultura, dan Produk Olahannya',
            'Kalibrasi Alat Kesehatan',
            'Kalibrasi Alat Sparing',
            'Kalibrasi Dimensi, Massa, Tekanan, Listrik, Gaya, Temperatur, Volume, dan Instrumentasi Peralatan',
            'Kalibrasi Peralatan Custody Transfer dan Kalibrasi Tangki',
            'NDT (Non Destructive Test) atau Uji Tanpa Rusak',
            'Pengujian Air Bersih',
            'Pengujian Air Beton',
            'Pengujian Air Danau',
            'Pengujian Air Hemodialisis',
            'Pengujian Air Industri',
            'Pengujian Air Kolam Renang',
            'Pengujian Air Laboratorium',
            'Pengujian Air Laut',
            'Pengujian Air Limbah Domestik',
            'Pengujian Air Limbah Industri',
            'Pengujian Air Lindi Tempat Pemrosesan Akhir Sampah',
            'Pengujian Air Minum',
            'Pengujian Air Minum dalam Kemasan',
            'Pengujian Air Pemandian Umum',
            'Pengujian Air Solus Per Aqua (SPA)',
            'Pengujian Air Sungai',
            'Pengujian Air untuk Keperluan Higiene dan Sanitasi',
            'Pengujian Alat Kesehatan',
            'Pengujian Arang Aktif',
            'Pengujian Bahan Bakar Gas',
            'Pengujian Bahan Bakar Industri dan Perkapalan',
            'Pengujian Bahan Bakar Nabati',
            'Pengujian Bahan Bakar Nabati Jenis Bioetanol',
            'Pengujian Bahan Bakar Pesawat Terbang',
            'Pengujian Bahan Kimia Anorganik',
            'Pengujian Bahan Kimia Organik',
            'Pengujian Bahan Tambang',
            'Pengujian Bensin',
            'Pengujian Emisi Sumber Bergerak',
            'Pengujian Emisi Sumber Tidak Bergerak',
            'Pengujian Frekuensi Radio Peralatan',
            'Pengujian Gangguan Lingkungan (Kebisingan, Getaran dan Kebauan)',
            'Pengujian K3 Lingkungan Kerja',
            'Pengujian Kesehatan Lingkungan',
            'Pengujian Kesuburan Tanah',
            'Pengujian Kinerja CEMS',
            'Pengujian Minyak Mentah',
            'Pengujian Minyak Tanah',
            'Pengujian Oli Trafo',
            'Pengujian Pelumas',
            'Pengujian Pemanfaat Listrik Rumah Tangga',
            'Pengujian Peralatan Audio Video dan Mainan Listrik Anak',
            'Pengujian Peralatan Informasi Teknologi',
            'Pengujian Peralatan Instalasi Listrik',
            'Pengujian Peralatan Pencahayaan',
            'Pengujian Peralatan Teknik Otomotif dan SNI Teknik',
            'Pengujian Pestisida',
            'Pengujian Produk Batuan, Beton, dan Tanah',
            'Pengujian Produk Pembersih Rumah Tangga',
            'Pengujian Produk Pencuci Pakaian',
            'Pengujian Produk Perawatan Bayi',
            'Pengujian Pupuk Organik',
            'Pengujian Sampel dan Analisis Biologi Lingkungan, Mikrobiologi, serta Kajiannya',
            'Pengujian Sampel dan Analisis Gas di Tempat maupun di Laboratorium serta Kajiannya',
            'Pengujian Sampel dan Analisis Limbah Padat, B-3, Tanah Terkontaminasi, serta Kajiannya',
            'Pengujian Sampel dan Analisis Petroleum dan Produknya',
            'Pengujian Sampel, Analisis, dan Pemantauan Kualitas Air',
            'Pengujian Sampel, Analisis, dan Pemantauan Kualitas Udara Ambien, Kualitas Udara Dalam Ruang, Kebisingan dan Emisi serta Kajiannya',
            'Pengujian Sample dan Analisis EBT (Energi Baru Terbarukan)',
            'Pengujian Solar',
            'Pengujian Tanah Terkontaminasi Minyak yang diolah dengan Bioremediasi',
            'Pengujian Teknik Sipil, Mekanik, dan Mesin Peralatan',
            'Pengujian Tisu dan Kapas untuk Kesehatan',
            'Pengujian Udara Ambien Lingkungan'
        ];

        $produkPengujianUnique = array_unique($produkPengujian);

        foreach ($produkPengujianUnique as $item) {
            Product::create([
                'service_category_id' => $pengujian->id,
                'nama_produk' => $item,
                'deskripsi' => 'Layanan Pengujian & Analisis ' . $item . ' PT SUCOFINDO',
                'satuan' => 'Sampel / Pengujian',
                'harga_dasar' => 0,
                'is_active' => true,
            ]);
        }
    }
}