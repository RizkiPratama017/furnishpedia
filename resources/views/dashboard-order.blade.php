<x-dashboard-layout>
    <x-slot:title>Pesanan Penjual</x-slot:title>

    <div class="flex min-h-screen">
        {{-- Sidebar --}}
        <x-sidebar></x-sidebar>

        {{-- Main --}}
        <main class="flex-1 bg-white overflow-y-auto m-5 shadow-md rounded">
            <div class="container mx-auto px-4 py-6">
                <h1 class="text-2xl font-bold text-gray-800 mb-6">Daftar Pesanan Penjual</h1>

                @foreach ($orders as $order)
                    {{-- Rincian Pesanan --}}
                    <div class="mb-6 border border-gray-300 p-4 rounded">
                        <h3 class="text-lg font-semibold text-gray-700">Pesanan #{{ $loop->iteration }}</h3>
                        <p><strong>Status Pembayaran:</strong> {{ $order->payment_status }}</p>
                        <p><strong>Alamat Pengiriman:</strong> {{ $order->shipping_address }}</p>
                        <p><strong>Status Pengiriman:</strong> {{ $order->shipping_status }}</p>

                        {{-- Form untuk mengedit status pengiriman --}}
                        @if ($order->shipping_status != 'diterima')
                            <!-- Hanya tampilkan form jika status bukan 'diterima' -->
                            <form action="{{ route('orders.updateShippingStatus', $order->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <label for="shipping_status" class="mt-4 block text-gray-700">Update Status
                                    Pengiriman</label>
                                <select id="shipping_status" name="shipping_status"
                                    class="block w-full mt-2 p-2 border border-gray-300 rounded">
                                    <option value="dipacking"
                                        {{ $order->shipping_status == 'dipacking' ? 'selected' : '' }}>Dipacking
                                    </option>
                                    <option value="dikirim"
                                        {{ $order->shipping_status == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                                    <option value="batal" {{ $order->shipping_status == 'batal' ? 'selected' : '' }}>
                                        Batal</option>
                                </select>
                                <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">Perbarui
                                    Status Pengiriman</button>
                            </form>
                        @else
                            <p class="mt-2 text-green-600"></p>
                        @endif

                        <p class="mt-2"><strong>Total Pembayaran:</strong>
                            Rp{{ number_format($order->total_price, 0, ',', '.') }}</p>

                        {{-- Produk dalam Pesanan --}}
                        <table class="min-w-full bg-white border border-gray-300 rounded-lg mt-4">
                            <thead class="bg-gray-800 text-gray-100">
                                <tr>
                                    <th class="px-4 py-2 text-left border">Nama Produk</th>
                                    <th class="px-4 py-2 text-left border">Harga</th>
                                    <th class="px-4 py-2 text-left border">Jumlah</th>
                                    <th class="px-4 py-2 text-left border">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->orderDetails as $item)
                                    <tr class="hover:bg-gray-100 text-gray-700">
                                        {{-- Ambil nama produk dari relasi --}}
                                        <td class="px-4 py-2 border">{{ $item->product->name }}</td>
                                        {{-- Ambil harga produk dari relasi dan pastikan sesuai format --}}
                                        <td class="px-4 py-2 border">Rp{{ number_format($item->price, 0, ',', '.') }}
                                        </td>
                                        {{-- Ambil jumlah produk --}}
                                        <td class="px-4 py-2 border">{{ $item->quantity }}</td>
                                        {{-- Hitung subtotal dari database --}}
                                        <td class="px-4 py-2 border">
                                            Rp{{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endforeach
            </div>
        </main>
    </div>
</x-dashboard-layout>
