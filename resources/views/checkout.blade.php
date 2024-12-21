<x-dashboard-layout>
    <x-slot:title>Checkout</x-slot:title>

    <div class="min-h-screen bg-gray-100 py-10">
        <div class="max-w-2xl mx-auto px-2">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h1 class="text-2xl font-bold text-gray-800 mb-6">Checkout</h1>

                {{-- Tabel Produk  --}}
                <table class="w-full border-collapse border border-gray-300 mb-6">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="border border-gray-300 px-4 py-2 text-left">Nama Produk</th>
                            <th class="border border-gray-300 px-4 py-2 text-center">Kuantitas</th>
                            <th class="border border-gray-300 px-4 py-2 text-right">Harga</th>
                            <th class="border border-gray-300 px-4 py-2 text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- ambil data carts --}}
                        @foreach ($cartItems as $item)
                            <tr class="bg-gray-50 hover:bg-gray-100">
                                <td class="border border-gray-300 px-4 py-2">
                                    <div class="flex items-center space-x-4">
                                        @php
                                            $product = \App\Models\Product::find($item['product_id']);
                                        @endphp
                                        <img src="{{ $item['image'] ?? asset('img/default-product.jpg') }}"
                                            alt="Gambar Produk" class="w-12 h-12 object-cover rounded-md">
                                        <span>{{ $product->name }}</span>
                                   
                                    
                                    </div>
                                </td>
                                <td class="border border-gray-300 px-4 py-2 text-center">{{ $item['quantity'] }}</td>
                                <td class="border border-gray-300 px-4 py-2 text-right">
                                    {{-- Rp{{ number_format($item['price'], 0, ',', '.') }} --}}
                                @php
                                    $product = \App\Models\Product::find($item['product_id']);
                                @endphp
                                Rp{{ number_format($product->price, 0, ',', '.') }}
                                </td>
                                <td class="border border-gray-300 px-4 py-2 text-right">
                                    Rp{{ number_format($product->price * $item['quantity'], 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Total --}}
                <div class="text-right text-lg font-semibold mb-6">
                    Total: Rp{{ number_format($cartItems->sum(fn($item) => \App\Models\Product::find($item['product_id'])->price * $item['quantity']), 0, ',', '.') }}
                </div>

                {{-- Form Pembayaran --}}
                <form action="{{ route('checkout.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="address" class="block text-gray-700 font-medium mb-2">Alamat Pengiriman</label>
                        <textarea id="address" name="address" rows="3"
                            class="w-full p-3 border border-gray-300 rounded-md focus:ring focus:ring-blue-300"
                            placeholder="Masukkan alamat pengiriman (jika alamat kosong)" required></textarea>
                    </div>

                    <div>
                        <label for="payment_method" class="block text-gray-700 font-medium mb-2">Metode
                            Pembayaran</label>
                        <select id="payment_method" name="payment_method"
                            class="w-full p-3 border border-gray-300 rounded-md focus:ring focus:ring-blue-300"
                            required>
                            <option value="credit_card">Kartu Kredit</option>
                            <option value="bank_transfer">Transfer Bank</option>
                            <option value="cash_on_delivery">Bayar di Tempat</option>
                        </select>
                    </div>

                    {{-- Tombol --}}
                    <div class="flex justify-end">
                        <a href="/cart"
                            class="px-4 py-2 mr-2 text-gray-600 border border-gray-300 rounded-md hover:bg-gray-200">
                            Kembali
                        </a>
                        <button type="submit"
                            class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition">
                            Bayar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-dashboard-layout>
