<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(5); // Ambil kategori sesuai jumlah paginasi

        return view('dashboard-category', [
            'title' => 'Dashboard Kategori',
            'categories' => $categories
        ]);
    }

    public function viewEdit($id)
    {
        $categories = Category::findOrFail($id);

        return view('category-edit', [
            'title' => 'Dashboard Edit',
            'category' => $categories, // Hanya satu kategori berdasarkan ID
        ]);
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    public function detail()
    {
        $categories = Category::all(); // Ambil semua kategori
        return view('categories.index', ['title' => 'kategori', 'categories' => $categories], compact('categories'));
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

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug,' . $id,
        ]);

        // Temukan kategori berdasarkan ID
        $category = Category::findOrFail($id);

        // Update kategori
        $category->update([
            'name' => $request->name,
            'slug' => $request->slug,
        ]);

        // Redirect ke halaman sebelumnya dengan pesan sukses
        return redirect('/dashboard/category')->with('success', 'kategori berhasil diperbarui!');
    }



    public function show($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = $category->products;
        return view('categories.show', [
            'title' => 'Kategori',
            'category' => $category,
            'products' => $products,

        ]);
    }
}
