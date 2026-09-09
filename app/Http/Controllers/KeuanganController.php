<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\VirtualAccount;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeuanganController extends Controller
{
    public function index()
    {
        $branchId = Auth::user()->branch_id ?? 1; 

        $virtualAccounts = VirtualAccount::where('branch_id', $branchId)->latest()->get();
        $invoices = Invoice::where('branch_id', $branchId)->latest()->get();

        return view('admin.keuangan_index', compact('virtualAccounts', 'invoices'));
    }

    // Menyimpan Virtual Account baru
    public function storeVA(Request $request)
    {
        $request->validate([
            'bank_name' => 'required|string|max:255',
            'va_number' => 'required|string|max:30|unique:virtual_accounts,va_number',
            'atas_nama' => 'required|string|max:255',
        ]);

        VirtualAccount::create([
            'branch_id' => Auth::user()->branch_id ?? 1,
            'bank_name' => $request->bank_name,
            'va_number' => $request->va_number,
            'atas_nama' => $request->atas_nama,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->back()->with('success', 'Nomor Virtual Account berhasil ditambahkan.');
    }

    // Mengubah Virtual Account
    public function updateVA(Request $request, $id)
    {
        $va = VirtualAccount::findOrFail($id);

        $request->validate([
            'bank_name' => 'required|string|max:255',
            'va_number' => 'required|string|max:30|unique:virtual_accounts,va_number,' . $va->id,
            'atas_nama' => 'required|string|max:255',
        ]);

        $va->update([
            'bank_name' => $request->bank_name,
            'va_number' => $request->va_number,
            'atas_nama' => $request->atas_nama,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->back()->with('success', 'Virtual Account berhasil diperbarui.');
    }

    // Menghapus Virtual Account
    public function destroyVA($id)
    {
        $va = VirtualAccount::findOrFail($id);
        $va->delete();

        return redirect()->back()->with('success', 'Virtual Account berhasil dihapus.');
    }
}