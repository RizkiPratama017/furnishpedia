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
        $order->buyer_id = Auth::id(); // Menggunakan pengguna yang sedang login (sebagai pembeli)
        $order->shipping_address = $validatedData['address'];
        $order->payment_method = $validatedData['payment_method'];
        $order->status = 'Pending'; // Status awal pesanan

        // Hitung total harga pesanan termasuk ongkos kirim
        $order->total_price = collect(session('cartItems'))->sum(
            fn($item) =>
            Product::find($item['product_id'])->price * $item['quantity']
        );

        // Tentukan ongkos kirim
        $shippingCost = $this->calculateShippingCost(); // Fungsi untuk menghitung ongkos kirim
        $order->shipping_cost = $shippingCost;
        $order->total_price += $shippingCost; // Tambahkan ongkos kirim ke total harga

        // Simpan pesanan
        $order->save();

        // Tambahkan detail pesanan
        foreach (session('cartItems') as $item) {
            $order->orderDetails()->create([
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => Product::find($item['product_id'])->price,
                'subtotal' => Product::find($item['product_id'])->price * $item['quantity'],
                'seller_id' => Product::find($item['product_id'])->user->id,  // Menggunakan seller_id dari produk
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
        $user = Auth::user(); // Ambil pengguna yang sedang login (penjual)

        // Pastikan hanya seller yang dapat mengakses
        if ($user->role !== 'seller') {
            abort(403, 'Akses ditolak');
        }

        // Ambil pesanan terkait produk yang dijual oleh seller yang sedang login
        $orders = Order::whereHas('orderDetails', function ($query) use ($user) {
            $query->whereHas('product', function ($query) use ($user) {
                $query->where('user_id', $user->id); // Filter berdasarkan user_id (seller_id)
            });
        })
            ->with([
                'buyer', // Ambil data pembeli
                'orderDetails' => function ($query) use ($user) {
                    $query->whereHas('product', function ($query) use ($user) {
                        $query->where('user_id', $user->id); // Pastikan hanya detail produk dari seller yang benar
                    })
                        ->with('product'); // Ambil data produk terkait
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

    // Fungsi untuk menghitung ongkos kirim (contoh)
    private function calculateShippingCost(): float
    {
        $ratePerKm = 5000; // Tarif per kilometer dalam IDR
        $shippingCost = 20000; // Ongkos kirim dasar, bisa disesuaikan berdasarkan jarak atau aturan lainnya

        return max($shippingCost, 10000); // Pastikan ongkos kirim tidak kurang dari 10000
    }

}
