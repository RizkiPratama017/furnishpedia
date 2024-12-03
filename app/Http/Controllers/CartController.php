<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cartItems = Cart::with('product')
            ->where('user_id', auth()->user()->id)
            ->get();

        return view('cart.index', [
            'cartItems' => $cartItems,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();

        return view('cart.create', [
            'products' => $products,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);


        $product = Product::find($validated['product_id']);
        if ($product->stock < $validated['quantity']) {
            return back()->withErrors(['quantity' => 'Stok tidak mencukupi']);
        }

        Cart::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'product_id' => $validated['product_id'],
            ],
            [
                'quantity' => function ($cart) use ($validated) {
                    return $cart ? $cart->quantity + $validated['quantity'] : $validated['quantity'];
                },
            ]
        );


        return redirect()->route('cart.index')->with('success', 'Item berhasil ditambahkan ke keranjang.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        return view('cart.show', [
            'cart' => $cart,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        $products = Product::all();

        return view('cart.edit', [
            'cart' => $cart,
            'products' => $products,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);


        if ($cart->product->stock < $validated['quantity']) {
            return back()->withErrors(['quantity' => 'Stok tidak mencukupi']);
        }

        $cart->update([
            'quantity' => $validated['quantity'],
        ]);

        return redirect()->route('cart.index')->with('success', 'Keranjang berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        $cart->delete();

        return redirect()->route('cart.index')->with('success', 'Item berhasil dihapus dari keranjang.');
    }


    public function checkStock(Request $request)
    {
        $product = Product::find($request->product_id);

        if (!$product) {
            return response()->json(['error' => 'Produk tidak ditemukan'], 404);
        }

        return response()->json([
            'product_id' => $product->id,
            'stock' => $product->stock,
        ]);
    }
}
