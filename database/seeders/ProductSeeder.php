<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ServiceCategory;
use App\Models\Product;
use DB;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Truncate/kosongkan tabel terlebih dahulu
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Product::truncate();
        ServiceCategory::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 1. BUAT KATEGORI UTAMA
        $sertifikasi = ServiceCategory::create([
            'nama' => 'Sertifikasi',
            'deskripsi' => 'Layanan sertifikasi produk, sistem manajemen, serta personel.'
        ]);

        $inspeksi = ServiceCategory::create([
            'nama' => 'Inspeksi & Audit',
            'deskripsi' => 'Layanan inspeksi teknis dan audit kepatuhan sesuai standar industri.'
        ]);

        $pengujian = ServiceCategory::create([
            'nama' => 'Pengujian & Analisis',
            'deskripsi' => 'Layanan pengujian laboratorium mutakhir dan analisis sampel.'
        ]);

        $konsultasi = ServiceCategory::create([
            'nama' => 'Konsultasi',
            'deskripsi' => 'Layanan konsultasi teknis dan manajemen usaha secara berkelanjutan.'
        ]);

        $pelatihan = ServiceCategory::create([
            'nama' => 'Pelatihan',
            'deskripsi' => 'Layanan pelatihan dan sertifikasi kompetensi personel profesional.'
        ]);

        // 2. DATA PRODUK SERTIFIKASI
        $produkSertifikasi = [
            'Asset Management System – ISO 55001', 'Audit Air', 'Audit Energi', 
            'Corporate Social Responsibility', 'Environmental Baseline Assessment', 
            'Green Building EDGE (IFC)', 'Good Distribution Practices – Cara Distribusi yang Baik', 
            'Green Building Greenship', 'ISO 13485 – Sistem Manajemen Mutu Alat Kesehatan', 
            'ISO 22000 – Sistem Manajemen Keamanan Pangan', 'ISO 14001 – Sistem Manajemen Lingkungan', 
            'ISO 45001 – Sistem Manajemen K3', 'ISO 9001 – Sistem Manajemen Mutu', 
            'ISO/IEC 27001 – Sistem Manajemen Keamanan Informasi', 'Sertifikasi Halal', 
            'Sertifikasi Industri Hijau', 'Sertifikasi Produk (SNI)', 'Sertifikasi SMK3'
        ];
        foreach ($produkSertifikasi as $item) {
            Product::create([
                'service_category_id' => $sertifikasi->id,
                'nama' => $item,
                'deskripsi' => 'Layanan Sertifikasi ' . $item . ' PT SUCOFINDO',
                'satuan' => 'Paket'
            ]);
        }

        // 3. DATA PRODUK KONSULTASI (Gambar 1)
        $produkKonsultasi = [
            'Enterprise Solutions Human Resources', 'Environmental and Social Impact Assessment (ESIA)',
            'Environmental, Social, and Governance (ESG)', 'European Union Deforestation Regulation (EUDR)',
            'Fasilitas Pengelolaan Sampah dan Pengelolaan Limbah Kota', 'Jasa AMDAL dan Dokumen Lingkungan Lainnya',
            'Jasa Konsultasi Penyusunan Dokumen Biodiversity Action Plan (BAP)', 'Konsultasi dan Kajian Terkait Sumber Daya Alam',
            'Konsultasi di Bidang Energi Baru dan Terbarukan', 'Konsultasi di Bidang Produk dan Keindustrian Minyak dan Gas Bumi',
            'Konsultasi Pelaksanaan GMP (Good Manufacturing Practices)', 'Konsultasi Pengembangan dan Pembangunan Layanan Publik Berbasis Telematika Terpadu',
            'Konsultasi Pengembangan dan Pembangunan Telematika Terpadu di Sektor Pemerintahan terkait Investasi',
            'Konsultasi Perencanaan, Pelaksanaan, dan Pemantauan Program Layanan Publik', 'Konsultasi Tambang Mineral dan Infrastruktur',
            'Konsultasi terhadap Kehandalan dan Keamanan Peralatan dan Instalasi Industri Migas',
            'Konsultasi, Perencanaan, Pelaksanaan, Pemantauan, dan Evaluasi di Sektor Pemerintahan terkait Investasi',
            'Life Cycle Assessment (LCA)', 'Penyusunan UKL-UPL', 'Sistem Informasi Geografis',
            'Sistem Pemantauan Kualitas Air Limbah Secara Terus Menerus dan Dalam Jaringan (Sparing)', 'Survei Kepuasan Pelanggan (SKP)'
        ];
        foreach ($produkKonsultasi as $item) {
            Product::create([
                'service_category_id' => $konsultasi->id,
                'nama' => $item,
                'deskripsi' => 'Layanan Konsultasi ' . $item . ' PT SUCOFINDO',
                'satuan' => 'Dokumen / Proyek'
            ]);
        }

        // 4. DATA PRODUK INSPEKSI DAN AUDIT (Gambar 2)
        $produkInspeksi = [
            'Assurer Laporan Keberlanjutan Perusahaan', 'Audit Energi Industri dan Bangunan Gedung',
            'Audit Kapabilitas dan Kapasitas Pabrik', 'Audit Lingkungan Hidup',
            'Audit Kelayakan Penanganan Hewan dan Kemamputelusuran', 'Commissioning Fasilitas TIC Pertambangan Mineral',
            'Inspeksi dan Audit Komoditas Pertanian dan Pangan', 'Inspeksi dan Supervisi Mineral dan Metalurgi',
            'Inspeksi dan Supervisi Produk Batuan, Beton, dan Tanah', 'Inspeksi dan Survei Industri Minyak, Gas Alam, Produk Kilang, dan Turunannya',
            'Inspeksi dan Verifikasi Produk Kehutanan', 'Inspeksi Komoditi Batu Bara',
            'Inspeksi Pra-Pengapalan', 'Inspeksi Produk Industri', 'Inspeksi Produk Konsumen',
            'Inspeksi Tempat Penyimpanan Barang', 'Inspeksi, Verifikasi, dan Pelatihan TKDN',
            'Inventarisasi Gas Rumah Kaca (GRK)', 'Kaji Ulang Rancangan (Design Review) Verifikasi, Inspeksi, Pengujian, Pengawasan Konstruksi, dan Audit Kelaikan Infrastruktur',
            'Kajian, Audit, dan Pemantauan Pengelolaan Lingkungan Terpadu', 'Manajemen Agunan atau Persediaan',
            'Pengendalian Hama', 'Pemantauan Agunan atau Persediaan', 'Perencanaan dan Pengelolaan Reduce- Reuse-Recycle-Recovery',
            'Perencanaan dan Rekayasa Instalasi Air Bersih dan Air Limbah', 'QA/QC Engineering',
            'QA/QC untuk Fasilitas Industri Migas, Pertambangan, serta Pembangkit Listrik', 'Quantity Assurance',
            'Survei Aerial (UAV, LiDAR, dan Satellite Imagery)', 'Survei dan Pemataan Wilayah',
            'Survei dan Pemetaan terkait Investasi', 'Survei Inventarisasi, Verifikasi, dan Validasi Data Layanan Publik',
            'Survei Kemaritiman', 'Survei Seismik', 'Survei Terestris (GPS, Topografi, dan Kadastral)',
            'Validasi dan Verifikasi Pernyataan Lingkungan', 'Verifikasi atau Estimasi Persediaan',
            'Verifikasi Dan Inspeksi Peralatan serta Instalasi Industri Migas', 'Verifikasi Impor Barang Modal Dalam Keadaan Tidak Baru',
            'Verifikasi Material Balance', 'Verifikasi Rencana dan Kemajuan Fisik Pembangunan Fasilitas Pemurnian (Smelter)',
            'Verifikasi, Inspeksi, dan Pengujian Peralatan serta Instalasi Industri Non Migas',
            'Verifikasi, Inspeksi, Pengujian, Instalasi Peralatan dan Penanggulangan Tanggap Kebakaran',
            'Verifikasi, Konsultasi, dan Pelatihan terkait Industri 4.0', 'Witnessing Bahan Tambang',
            'Witnessing Mineral Processing dan Metalurgi'
        ];
        foreach ($produkInspeksi as $item) {
            Product::create([
                'service_category_id' => $inspeksi->id,
                'nama' => $item,
                'deskripsi' => 'Layanan Inspeksi & Audit ' . $item . ' PT SUCOFINDO',
                'satuan' => 'Laporan / Unit'
            ]);
        }

        // 5. DATA PRODUK PELATIHAN (Gambar 3)
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
                'nama' => $item,
                'deskripsi' => 'Layanan Pelatihan ' . $item . ' PT SUCOFINDO',
                'satuan' => 'Peserta / Sesi'
            ]);
        }

        // 6. DATA PRODUK PENGUJIANK DAN ANALISIS (Daftar Teks)
        $produkPengujian = [
            'Analisis Coal Bed Methane', 'Analisis dan Sertifikasi Kelayakan, Keamanan, Komposisi serta Kehalalan Pangan',
            'Analisis dan Sertifikasi Kosmetik, Obat, dan Obat Tradisional', 'Analisis dan Sertifikasi Mainan, Tekstil, Kemasan, Keramik, Mebel, Karet, Plastik, serta Produk Konsumen Lainnya',
            'Analisis Petrokimia, Pupuk, Bahan Kimia, dan Pestisida Formulasi', 'Analisis Produk Pertanian, Minyak dan Lemak, Hortikultura, dan Produk Olahannya',
            'Kalibrasi Alat Kesehatan', 'Kalibrasi Alat Sparing', 'Kalibrasi Dimensi, Massa, Tekanan, Listrik, Gaya, Temperatur, Volume, dan Instrumentasi Peralatan',
            'Kalibrasi Peralatan Custody Transfer dan Kalibrasi Tangki', 'NDT (Non Destructive Test) atau Uji Tanpa Rusak',
            'Pengujian Air Bersih', 'Pengujian Air Beton', 'Pengujian Air Danau', 'Pengujian Air Hemodialisis',
            'Pengujian Air Industri', 'Pengujian Air Kolam Renang', 'Pengujian Air Laboratorium', 'Pengujian Air Laut',
            'Pengujian Air Limbah Domestik', 'Pengujian Air Limbah Industri', 'Pengujian Air Lindi Tempat Pemrosesan Akhir Sampah',
            'Pengujian Air Minum', 'Pengujian Air Minum dalam Kemasan', 'Pengujian Air Pemandian Umum',
            'Pengujian Air Solus Per Aqua (SPA)', 'Pengujian Air Sungai', 'Pengujian Air untuk Keperluan Higiene dan Sanitasi',
            'Pengujian Alat Kesehatan', 'Pengujian Arang Aktif', 'Pengujian Bahan Bakar Gas', 'Pengujian Bahan Bakar Industri dan Perkapalan',
            'Pengujian Bahan Bakar Nabati', 'Pengujian Bahan Bakar Nabati Jenis Bioetanol', 'Pengujian Bahan Bakar Pesawat Terbang',
            'Pengujian Bahan Kimia Anorganik', 'Pengujian Bahan Kimia Organik', 'Pengujian Bahan Tambang', 'Pengujian Bensin',
            'Pengujian Emisi Sumber Bergerak', 'Pengujian Emisi Sumber Tidak Tidak Bergerak', 'Pengujian Frekuensi Radio Peralatan',
            'Pengujian Gangguan Lingkungan (Kebisingan, Getaran dan Kebauan)', 'Pengujian K3 Lingkungan Kerja',
            'Pengujian Kesehatan Lingkungan', 'Pengujian Kesuburan Tanah', 'Pengujian Kinerja CEMS', 'Pengujian Minyak Mentah',
            'Pengujian Minyak Tanah', 'Pengujian Oli Trafo', 'Pengujian Pelumas', 'Pengujian Pemanfaat Listrik Rumah Tangga',
            'Pengujian Peralatan Audio Video dan Mainan Listrik Anak', 'Pengujian Peralatan Informasi Teknologi',
            'Pengujian Peralatan Instalasi Listrik', 'Pengujian Peralatan Pencahayaan', 'Pengujian Peralatan Teknik Otomotif dan SNI Teknik',
            'Pengujian Pestisida', 'Pengujian Produk Batuan, Beton, dan Tanah', 'Pengujian Produk Pembersih Rumah Tangga',
            'Pengujian Produk Pencuci Pakaian', 'Pengujian Produk Perawatan Bayi', 'Pengujian Pupuk Organik',
            'Pengujian Sampel dan Analisis Biologi Lingkungan, Mikrobiologi, serta Kajiannya',
            'Pengujian Sampel dan Analisis Gas di Tempat maupun di Laboratorium serta Kajiannya',
            'Pengujian Sampel dan Analisis Limbah Padat, B-3, Tanah Terkontaminasi, serta Kajiannya',
            'Pengujian Sampel dan Analisis Petroleum dan Produknya', 'Pengujian Sampel, Analisis, dan Pemantauan Kualitas Air',
            'Pengujian Sampel, Analisis, dan Pemantauan Kualitas Udara Ambien, Kualitas Udara Dalam Ruang, Kebisingan dan Emisi serta Kajiannya',
            'Pengujian Sample dan Analisis EBT (Energi Baru Terbarukan)', 'Pengujian Solar',
            'Pengujian Tanah Terkontaminasi Minyak yang diolah dengan Bioremediasi', 'Pengujian Teknik Sipil, Mekanik, dan Mesin Peralatan',
            'Pengujian Tisu dan Kapas untuk Kesehatan', 'Pengujian Udara Ambien Lingkungan'
        ];

        // Filter duplikat nama produk pengujian
        $produkPengujianUnique = array_unique($produkPengujian);

        foreach ($produkPengujianUnique as $item) {
            Product::create([
                'service_category_id' => $pengujian->id,
                'nama' => $item,
                'deskripsi' => 'Layanan Pengujian & Analisis ' . $item . ' PT SUCOFINDO',
                'satuan' => 'Sampel / Pengujian'
            ]);
        }
    }
}