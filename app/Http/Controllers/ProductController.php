<?php

namespace App\Http\Controllers;

use Storage;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        dd(auth()->user());

        $user = auth()->user(); // Mendapatkan pengguna yang sedang login

        // Mengambil produk milik pengguna yang sedang login
        $products = Product::where('user_id', $user->id)->get();

        // Ambil semua kategori untuk dropdown
        $categories = Category::all();

        return view('products.index', compact('products', 'categories'));
    }


    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);



        // Simpan gambar produk
        // $imagePath = $request->file('image')->store('products', 'public');

        // Simpan data produk ke database
        Product::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'stock' => $validatedData['stock'],
            'category_id' => $validatedData['category_id'],
            // 'image' => $imagePath,
            'user_id' => auth()->id(), // Pastikan user yang login ditambahkan.
        ]);

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'produk berhasil ditambahkan!');
    }


    public function destroy($id)
    {
        // Temukan produk berdasarkan ID
        $product = Product::findOrFail($id);

        // Hapus gambar produk


        // Hapus produk dari database
        $product->delete();

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'produk berhasil dihapus!');
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Temukan produk berdasarkan ID
        $product = Product::findOrFail($id);

        // Perbarui data produk
        $product->update($validatedData);

        // Redirect dengan pesan sukses
        return redirect('/dashboard/product')->with('success', 'produk berhasil diperbarui!');
    }

    public function search(Request $request)
    {
        $query = $request->input('search'); // Ambil input pencarian
        $categories = \App\Models\Category::all();
        $products = Product::where('name', 'LIKE', "%{$query}%")
            ->paginate(5);

        return view('dashboard-product', [
            'title' => 'Dashboard Product',
            'products' => $products,
            'categories' => $categories,
            'searchQuery' => $query // Kirim query untuk digunakan di tampilan
        ]);
    }
}
