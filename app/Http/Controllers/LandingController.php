<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        // Data dummy layanan
        $layanan = [
            ['icon' => '🧪', 'judul' => 'Pengujian & Analisis', 'deskripsi' => 'Lab uji material, pangan, lingkungan.'],
            ['icon' => '🔍', 'judul' => 'Inspeksi & Audit', 'deskripsi' => 'Verifikasi mutu, kuantitas, kepatuhan.'],
            ['icon' => '📜', 'judul' => 'Sertifikasi', 'deskripsi' => 'ISO, produk, sistem manajemen.'],
            ['icon' => '💼', 'judul' => 'Konsultasi', 'deskripsi' => 'Pendampingan teknis & regulasi.'],
            ['icon' => '🎓', 'judul' => 'Pelatihan', 'deskripsi' => 'Sertifikasi kompetensi tenaga kerja.']
        ];

        // Data dummy status tracking
        $trackingDemo = [
            'nomor_order' => 'ORD/CLP/2026/08/0142',
            'status' => 'Dikerjakan Tenaga Ahli'
        ];

        return view('landing', compact('layanan', 'trackingDemo'));
    }
}