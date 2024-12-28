<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();


        return view('home', compact('cartItems'));
    }

    public function indexCart()
    {
        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        $title = "Cart";



        return view('cart.index', compact('cartItems', 'title'));
    }


    public function store(Request $request)
    {

        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            
        ]);


        $product = Product::findOrFail($validated['product_id']);


        if ($product->stock < $validated['quantity']) {
            return back()->withErrors(['quantity' => 'Stok tidak mencukupi']);
        }

        // Cek item dikeranjang sudah ada
        $cart = Cart::firstOrNew(
            ['user_id' => Auth::id(), 'product_id' => $validated['product_id']],
            ['quantity' => 0, 'price' => $product->price] 
        );


        $cart->quantity += $validated['quantity'];
        $cart->price = $product->price;

        $cart->save();


        return redirect()->back();
    }


    public function update(Request $request, Cart $cart)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart->update($validated);

        return redirect()->route('cart.index')->with('success', 'Keranjang berhasil diperbarui.');
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();

        return redirect()->route('cart.index')->with('success', 'Produk berhasil dihapus dari keranjang.');
    }

        public function preview(Request $request)
    {
        // Ambil produk yang dipilih
        $selectedItems = $request->input('selected_items', []);

        // Ambil detail produk dari database
        $cartItems = Cart::whereIn('id', $selectedItems)->with('product')->get();

        $totals = [
            'totalPriceOfGoods' => $cartItems->sum(fn($item) => $item->product->price * $item->quantity),
            'shippingCost' => 15000, // Contoh biaya kirim
            'totalAmount' => $cartItems->sum(fn($item) => $item->product->price * $item->quantity) + 15000,
        ];

        return view('checkout', compact('cartItems', 'totals'));
    }
    
}
