<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Method untuk membuat pesanan baru
    public function store(Request $request)
    {
        // Validasi data yang diterima
        $validatedData = $request->validate([
            'address' => 'required|string|max:255',
            'payment_method' => 'required|string',
        ]);

        // Buat pesanan baru
        $order = new Order();
        $order->buyer_id = Auth::id();
        $order->shipping_address = $validatedData['address'];
        $order->payment_method = $validatedData['payment_method'];
        $order->status = 'Pending';

        // Hitung total harga pesanan termasuk ongkos kirim
        $order->total_price = collect(session('cartItems'))->sum(
            fn($item) =>
            Product::find($item['product_id'])->price * $item['quantity']
        );

        // Tentukan ongkos kirim
        $shippingCost = $this->calculateShippingCost();
        $order->shipping_cost = $shippingCost;
        $order->total_price += $shippingCost;

        // Simpan pesanan
        $order->save();

        // Tambahkan detail pesanan
        foreach (session('cartItems') as $item) {
            $order->orderDetails()->create([
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => Product::find($item['product_id'])->price,
                'subtotal' => Product::find($item['product_id'])->price * $item['quantity'],
                'seller_id' => Product::find($item['product_id'])->user->id,
            ]);
        }

        // Kosongkan session keranjang setelah pesanan disimpan
        session()->forget('cartItems');

        // Redirect ke halaman checkout status
        return redirect()->route('checkout-status', ['order' => $order->id]);
    }

    // Method untuk mengambil pesanan seller yang sedang login
    public function sellerOrders(Request $request)
    {
        $user = Auth::user();

        // Pastikan hanya seller yang dapat mengakses
        if ($user->role !== 'seller') {
            abort(403, 'Akses ditolak');
        }

        // Ambil pesanan terkait produk yang dijual oleh seller yang sedang login
        $orders = Order::whereHas('orderDetails', function ($query) use ($user) {
            $query->whereHas('product', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            });
        })
            ->with([
                'buyer',
                'orderDetails' => function ($query) use ($user) {
                    $query->whereHas('product', function ($query) use ($user) {
                        $query->where('user_id', $user->id);
                    })
                        ->with('product');
                },
            ])
            ->get();

        // Ambil produk yang dijual oleh seller yang sedang login
        $products = Product::where('user_id', $user->id)->get();

        return view('dashboard-order', compact('orders', 'products'));
    }

    // Method untuk memperbarui status pengiriman
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


    public function index(Request $request)
    {
        $user = Auth::user();

        // Ambil pesanan yang dimiliki oleh pembeli yang sedang login
        $orders = Order::where('buyer_id', $user->id)
            ->with('orderDetails.product')
            ->get();

        return view('orders.index', compact('orders'), ['title' => 'Pesanan']);
    }


    public function show($id)
    {

        $userId = auth()->id();

        // cari pesanan berdasarkan ID dan memastikan itu milik pembeli yang sedang login
        $order = Order::with('orderDetails.product')
            ->where('id', $id)
            ->where('buyer_id', $userId)
            ->firstOrFail();

        return view('orders.show', compact('order'), ['title' => 'Detail Pesanan']);
    }

    public function updateStatus(Request $request, $id)
    {
        //  pesanan berdasarkan ID
        $order = Order::findOrFail($id);

        //  pesanan hanya bisa diubah jika statusnya "Dikirim"
        if ($order->shipping_status === 'dikirim') {
            $order->shipping_status = 'diterima';
            $order->save();
        }

        return redirect()->route('orders.show', $order->id)->with('success', 'Status pesanan berhasil diubah.');
    }

    // Fungsi untuk menghitung ongkos kirim (contoh)
    private function calculateShippingCost(): float
    {
        $ratePerKm = 5000; // Tarif per kilometer dalam IDR
        $shippingCost = 20000; // Ongkos kirim dasar

        return max($shippingCost, 10000); // ongkos kirim tidak kurang dari 10000
    }
}
