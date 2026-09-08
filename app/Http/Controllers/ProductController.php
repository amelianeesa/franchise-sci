<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Menampilkan daftar layanan/produk
    public function index()
    {
        $products = Product::with('category')->latest()->get();
        return view('admin.product_index', compact('products'));
    }

    // Menampilkan form tambah layanan
    public function create()
    {
        $categories = ServiceCategory::all();
        return view('admin.product_create', compact('categories'));
    }

    // Menyimpan data layanan baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'service_category_id' => 'required|exists:service_categories,id',
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga_dasar' => 'required|numeric|min:0',
            'satuan' => 'nullable|string|max:255',
        ]);

        Product::create([
            'service_category_id' => $request->service_category_id,
            'nama_produk' => $request->nama_produk,
            'deskripsi' => $request->deskripsi,
            'harga_dasar' => $request->harga_dasar,
            'satuan' => $request->satuan,
            'is_active' => 1,
        ]);

        return redirect()->route('admin.product_index')->with('success', 'Layanan berhasil ditambahkan.');
    }

    // Menampilkan form edit layanan
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = ServiceCategory::all();
        return view('admin.product_edit', compact('product', 'categories'));
    }

    // Memperbarui data layanan
    public function update(Request $request, $id)
    {
        $request->validate([
            'service_category_id' => 'required|exists:service_categories,id',
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga_dasar' => 'required|numeric|min:0',
            'satuan' => 'nullable|string|max:255',
        ]);

        $product = Product::findOrFail($id);
        $product->update([
            'service_category_id' => $request->service_category_id,
            'nama_produk' => $request->nama_produk,
            'deskripsi' => $request->deskripsi,
            'harga_dasar' => $request->harga_dasar,
            'satuan' => $request->satuan,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Layanan berhasil diperbarui.');
    }

    // Menghapus data layanan
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.product_index')->with('success', 'Layanan berhasil dihapus.');
    }
}