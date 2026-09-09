<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $stats = [
            'order_aktif' => $user->orders()
                ->whereIn('status', ['pengajuan', 'menunggu_persetujuan_penawaran', 'po_terbit', 'dikerjakan'])
                ->count(),
            'menunggu_pembayaran' => $user->orders()
                ->where('status', 'menunggu_pembayaran')
                ->count(),
            'sertifikat_terbit' => $user->orders()
                ->where('status', 'selesai')
                ->count(),
        ];

        $recentOrders = $user->orders()
            ->with(['product', 'branch'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.index', compact('user', 'stats', 'recentOrders'));
    }
}