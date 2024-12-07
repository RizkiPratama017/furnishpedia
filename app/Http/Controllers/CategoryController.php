<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $caregories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug',
        ]);

        // Simpan data ke database
        Category::create([
            'name' => $request->name,
            'slug' => $request->slug,
        ]);

        // Redirect ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        // Temukan category berdasarkan ID
        $category = category::findOrFail($id);

        // Hapus category
        $category->delete();

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Kategori berhasil dihapus!');
    }

    public function search(Request $request)
    {
        $query = $request->input('search'); // Ambil input pencarian
        $categories = Category::where('name', 'LIKE', "%{$query}%")
            ->orWhere('slug', 'LIKE', "%{$query}%")
            ->paginate(5);

        return view('dashboard-category', [
            'title' => 'Dashboard Kategori',
            'categories' => $categories,
            'searchQuery' => $query // Kirim query untuk digunakan di tampilan
        ]);
    }
}
