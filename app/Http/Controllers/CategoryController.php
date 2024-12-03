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
}
