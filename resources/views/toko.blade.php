<x-layout>
    <div class="container mx-auto mt-5">
        <h1 class="text-2xl font-bold mb-4">Toko Kami</h1>

        <!-- Live Search Input -->
        <input type="text" id="search" placeholder="Cari produk..." class="border p-2 rounded w-full mb-4" />

        <!-- Daftar Produk -->
        <div id="product-list" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($products as $product)
                <div class="border p-4 rounded shadow">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover mb-2">
                    <h2 class="font-semibold">{{ $product->name }}</h2>
                    <p class="text-gray-600">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        document.getElementById('search').addEventListener('input', function() {
            const query = this.value.toLowerCase();
            const products = document.querySelectorAll('#product-list > div');

            products.forEach(product => {
                const productName = product.querySelector('h2').textContent.toLowerCase();
                if (productName.includes(query)) {
                    product.style.display = 'block';
                } else {
                    product.style.display = 'none';
                }
            });
        });
    </script>
</x-layout>