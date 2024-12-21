<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use GuzzleHttp\Client;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Ambil seller secara acak
        $seller = User::where('role', 'seller')->inRandomOrder()->first();
        // Ambil buyer secara acak
        $buyer = User::where('role', 'buyer')->inRandomOrder()->first();

        // Ambil alamat seller dan buyer untuk mendapatkan koordinat
        $sellerAddress = $seller->address;
        $buyerAddress = $buyer->address;

        // Dapatkan koordinat dari alamat seller dan buyer menggunakan Geocoding API
        $sellerCoordinates = $this->getCoordinatesFromAddress($sellerAddress);
        $buyerCoordinates = $this->getCoordinatesFromAddress($buyerAddress);

        // Pastikan koordinat valid sebelum menghitung jarak
        if ($sellerCoordinates['lat'] == 0 || $sellerCoordinates['lon'] == 0 || $buyerCoordinates['lat'] == 0 || $buyerCoordinates['lon'] == 0) {
            // Jika koordinat invalid, gunakan biaya pengiriman default atau tindakan lain
            $shippingCost = $this->calculateShippingCost(0);  // Gunakan jarak 0 jika koordinat tidak valid
        } else {
            // Hitung jarak antara seller dan buyer menggunakan OSRM API
            $distance = $this->getDistanceFromOSRM($sellerCoordinates, $buyerCoordinates);
            // Tentukan ongkos kirim berdasarkan jarak
            $shippingCost = $this->calculateShippingCost($distance);
        }

        // Tentukan status pembayaran dan kirimkan status pengiriman yang sesuai
        $paymentStatus = $this->faker->randomElement(['pending', 'completed', 'failed']);
        $shippingStatus = ($paymentStatus === 'completed')
            ? $this->faker->randomElement(['dipacking', 'dikirim', 'diterima'])
            : 'batal';

        return [
            'user_id' => $seller->id, // Mengaitkan pesanan dengan seller tertentu
            'status' => $this->faker->randomElement(['pending', 'paid', 'shipped']),
            'total_price' => 0, // Akan dihitung ulang setelah pesanan dibuat
            'shipping_cost' => $shippingCost,
            'shipping_address' => $buyer->address,
            'seller_address' => $seller->address,
            'payment_method' => $this->faker->randomElement(['bank_transfer', 'credit_card', 'cod']),
            'payment_status' => $paymentStatus,
            'shipping_status' => $shippingStatus,
            'created_at' => $this->faker->dateTimeBetween('-12 month', 'now'),
            'updated_at' => now(),
        ];
    }

    /**
     * Fungsi untuk mendapatkan koordinat dari alamat menggunakan Geocoding API.
     *
     * @param string $address
     * @return array
     */
    private function getCoordinatesFromAddress(string $address): array
    {
        $client = new Client();
        try {
            $response = $client->get("https://nominatim.openstreetmap.org/search", [
                'query' => [
                    'q' => $address,
                    'format' => 'json',
                    'addressdetails' => 1
                ],
                'headers' => [
                    'User-Agent' => 'MyApp/1.0 (contact@myapp.com)'
                ]
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            if (isset($data[0])) {
                return [
                    'lat' => (float) $data[0]['lat'],
                    'lon' => (float) $data[0]['lon']
                ];
            }
        } catch (\Exception $e) {
            return ['lat' => 0, 'lon' => 0];
        }

        return ['lat' => 0, 'lon' => 0];
    }

    /**
     * Fungsi untuk menghitung jarak antara seller dan buyer menggunakan OSRM API.
     *
     * @param array $sellerCoordinates
     * @param array $buyerCoordinates
     * @return float
     */
    private function getDistanceFromOSRM(array $sellerCoordinates, array $buyerCoordinates): float
    {
        $client = new Client();
        try {
            $response = $client->get('http://router.project-osrm.org/table/v1/driving/' .
                "{$sellerCoordinates['lon']},{$sellerCoordinates['lat']};{$buyerCoordinates['lon']},{$buyerCoordinates['lat']}", [
                'query' => [
                    'sources' => '0',
                    'destinations' => '1',
                    'annotations' => 'distance'
                ]
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            return $data['durations'][0][1] / 1000; // Jarak dalam kilometer
        } catch (\Exception $e) {
            return 0;
        }
    }

    /**
     * Fungsi untuk menghitung ongkos kirim berdasarkan jarak.
     *
     * @param float $distance
     * @return float
     */
    private function calculateShippingCost(float $distance): float
    {
        $ratePerKm = 5000; // Tarif per kilometer dalam IDR
        $shippingCost = $distance * $ratePerKm;

        return max($shippingCost, 10000);
    }

    public function configure()
    {
        return $this->afterCreating(function ($order) {
            $sellerProducts = Product::where('user_id', $order->user_id)->inRandomOrder()->take(rand(1, 5))->get();

            foreach ($sellerProducts as $product) {
                \App\Models\OrderDetail::factory()
                    ->create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'price' => $product->price,
                        'quantity' => rand(1, 10),
                        'subtotal' => function (array $attributes) {
                            return $attributes['quantity'] * $attributes['price'];
                        },
                    ]);
            }

            $orderDetails = \App\Models\OrderDetail::where('order_id', $order->id)->get();
            $totalPrice = $orderDetails->sum('subtotal') + $order->shipping_cost;

            $order->update(['total_price' => $totalPrice]);
        });
    }
}
