<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <header>
        <x-navbar></x-navbar>
    </header>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">Detail Pesanan #{{ $order->id }}</h1>

        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <p class="text-gray-700 mb-2">Status:
                @if ($order->shipping_status === 'dikirim')
                    <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <select name="shipping_status" id="shipping_status"
                            class="inline-block border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-300 text-gray-700">
                            <option value="dikirim" selected>Dikirim</option>
                            <option value="diterima">Diterima</option>
                        </select>
                        <button type="submit"
                            class="ml-2 inline-block bg-green-600 text-white text-center py-1 px-3 rounded-lg hover:bg-gray-700 transition">
                            Perbarui
                        </button>
                    </form>
                @else
                    <span class="font-medium">{{ ucfirst($order->shipping_status) }}</span>
                @endif
            </p>
            <p class="text-gray-700 mb-2">Total Harga: <span class="font-medium">Rp
                    {{ number_format($order->total_price, 0, ',', '.') }}</span></p>
            <p class="text-gray-700">Alamat Pengiriman: {{ $order->shipping_address }}</p>
        </div>

        <h3 class="text-xl font-semibold mb-4">Daftar Produk</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
                <thead class="bg-gray-100 border-b border-gray-200">
                    <tr>
                        <th class="px-4 py-2 text-left text-gray-600 font-medium">Nama Produk</th>
                        <th class="px-4 py-2 text-left text-gray-600 font-medium">Harga</th>
                        <th class="px-4 py-2 text-left text-gray-600 font-medium">Jumlah</th>
                        <th class="px-4 py-2 text-left text-gray-600 font-medium">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderDetails as $detail)
                        <tr class="border-b border-gray-200">
                            <td class="px-4 py-2 text-gray-700">{{ $detail->product->name }}</td>
                            <td class="px-4 py-2 text-gray-700">Rp {{ number_format($detail->price, 0, ',', '.') }}</td>
                            <td class="px-4 py-2 text-gray-700">{{ $detail->quantity }}</td>
                            <td class="px-4 py-2 text-gray-700">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            <a href="/orders"
                class="inline-block bg-blue-600 text-white text-center py-2 px-4 rounded-lg hover:bg-gray-700 transition">
                Kembali
            </a>
        </div>
    </div>
</x-layout>
