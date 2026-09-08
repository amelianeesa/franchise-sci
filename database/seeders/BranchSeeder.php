<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    public function run(): void
    {
        $branches = [
            // JAWA & BALI
            ['kode_cabang' => 'CLP', 'nama_cabang' => 'Cabang Cilacap', 'provinsi' => 'Jawa Tengah', 'kota' => 'Cilacap', 'alamat' => 'Jl. Soekarno Hatta No.280, Kesugihan, Cilacap', 'latitude' => -7.7325, 'longitude' => 109.0136],
            ['kode_cabang' => 'SMG', 'nama_cabang' => 'Cabang Semarang', 'provinsi' => 'Jawa Tengah', 'kota' => 'Semarang', 'alamat' => 'Jl. Pemuda No.171, Semarang Tengah, Semarang', 'latitude' => -6.9667, 'longitude' => 110.4167],
            ['kode_cabang' => 'CJK', 'nama_cabang' => 'Cabang Jakarta', 'provinsi' => 'DKI Jakarta', 'kota' => 'Jakarta Utara', 'alamat' => 'Jl. Cumi No.33-35, Tanjung Priok, Jakarta Utara', 'latitude' => -6.1352, 'longitude' => 106.8133],
            ['kode_cabang' => 'BKS', 'nama_cabang' => 'Cabang Bekasi / Cibitung', 'provinsi' => 'Jawa Barat', 'kota' => 'Cibitung, Bekasi', 'alamat' => 'Jl. Arteri Tol Cibitung No.1, Sukadanau, Cibitung', 'latitude' => -6.2383, 'longitude' => 107.1000],
            ['kode_cabang' => 'BDG', 'nama_cabang' => 'Cabang Bandung', 'provinsi' => 'Jawa Barat', 'kota' => 'Bandung', 'alamat' => 'Jl. Terusan Jenderal Gatot Subroto No.109, Bandung', 'latitude' => -6.9147, 'longitude' => 107.6098],
            ['kode_cabang' => 'CRB', 'nama_cabang' => 'Cabang Cirebon', 'provinsi' => 'Jawa Barat', 'kota' => 'Cirebon', 'alamat' => 'Jl. DR. Sudarsono No.46, Kesambi, Cirebon', 'latitude' => -6.7063, 'longitude' => 108.5570],
            ['kode_cabang' => 'CLG', 'nama_cabang' => 'Cabang Cilegon', 'provinsi' => 'Banten', 'kota' => 'Cilegon', 'alamat' => 'Jl. Raya Serang No.106, Sukmajaya, Jombang, Cilegon', 'latitude' => -6.0025, 'longitude' => 106.0500],
            ['kode_cabang' => 'CSB', 'nama_cabang' => 'Cabang Surabaya', 'provinsi' => 'Jawa Timur', 'kota' => 'Surabaya', 'alamat' => 'Jl. Ahmad Yani No.315, Gayungan, Surabaya', 'latitude' => -7.2575, 'longitude' => 112.7521],
            ['kode_cabang' => 'DPS', 'nama_cabang' => 'Cabang Denpasar', 'provinsi' => 'Bali', 'kota' => 'Denpasar', 'alamat' => 'Jl. Tukad Badung, Renon, Denpasar Selatan', 'latitude' => -8.6705, 'longitude' => 115.2126],

            // SUMATRA
            ['kode_cabang' => 'LSM', 'nama_cabang' => 'Cabang Lhokseumawe', 'provinsi' => 'Aceh', 'kota' => 'Lhokseumawe', 'alamat' => 'Jl. Panglateh No.3, Lhokseumawe', 'latitude' => 5.1801, 'longitude' => 97.1507],
            ['kode_cabang' => 'MDN', 'nama_cabang' => 'Cabang Medan', 'provinsi' => 'Sumatera Utara', 'kota' => 'Medan', 'alamat' => 'Jl. Gatot Subroto Km 5,5 No.105, Medan', 'latitude' => 3.5952, 'longitude' => 98.6722],
            ['kode_cabang' => 'PKU', 'nama_cabang' => 'Cabang Pekanbaru', 'provinsi' => 'Riau', 'kota' => 'Pekanbaru', 'alamat' => 'Jl. Jenderal Sudirman No.408, Pekanbaru', 'latitude' => 0.5071, 'longitude' => 101.4478],
            ['kode_cabang' => 'DUM', 'nama_cabang' => 'Cabang Dumai', 'provinsi' => 'Riau', 'kota' => 'Dumai', 'alamat' => 'Jl. Jenderal Sudirman No.108, Dumai', 'latitude' => 1.6667, 'longitude' => 101.4500],
            ['kode_cabang' => 'PDG', 'nama_cabang' => 'Cabang Padang', 'provinsi' => 'Sumatera Barat', 'kota' => 'Padang', 'alamat' => 'Jl. Khatib Sulaiman No.51, Padang', 'latitude' => -0.9471, 'longitude' => 100.4172],
            ['kode_cabang' => 'BTM', 'nama_cabang' => 'Cabang Batam', 'provinsi' => 'Kepulauan Riau', 'kota' => 'Batam', 'alamat' => 'Jl. Raden Patah No.61, Baloi, Batam', 'latitude' => 1.0456, 'longitude' => 104.0305],
            ['kode_cabang' => 'JMB', 'nama_cabang' => 'Cabang Jambi', 'provinsi' => 'Jambi', 'kota' => 'Jambi', 'alamat' => 'Jl. Prof. Dr. Sri Soedewi Masjchun Sofwan, SH, Jambi', 'latitude' => -1.6101, 'longitude' => 103.6131],
            ['kode_cabang' => 'PLG', 'nama_cabang' => 'Cabang Palembang', 'provinsi' => 'Sumatera Selatan', 'kota' => 'Palembang', 'alamat' => 'Jl. Soekarno Hatta, Alang-Alang Lebar, Palembang', 'latitude' => -2.9761, 'longitude' => 104.7754],
            ['kode_cabang' => 'BDL', 'nama_cabang' => 'Cabang Bandar Lampung', 'provinsi' => 'Lampung', 'kota' => 'Bandar Lampung', 'alamat' => 'Jl. Gatot Subroto No.57, Garuntang, Bandar Lampung', 'latitude' => -5.4292, 'longitude' => 105.2610],

            // KALIMANTAN
            ['kode_cabang' => 'PTK', 'nama_cabang' => 'Cabang Pontianak', 'provinsi' => 'Kalimantan Barat', 'kota' => 'Kubu Raya', 'alamat' => 'Jl. Arteri Supadio KM 12,5, Sungai Raya, Kubu Raya', 'latitude' => -0.0263, 'longitude' => 109.3425],
            ['kode_cabang' => 'TRK', 'nama_cabang' => 'Cabang Tarakan', 'provinsi' => 'Kalimantan Utara', 'kota' => 'Tarakan', 'alamat' => 'Jl. Mulawarman No.20, Tarakan', 'latitude' => 3.3000, 'longitude' => 117.6333],
            ['kode_cabang' => 'BPP', 'nama_cabang' => 'Cabang Balikpapan', 'provinsi' => 'Kalimantan Timur', 'kota' => 'Balikpapan', 'alamat' => 'Jl. Jenderal Sudirman No.1, Balikpapan', 'latitude' => -1.2379, 'longitude' => 116.8529],
            ['kode_cabang' => 'SMD', 'nama_cabang' => 'Cabang Samarinda', 'provinsi' => 'Kalimantan Timur', 'kota' => 'Samarinda', 'alamat' => 'Jl. Teuku Umar No.1, Sungai Kunjang, Samarinda', 'latitude' => -0.5022, 'longitude' => 117.1536],
            ['kode_cabang' => 'BJM', 'nama_cabang' => 'Cabang Banjarmasin', 'provinsi' => 'Kalimantan Selatan', 'kota' => 'Banjar', 'alamat' => 'Jl. Jend. A. Yani Km 7,8 No.21A, Kertak Hanyar, Banjar', 'latitude' => -3.3186, 'longitude' => 114.5944],

            // SULAWESI, MALUKU, PAPUA
            ['kode_cabang' => 'MDO', 'nama_cabang' => 'Cabang Manado', 'provinsi' => 'Sulawesi Utara', 'kota' => 'Manado', 'alamat' => 'Jl. Pumorow No.54, Manado', 'latitude' => 1.4748, 'longitude' => 124.8421],
            ['kode_cabang' => 'MKS', 'nama_cabang' => 'Cabang Makassar', 'provinsi' => 'Sulawesi Selatan', 'kota' => 'Makassar', 'alamat' => 'Jl. Urip Sumoharjo KM 4 No.90, Makassar', 'latitude' => -5.1477, 'longitude' => 119.4327],
            ['kode_cabang' => 'KDI', 'nama_cabang' => 'Cabang Kendari', 'provinsi' => 'Sulawesi Tenggara', 'kota' => 'Kendari', 'alamat' => 'Jl. Mayjend S. Parman No.18, Kendari', 'latitude' => -3.9450, 'longitude' => 122.4989],
            ['kode_cabang' => 'AMQ', 'nama_cabang' => 'Cabang Ambon', 'provinsi' => 'Maluku', 'kota' => 'Ambon', 'alamat' => 'Jl. Jenderal Sudirman, Batu Merah, Sirimau, Ambon', 'latitude' => -3.6954, 'longitude' => 128.1814],
            ['kode_cabang' => 'JYP', 'nama_cabang' => 'Cabang Jayapura', 'provinsi' => 'Papua', 'kota' => 'Jayapura', 'alamat' => 'Jl. Kelapa Dua Entrop, Jayapura Selatan', 'latitude' => -2.5330, 'longitude' => 140.7181],
            ['kode_cabang' => 'TIM', 'nama_cabang' => 'Cabang Timika', 'provinsi' => 'Papua Tengah', 'kota' => 'Timika', 'alamat' => 'Jl. Agimuga, Mile 32, Timika', 'latitude' => -4.5461, 'longitude' => 136.8876],
        ];

        foreach ($branches as $branch) {
            Branch::updateOrCreate(
                ['kode_cabang' => $branch['kode_cabang']],
                array_merge($branch, ['is_active' => 1])
            );
        }
    }
}