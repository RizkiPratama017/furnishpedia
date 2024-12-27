<x-layout>
    @section('content')
<div class="container">
    <h1>Detail Pesanan #{{ $order->id }}</h1>

    <p>Status: <strong>{{ ucfirst($order->status) }}</strong></p>
    <p>Total Harga: <strong>Rp {{ number_format($order->total_price, 0, ',', '.') }}</strong></p>
    <p>Alamat Pengiriman: {{ $order->shipping_address }}</p>

    <h3>Daftar Produk</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->orderDetails as $detail)
                <tr>
                    <td>{{ $detail->product->name }}</td>
                    <td>Rp {{ number_format($detail->price, 0, ',', '.') }}</td>
                    <td>{{ $detail->quantity }}</td>
                    <td>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
</x-layout>