<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        // $validatedData = $request->validate([
        //     'address' => 'required|string|max:255',
        //     'payment_method' => 'required|string',
            
        // ]);

        // // Buat pesanan baru
        // $order = new Order();
        // $order->user_id = Auth::id(); // Menggunakan pengguna yang sedang login
        // $order->address = $validatedData['address'];
        // $order->payment_method = $validatedData['payment_method'];
        // $order->status = 'Pending'; // Status awal pesanan
        
        // $order->total_price = collect(session('cartItems'))->sum(fn($item) =>
        //     Product::find($item['product_id'])->price * $item['quantity']
        // );
        // $order->save();

        // // Tambahkan detail pesanan
        // foreach (session('cartItems') as $item) {
        //     $order->details()->create([
        //         'product_id' => $item['product_id'],
        //         'quantity' => $item['quantity'],
        //         'price' => Product::find($item['product_id'])->price,
        //     ]);
        // }

        // // Kosongkan session keranjang
        // session()->forget('cartItems');

        // // Redirect ke halaman checkout status
        // return redirect()->route('checkout-status', ['order' => $order->id]);
        // dd($request->all());

    }
    
    public function sellerOrders(Request $request)
    {
        $user = Auth::user(); // Penjual yang sedang login

        if ($user->role !== 'seller') {
            abort(403, 'Akses ditolak');
        }

        // Ambil pesanan terkait produk penjual
        $orders = Order::whereHas('orderDetails.product', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with('orderDetails.product')->get();

        return view('dashboard-order', compact('orders'));
    }

    public function updateShippingStatus(Request $request, Order $order)
    {
        // Validasi input
        $request->validate([
            'shipping_status' => 'required|in:dipacking,dikirim,diterima,batal,gagal',
        ]);

        // Update status pengiriman
        $order->shipping_status = $request->input('shipping_status');
        $order->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Status pengiriman berhasil diperbarui.');
    }

    public function index()
    {
        // Ambil semua pesanan pengguna yang sedang login
        $orders = Order::where('user_id', Auth::id())->with('orderDetails.product')->get();

        return view('orders.index', compact('orders'));
    }

    public function show($id)
{
    $order = Order::with('orderDetails.product')->findOrFail($id);
    return view('orders.show', compact('order'));
}
}
