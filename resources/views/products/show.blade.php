<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <header>
        <x-navbar></x-navbar>
    </header>

    <div class="container mx-auto py-10 px-4">
        <div class="flex flex-col md:flex-row gap-8">

            <div class="md:w-1/2">
                <img src="{{ filter_var($product->image, FILTER_VALIDATE_URL) ? $product->image : asset('storage/' . $product->image) }}"
                    alt="{{ $product->name }}" class="w-full rounded-lg shadow-lg">
            </div>

            <div class="md:w-1/2">
                <h1 class="text-3xl font-bold mb-4">{{ $product->name }}</h1>
                <p class="text-2xl font-semibold text-green-600 mb-2">Rp
                    {{ number_format($product->price, 0, ',', '.') }}</p>
                <p class="text-sm text-gray-500 mb-4">Stok Tersisa: <span class="font-bold">{{ $product->stock }}</span>
                </p>
                <p class="text-sm mb-4">{{ $product->description }}</p>

                <!-- Rating dengan Bintang -->
                <div class="mb-4">
                    <span class="font-semibold">Rating: </span>
                    @if ($product->ratings->count() > 0)
                        <div class="flex items-center">
                            @php
                                $averageRating = $product->averageRating();
                            @endphp
                            @for ($i = 1; $i <= 5; $i++)
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 {{ $i <= $averageRating ? 'text-yellow-400' : 'text-gray-300' }}"
                                    viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path
                                        d="M10 15.27L16.18 19l-1.64-7.03L19 9.24l-7.19-.61L10 2 8.19 8.63 1 9.24l4.46 2.73L3.82 19z" />
                                </svg>
                            @endfor
                            <span class="ml-2">{{ number_format($averageRating, 1) }} / 5</span>
                        </div>
                    @else
                        <span>Belum Ada Rating</span>
                    @endif
                </div>

                @auth
                    <form action="{{ route('ratings.store') }}" method="POST" class="mb-4">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="flex items-center">
                            <label for="rating" class="mr-2">Berikan Rating:</label>
                            <select name="rating" id="rating" class="border rounded-md p-2">
                                <option value="1">1 Bintang</option>
                                <option value="2">2 Bintang</option>
                                <option value="3">3 Bintang</option>
                                <option value="4">4 Bintang</option>
                                <option value="5">5 Bintang</option>
                            </select>
                        </div>
                        <button type="submit" class="mt-2 bg-blue-500 text-white px-4 py-2 rounded-md">Submit
                            Rating</button>
                    </form>
                @else
                    <p class="text-sm text-gray-500"></p>
                @endauth
            </div>
        </div>

        <!-- Produk dari Toko Ini -->
        <div class="mt-10">
            <h2 class="text-2xl font-semibold mb-4">Produk yang Dijual di Toko Ini</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach ($storeProducts as $storeProduct)
                    <a href="{{ route('products.show', $storeProduct->id) }}" class="block">
                        <div class="bg-white shadow rounded-lg p-4">
                            <img src="{{ filter_var($storeProduct->image, FILTER_VALIDATE_URL) ? $storeProduct->image : asset('storage/' . $storeProduct->image) }}"
                                alt="{{ $storeProduct->name }}" class="w-full h-40 object-cover rounded">
                            <h3 class="mt-2 font-semibold">{{ $storeProduct->name }}</h3>
                            <p class="text-green-600 font-bold">Rp
                                {{ number_format($storeProduct->price, 0, ',', '.') }}</p>

                            <!-- Rating dengan Bintang -->
                            <div class="flex items-center mt-2">
                                @php
                                    $averageRating =
                                        $storeProduct->ratings->count() > 0 ? $storeProduct->averageRating() : 0;
                                @endphp
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 {{ $i <= $averageRating ? 'text-yellow-400' : 'text-gray-300' }}"
                                        viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path
                                            d="M10 15.27L16.18 19l-1.64-7.03L19 9.24l-7.19-.61L10 2 8.19 8.63 1 9.24l4.46 2.73L3.82 19z" />
                                    </svg>
                                @endfor
                                <span class="ml-2 text-sm text-gray-500">{{ number_format($averageRating, 1) }} /
                                    5</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>


        <!-- Rekomendasi Item Serupa -->
        <div class="mt-10">
            <h2 class="text-2xl font-semibold mb-4">Rekomendasi Item Serupa</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach ($relatedProducts as $relatedProduct)
                    <a href="{{ route('products.show', $relatedProduct->id) }}" class="block">
                        <div class="bg-white shadow rounded-lg p-4">
                            <img src="{{ filter_var($relatedProduct->image, FILTER_VALIDATE_URL) ? $relatedProduct->image : asset('storage/' . $relatedProduct->image) }}"
                                alt="{{ $relatedProduct->name }}" class="w-full h-40 object-cover rounded">
                            <h3 class="mt-2 font-semibold">{{ $relatedProduct->name }}</h3>
                            <p class="text-green-600 font-bold">Rp
                                {{ number_format($relatedProduct->price, 0, ',', '.') }}</p>

                            <!-- Rating dengan Bintang -->
                            <div class="flex items-center mt-2">
                                @php
                                    $averageRating =
                                        $relatedProduct->ratings->count() > 0 ? $relatedProduct->averageRating() : 0;
                                @endphp
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 {{ $i <= $averageRating ? 'text-yellow-400' : 'text-gray-300' }}"
                                        viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path
                                            d="M10 15.27L16.18 19l-1.64-7.03L19 9.24l-7.19-.61L10 2 8.19 8.63 1 9.24l4.46 2.73L3.82 19z" />
                                    </svg>
                                @endfor
                                <span class="ml-2 text-sm text-gray-500">{{ number_format($averageRating, 1) }} /
                                    5</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>


    </div>

    <x-footer></x-footer>
</x-layout>
