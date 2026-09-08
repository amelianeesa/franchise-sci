<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\JobAssignment;

class PusatController extends Controller
{
    // Menampilkan halaman Order Masuk dan update progres tenaga ahli
    public function orderMasuk()
    {
        // Mengambil daftar order masuk dengan relasi pelanggan dan cabang
        $orders = Order::with(['customer', 'branch'])->latest()->get();

        // Mengambil log progres pengerjaan dari tenaga ahli untuk dipantau admin
        $jobFeeds = JobAssignment::with(['order', 'tenagaAhli'])->latest()->get();

        return view('admin.order-masuk', compact('orders', 'jobFeeds'));
    }

    // Admin menyetujui order masuk
    public function approve($id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => 'po_terbit']);

        return redirect()->route('admin.order-masuk')->with('success', 'Order berhasil disetujui dan PO diterbitkan.');
    }

    // Admin menolak order dengan mencantumkan alasan
    public function reject(Request $request, $id)
    {
        $request->validate([
            'alasan_penolakan' => 'required|string|max:500'
        ]);

        $order = Order::findOrFail($id);
        $order->update([
            'status' => 'ditolak',
            'catatan_pelanggan' => 'Ditolak Admin: ' . $request->alasan_penolakan
        ]);

        return redirect()->route('admin.order-masuk')->with('error', 'Order berhasil ditolak dengan catatan.');
    }
}