<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <header>
        <x-navbar></x-navbar>
    </header>

    <div class="text-center p-10 mt-10">
        <h1 class="font-bold text-4xl mb-4">Hasil pencarian untuk: "{{ $searchQuery }}"</h1>
        <h1 class="text-3xl">Produk</h1>
    </div>

    <section id="product-list"
        class="w-full max-w-screen-lg grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 px-4 py-4 mx-auto">
        @foreach ($products as $product)
            <div class="w-full md:w-72 bg-white shadow-md rounded-xl duration-500 hover:scale-105 hover:shadow-xl mb-10">
                <a href="{{ route('products.show', $product->id) }}">
                    <img src="{{ $product->image }}" alt="{{ $product->name }}"
                        class="h-80 w-full object-cover rounded-t-xl" />
                    <div class="px-4 py-3">
                        <span class="text-gray-400 mr-3 uppercase text-xs">{{ $product->category->name }}</span>
                        <p class="text-lg font-bold text-black truncate block capitalize">{{ $product->name }}</p>
                        <div class="flex items-center mt-3">
                            <p class="text-lg font-semibold text-black cursor-auto">
                                Rp.{{ number_format($product->price, 0, ',', '.') }}</p>
                            @if ($product->original_price)
                                <del>
                                    <p class="text-sm text-gray-600 ml-2">
                                        Rp.{{ number_format($product->original_price, 0, ',', '.') }}</p>
                                </del>
                            @endif
                            <div class="ml-auto">
                                @if ($product->stock > 0)
                                    <form action="{{ route('cart.store') }}" method="POST" class="flex items-center">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="number" name="quantity" value="1" min="1"
                                            class="quantity-input w-16 h-8 p-2 border border-gray-300 rounded-md text-center"
                                            required>
                                        <button type="submit"
                                            class="flex items-center justify-center w-8 h-8 bg-gray-200 text-white rounded-full transition-all duration-300 hover:bg-gray-300 active:ring-2 active:ring-yellow-400">
                                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6" />
                                            </svg>
                                        </button>
                                    </form>
                                @else
                                    <button type="button" disabled
                                        class="flex items-center justify-center w-8 h-8 bg-gray-300 text-white rounded-full transition-all duration-300 cursor-not-allowed">
                                        <svg class="w-6 h-6 text-gray-600" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6" />
                                        </svg>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </section>

    <script>
        const searchInput = document.getElementById('search');
        const productList = document.getElementById('product-list');

        searchInput.addEventListener('input', function() {
            const query = searchInput.value;

            if (query.length >= 2) {
                fetch(`{{ route('search.live') }}?q=${encodeURIComponent(query)}`)
                    .then(response => response.json())
                    .then(data => {
                        productList.innerHTML = '';

                        if (data.length > 0) {
                            data.forEach(product => {
                                const productHtml = `
                                    <div class="w-full md:w-72 bg-white shadow-md rounded-xl duration-500 hover:scale-105 hover:shadow-xl mb-10">
                                        <a href="/products/${product.id}">
                                            <img src="${product.image}" alt="${product.name}" class="h-80 w-full object-cover rounded-t-xl" />
                                            <div class="px-4 py-3">
                                                <span class="text-gray-400 mr-3 uppercase text-xs">${product.category.name}</span>
                                                <p class="text-lg font-bold text-black truncate block capitalize">${product.name}</p>
                                                <p class="text-lg font-semibold text-black">Rp.${new Intl.NumberFormat('id-ID').format(product.price)}</p>
                                            </div>
                                        </a>
                                    </div>
                                `;
                                productList.innerHTML += productHtml;
                            });
                        } else {
                            productList.innerHTML =
                                '<p class="w-full text-center text-gray-500">No products found.</p>';
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching search results:', error);
                    });
            } else if (query.length === 0) {
                productList.innerHTML = '';
            }
        });
    </script>

    <x-footer></x-footer>
</x-layout>
