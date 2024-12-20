<x-dashboard-layout>
    <x-slot:title>Rincian Pesanan</x-slot:title>

    <div class="flex min-h-screen">
        {{-- Sidebar --}}
        <x-sidebar></x-sidebar>

        {{-- Main --}}
        <main class="flex-1 bg-white overflow-y-auto m-5 shadow-md rounded">
            <div class="container mx-auto px-4 py-6">
                {{-- Header --}}
                <div class="flex flex-wrap justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold text-gray-800">Rincian Pesanan #{{ $order->id }}</h1>
                </div>

                {{-- Order Details --}}
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-700">Informasi Pembayaran</h3>
                    <div class="mt-2">
                        <p><strong>Status Pembayaran:</strong> {{ $order->payment_status }}</p>
                        <p><strong>Kurir:</strong> {{ $order->courier }}</p>
                        <p><strong>Alamat Pengiriman:</strong> {{ $order->shipping_address }}</p>
                        <p><strong>Status Pengiriman:</strong> {{ $order->shipment_status }}</p>
                    </div>
                </div>

                {{-- Order Items --}}
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-700">Daftar Produk</h3>
                    <table class="min-w-full bg-white border border-gray-300 rounded-lg mt-2">
                        <thead class="bg-gray-800 text-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left border">Nama Produk</th>
                                <th class="px-4 py-2 text-left border">Harga</th>
                                <th class="px-4 py-2 text-left border">Jumlah</th>
                                <th class="px-4 py-2 text-left border">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderItems as $item)
                                <tr class="hover:bg-gray-100 text-gray-700">
                                    <td class="px-4 py-2 border">{{ $item->product->name }}</td>
                                    <td class="px-4 py-2 border">Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                                    <td class="px-4 py-2 border">{{ $item->quantity }}</td>
                                    <td class="px-4 py-2 border">Rp{{ number_format($item->subtotal, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Total Pembayaran --}}
                <div class="mb-6">
                    <p class="text-lg font-semibold text-gray-700 flex justify-end">Total Pembayaran:
                        Rp{{ number_format($total, 0, ',', '.') }}</p>
                </div>

                {{-- Action Buttons --}}
                <div class="flex justify-end space-x-4">
                    <a href="#" class="px-5 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600">Ajukan
                        Pengembalian</a>
                    <a href="#" class="px-5 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">Pesanan
                        Selesai</a>
                </div>
            </div>
        </main>
    </div>
</x-dashboard-layout>
