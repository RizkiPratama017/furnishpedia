<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // Filter berdasarkan kategori
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Filter berdasarkan harga minimum
        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }

        // Filter berdasarkan harga maksimum
        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        $products = $query->inRandomOrder()->paginate(9);

        return view('products.index', [
            'title' => 'Produk',
            'products' => $products,
            'categories' => Category::all(),
        ]);
    }

    public function search(Request $request)
    {
        $query = $request->input('search');
        $categories = \App\Models\Category::all();
        $user = auth()->user();

        //  produk yang akan ditampilkan
        if ($user->role === 'admin') {

            $products = Product::where(function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                    ->orWhere('description', 'LIKE', "%{$query}%");
            })->paginate(5);
        } else {
            // seller hanya melihat produk mereka sendiri
            $products = Product::where('user_id', $user->id)
                ->where(function ($q) use ($query) {
                    $q->where('name', 'LIKE', "%{$query}%")
                        ->orWhere('description', 'LIKE', "%{$query}%");
                })->paginate(5);
        }


        if ($request->ajax()) {
            return view('dashboard-product-table', compact('products'));
        }


        return view('dashboard-product', [
            'title' => 'Dashboard Produk',
            'products' => $products,
            'categories' => $categories,
            'searchQuery' => $query
        ]);
    }




    public function viewEdit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('product-edit', [
            'title' => 'Edit Produk',
            'product' => $product,
            'categories' => $categories
        ]);
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

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'weight' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Make sure user_id is correctly set (it was in the factory)
        $validatedData['user_id'] = Auth::id();

        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('img', 'public');
        }

        Product::create($validatedData);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'weight' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update product attributes
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->weight = $request->weight;
        $product->category_id = $request->category_id;

        // Handle image update
        if ($request->hasFile('image')) {
            if ($product->image && !filter_var($product->image, FILTER_VALIDATE_URL)) {
                Storage::disk('public')->delete($product->image);
            }
            $product->image = $request->file('image')->store('img', 'public');
        }

        $product->save();

        return redirect('/dashboard/product')->with('success', 'Produk berhasil diperbarui!');
    }


    public function dproduk()
    {
        if (Auth::user()->role === 'admin') {

            $products = Product::paginate(5);
        } else {

            $products = Product::where('user_id', Auth::user()->id)->paginate(5);
        }

        $categories = Category::all();

        return view('dashboard-product', [
            'title' => 'Dashboard Produk',
            'products' => $products,
            'categories' => $categories
        ]);
    }


    public function show($id)
    {
        $product = Product::with('category', 'ratings.user')->findOrFail($id);


        $storeProducts = Product::where('user_id', $product->user_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();


        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('products.show', [
            'product' => $product,
            'title' => $product->name,
            'storeProducts' => $storeProducts,
            'relatedProducts' => $relatedProducts,
        ]);
    }

    public function getCarouselItems()
    {

        $products = \App\Models\Product::with('category')
            ->get()
            ->unique('category_id')
            ->take(5);

        return view('your-view-name', compact('products'));
    }
}
