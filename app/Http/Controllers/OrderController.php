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
        // Ambil service_categories beserta produknya
        $categories = ServiceCategory::with('products')->get();

        $branches = Branch::all();
        $provinsiList = $branches->pluck('provinsi')->unique()->filter()->values();

        return view('order.create', [
            'categories' => $categories,
            'branchesJson' => $branches,
            'provinsiList' => $provinsiList,
        ]);
    }

    private function categoryIcon(string $slug): string
    {
        return match ($slug) {
            'pengujian-analisis' => '🧪',
            'inspeksi-audit' => '🔍',
            'sertifikasi' => '📜',
            'konsultasi' => '💼',
            'pelatihan' => '🎓',
            default => '📋',
        };
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
        $orders = Order::with(['branch', 'product'])
            ->where('customer_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('order.index', compact('orders'));
    }

    public function show(Order $order)
    {
        if ($order->customer_id !== Auth::id()) {
            abort(403);
        }

        $order->load(['branch', 'product']);

        return view('order.show', compact('order'));
    }

    /**
     * Format: ORD/{kode_cabang}/{tahun}/{bulan}/{nomor_urut}
     */
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