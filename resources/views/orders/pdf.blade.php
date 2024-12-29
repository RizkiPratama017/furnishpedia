<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 40px auto;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 20px;
        }

        h1 {
            font-size: 2rem;
            color: #2d3748;
            margin-bottom: 20px;
        }

        .status,
        .total-price,
        .shipping-address {
            font-size: 1.125rem;
            margin-bottom: 15px;
        }

        .status span,
        .total-price span {
            text-transform: capitalize;
            font-weight: bold;
        }

        .status span {
            color: #3182ce;
        }

        .total-price span {
            color: #38a169;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border: 1px solid #e2e8f0;
        }

        th {
            background-color: #edf2f7;
            color: #4a5568;
        }

        td {
            color: #2d3748;
        }

        .product-name {
            font-weight: bold;
        }

        .price,
        .subtotal {
            color: #38a169;
        }

        .quantity {
            text-align: center;
        }

        .product-row:hover {
            background-color: #f7fafc;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Detail Pesanan #{{ $order->id }}</h1>

        <div class="status">
            <p><strong>Status:</strong> <span>{{ $order->shipping_status }}</span></p>
        </div>

        <div class="total-price">
            <p><strong>Total Harga:</strong> <span>Rp {{ number_format($order->total_price, 0, ',', '.') }}</span></p>
        </div>

        <div class="shipping-address">
            <p><strong>Alamat Pengiriman:</strong> {{ $order->shipping_address }}</p>
        </div>

        <h3>Daftar Produk</h3>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderDetails as $detail)
                        <tr class="product-row">
                            <td class="product-name">{{ $detail->product->name }}</td>
                            <td class="price">Rp {{ number_format($detail->price, 0, ',', '.') }}</td>
                            <td class="quantity">{{ $detail->quantity }}</td>
                            <td class="subtotal">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
