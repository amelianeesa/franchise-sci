<?php

namespace App\Http\Controllers;

use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = ServiceCategory::latest()->get();
        return view('admin.category_index', compact('categories'));
    }

    public function create()
    {
        return view('admin.category_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:service_categories,nama',
            'deskripsi' => 'nullable|string',
        ]);

        ServiceCategory::create([
            'nama' => $request->nama,
            'slug' => Str::slug($request->nama),
            'deskripsi' => $request->deskripsi,
            'is_active' => 1,
        ]);

        return redirect()->route('admin.category_index')->with('success', 'Kategori layanan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $category = ServiceCategory::findOrFail($id);
        return view('admin.category_edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = ServiceCategory::findOrFail($id);
        
        $request->validate([
            'nama' => 'required|string|max:255|unique:service_categories,nama,' . $id,
            'deskripsi' => 'nullable|string',
        ]);

        $category->update([
            'nama' => $request->nama,
            'slug' => Str::slug($request->nama),
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('admin.category_index')->with('success', 'Kategori layanan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $category = ServiceCategory::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.category_index')->with('success', 'Kategori layanan berhasil dihapus.');
    }
}