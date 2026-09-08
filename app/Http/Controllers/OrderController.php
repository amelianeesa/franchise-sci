<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Order;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function create()
    {
        $categories = ServiceCategory::where('is_active', true)
            ->with([
                'products' => function ($query) {
                    $query->where('is_active', true);
                }
            ])
            ->get();

        $branches = Branch::where('is_active', true)->get();

        $wilayahList = [
            'Jawa & Bali' => ['Jawa Tengah', 'DKI Jakarta', 'Jawa Barat', 'Banten', 'Jawa Timur', 'DI Yogyakarta', 'Bali'],
            'Sumatera' => ['Aceh', 'Sumatera Utara', 'Sumatera Barat', 'Riau', 'Kepulauan Riau', 'Jambi', 'Bengkulu', 'Sumatera Selatan', 'Kepulauan Bangka Belitung', 'Lampung'],
            'Kalimantan' => ['Kalimantan Barat', 'Kalimantan Tengah', 'Kalimantan Selatan', 'Kalimantan Timur', 'Kalimantan Utara'],
            'Sulawesi & Maluku' => ['Sulawesi Utara', 'Sulawesi Tengah', 'Sulawesi Selatan', 'Sulawesi Tenggara', 'Gorontalo', 'Sulawesi Barat', 'Maluku', 'Maluku Utara'],
            'Papua & Nusa Tenggara' => ['Nusa Tenggara Barat', 'Nusa Tenggara Timur', 'Papua', 'Papua Barat', 'Papua Selatan', 'Papua Tengah', 'Papua Pegunungan', 'Papua Barat Daya'],
        ];
        $provinsiList = collect($wilayahList)->flatten()->all();

        return view('order.create', [
            'categories' => $categories,
            'branchesJson' => $branches,
            'wilayahList' => $wilayahList,
            'provinsiList' => $provinsiList,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'branch_id' => 'required|exists:branches,id',
            'catatan_pelanggan' => 'nullable|string|max:1000',
        ]);

        $branch = Branch::findOrFail($validated['branch_id']);

        $order = Order::create([
            'kode_order' => $this->generateKodeOrder($branch),
            'customer_id' => Auth::id(),
            'branch_id' => $branch->id,
            'product_id' => $validated['product_id'],
            'catatan_pelanggan' => $validated['catatan_pelanggan'] ?? null,
            'status' => 'pengajuan',
        ]);

        return redirect()->route('order.show', $order)
            ->with('success', 'Order berhasil diajukan. Menunggu persetujuan admin pusat.');
    }

    public function index()
    {
        $categories = ServiceCategory::where('is_active', true)
            ->with([
                'products' => function ($query) {
                    $query->where('is_active', true);
                }
            ])
            ->get();

        $branches = Branch::where('is_active', true)->get();

        $wilayahList = [
            'Jawa & Bali' => ['Jawa Tengah', 'DKI Jakarta', 'Jawa Barat', 'Banten', 'Jawa Timur', 'DI Yogyakarta', 'Bali'],
            'Sumatera' => ['Aceh', 'Sumatera Utara', 'Sumatera Barat', 'Riau', 'Kepulauan Riau', 'Jambi', 'Bengkulu', 'Sumatera Selatan', 'Kepulauan Bangka Belitung', 'Lampung'],
            'Kalimantan' => ['Kalimantan Barat', 'Kalimantan Tengah', 'Kalimantan Selatan', 'Kalimantan Timur', 'Kalimantan Utara'],
            'Sulawesi & Maluku' => ['Sulawesi Utara', 'Sulawesi Tengah', 'Sulawesi Selatan', 'Sulawesi Tenggara', 'Gorontalo', 'Sulawesi Barat', 'Maluku', 'Maluku Utara'],
            'Papua & Nusa Tenggara' => ['Nusa Tenggara Barat', 'Nusa Tenggara Timur', 'Papua', 'Papua Barat', 'Papua Selatan', 'Papua Tengah', 'Papua Pegunungan', 'Papua Barat Daya'],
        ];

        $provinsiList = collect($wilayahList)->flatten()->all();

        return view('order.index', [
            'categories' => $categories,
            'branchesJson' => $branches,
            'wilayahList' => $wilayahList,
            'provinsiList' => $provinsiList,
        ]);
    }

    public function show(Order $order)
    {
        if ($order->customer_id !== Auth::id()) {
            abort(403);
        }

        $order->load(['branch', 'product']);

        return view('order.show', compact('order'));
    }

    private function generateKodeOrder(Branch $branch): string
    {
        $tahun = now()->format('Y');
        $bulan = now()->format('m');

        $jumlahBulanIni = Order::where('branch_id', $branch->id)
            ->whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->count();

        $nomorUrut = str_pad($jumlahBulanIni + 1, 4, '0', STR_PAD_LEFT);

        return "ORD/{$branch->kode_cabang}/{$tahun}/{$bulan}/{$nomorUrut}";
    }
}