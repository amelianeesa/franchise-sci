<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LacakController extends Controller
{
    public function index(Request $request)
    {
        $kodeOrder = $request->get('kode_order');
        $order = null;

        if ($kodeOrder) {
            $order = Order::with(['product', 'branch', 'customer'])
                ->where('kode_order', trim($kodeOrder))
                ->first();
        }

        $recentOrders = Order::with('product')
            ->where('customer_id', Auth::id())
            ->latest()
            ->take(3)
            ->get();

        return view('lacak.index', compact('order', 'kodeOrder', 'recentOrders'));
    }

    public function search(Request $request)
    {
        $request->validate([
            'kode_order' => 'required|string',
        ], [
            'kode_order.required' => 'Silakan masukkan kode order terlebih dahulu.',
        ]);

        return redirect()->route('lacak.index', ['kode_order' => $request->kode_order]);
    }
}