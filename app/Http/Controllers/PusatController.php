<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\JobAssignment;

class PusatController extends Controller
{
    public function orderMasuk()
    {
        $orders = Order::with(['customer', 'branch', 'product'])->latest()->get();

        $jobFeeds = JobAssignment::with(['order', 'tenagaAhli'])->latest()->get();

        return view('admin.order_masuk', compact('orders', 'jobFeeds'));
    }

    public function index()
    {
        $totalOrder = Order::count();
        $menungguVerifikasi = Order::where('status', 'pengajuan')->count();
        $selesaiDiproses = Order::where('status', 'selesai')->count();

        return view('admin.dashboard', compact('totalOrder', 'menungguVerifikasi', 'selesaiDiproses'));
    }

    public function approve($id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => 'po_terbit']);

        return redirect()->route('admin.order_masuk')->with('success', 'Order berhasil disetujui dan PO diterbitkan.');
    }

public function reject(Request $request, $id)
{
    $request->validate([
        'alasan_penolakan' => 'required|string|max:500'
    ]);

    $order = Order::findOrFail($id);
    $order->update([
        'status' => 'ditolak',
        'alasan_penolakan' => $request->alasan_penolakan,
    ]);

    return redirect()->route('admin.order_masuk')->with('error', 'Order berhasil ditolak dengan catatan');
}
}