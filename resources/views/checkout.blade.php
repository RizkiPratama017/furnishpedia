<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Checkout</title>

    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
</head>

<body class="h-full m-0 bg-gray-100">

    <div class="min-h-screen py-10">
        <div class="max-w-3xl mx-auto px-4">
            <div class="bg-white shadow-md rounded-lg p-8">
                <h1 class="text-3xl font-bold text-gray-800 mb-6">Checkout</h1>

                <div class="overflow-x-auto mb-8">
                    <table class="min-w-max w-full border-collapse border border-gray-300">
                        <thead class="bg-gray-800 text-white text-sm uppercase tracking-wide">
                            <tr>
                                <th class="border border-gray-300 px-4 py-2 text-left">Produk</th>
                                <th class="border border-gray-300 px-4 py-2 text-center">Kuantitas</th>
                                <th class="border border-gray-300 px-4 py-2 text-right">Harga</th>
                                <th class="border border-gray-300 px-4 py-2 text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cartItems as $item)
                                <tr class="bg-gray-50 hover:bg-gray-100 text-sm">
                                    <td class="border border-gray-300 px-4 py-3">
                                        <div class="flex items-center space-x-4">
                                            @php
                                                $product = \App\Models\Product::find($item['product_id']);
                                            @endphp
                                            <img src="{{ filter_var($item->product->image, FILTER_VALIDATE_URL) ? $item->product->image : asset('storage/' . $item->product->image) }}"
                                                alt="Produk" class="w-10 h-10 object-cover rounded-md">
                                            <span>{{ $product->name }}</span>
                                        </div>
                                    </td>
                                    <td class="border border-gray-300 px-4 py-3 text-center">{{ $item['quantity'] }}
                                    </td>
                                    <td class="border border-gray-300 px-4 py-3 text-right">
                                        Rp{{ number_format($product->price, 0, ',', '.') }}
                                    </td>
                                    <td class="border border-gray-300 px-4 py-3 text-right">
                                        Rp{{ number_format($totals['totalPriceOfGoods'], 0, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>


                <div class="space-y-2 text-right">
                    <div class="text-md font-medium">Biaya Antar:
                        <span
                            class="text-gray-700 font-semibold">Rp{{ number_format($totals['shippingCost'], 0, ',', '.') }}</span>
                    </div>
                    <div class="text-lg font-semibold">Total:
                        <span class="text-blue-500">Rp{{ number_format($totals['totalAmount'], 0, ',', '.') }}</span>
                    </div>
                </div>

                <form action="{{ route('checkout.store') }}" method="POST" class="mt-6 space-y-6">
                    @csrf
                    <div>
                        <label for="shipping_address" class="block text-gray-700 font-medium mb-2">Alamat
                            Pengiriman</label>
                        <textarea id="shipping_address" name="shipping_address" rows="3"
                            class="w-full p-3 border border-gray-300 rounded-md focus:ring focus:ring-blue-300"
                            placeholder="Masukkan alamat pengiriman" required>{{ old('shipping_address', auth()->user()->address ?? '') }}</textarea>
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

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>

</html>
