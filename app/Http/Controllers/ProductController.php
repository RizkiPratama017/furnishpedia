<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $products = Product::where('user_id', $user->id)->get();
        $categories = Category::all();
        return view('products.index', compact('products', 'categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $validatedData['user_id'] = Auth::id();
        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('img', 'public');
        }

        Product::create($validatedData);
        return redirect()->back()->with('success', 'Produk berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image && !filter_var($product->image, FILTER_VALIDATE_URL)) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();
        return redirect()->back()->with('success', 'Produk berhasil dihapus!');
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);


        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_url' => 'nullable|url',
        ]);

        // Update field produk
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->category_id = $request->category_id;

        //gambar
        if ($request->hasFile('image')) {

            if ($request->old_image && !filter_var($request->old_image, FILTER_VALIDATE_URL)) {
                Storage::disk('public')->delete($request->old_image);
            }

            $product->image = $request->file('image')->store('img', 'public');
        } elseif ($request->filled('image_url')) {

            if ($request->old_image && !filter_var($request->old_image, FILTER_VALIDATE_URL)) {
                Storage::disk('public')->delete($request->old_image);
            }

            $product->image = $request->image_url;
        }


        $product->save();

        return redirect('/dashboard/product')->with('success', 'Produk berhasil diperbarui!');
    }
}
