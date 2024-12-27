<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <header>
        <x-navbar></x-navbar>
    </header>

    <div class="container mx-auto py-10 px-4">
        <div class="flex flex-col md:flex-row gap-8">
            <!-- Gambar Produk -->
            <div class="md:w-1/2">
                <img src="{{ filter_var($product->image, FILTER_VALIDATE_URL) ? $product->image : asset('storage/' . $product->image) }}"
                    alt="{{ $product->name }}" class="w-full rounded-lg shadow-lg object-cover">
            </div>

            <!-- Detail Produk -->
            <div class="md:w-1/2">
                <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $product->name }}</h1>

                <!-- Link ke Toko -->
                <a href="{{ route('toko.index', $product->user->id) }}" class="block mb-4">
                    <div
                        class="flex items-center p-4 bg-white rounded-lg transition-transform transform hover:scale-105">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-800">{{ $product->user->name }}</h2>
                            <p class="text-sm text-gray-500">Lihat produk lainnya</p>
                        </div>
                    </div>
                </a>

                <!-- Harga dan Stok -->
                <div class="flex items-center justify-between mb-4">
                    <p class="text-2xl font-semibold text-green-600">Rp
                        {{ number_format($product->price, 0, ',', '.') }}</p>
                    @if ($product->stock > 0)
                        <form action="{{ route('cart.store') }}" method="POST" class="flex items-center">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="number" name="quantity" value="1" min="1"
                                class="quantity-input w-16 h-8 p-2 border border-gray-300 rounded-md text-center mr-2"
                                required>
                            <button type="submit"
                                class="m-1 p-1 flex items-center justify-center  bg-blue-500 rounded-md text-white transition-all duration-300 hover:bg-blue-300 active:ring-2 active:ring-yellow-400">
                                Tambah ke Keranjang
                            </button>
                        </form>
                    @else
                        <button type="button" disabled
                            class="flex items-center justify-center w-8 h-8 bg-gray-300 text-white rounded-full transition-all duration-300 cursor-not-allowed ml-4">
                            <svg class="w-6 h-6 text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6" />
                            </svg>
                        </button>
                    @endif
                </div>
                <p class="text-sm text-gray-600 mb-4">{{ $product->description }}</p>

                <!-- Rating -->
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

                <!-- Form Rating -->
                @auth
                    @php
                        $userRating = $product->ratings->where('user_id', auth()->id())->first();
                    @endphp
                    @if ($userRating)
                        <p class="text-sm text-gray-500">Anda Sudah Memberikan Rating {{ $userRating->rating }}
                            stars.</p>
                    @else
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
                            <button type="submit"
                                class="mt-2 bg-blue-500 text-white px-4 py-2 rounded-md transition-all duration-300 hover:bg-blue-300">Submit
                                Rating</button>
                        </form>
                    @endif
                @else
                    <p class="text-sm text-gray-500">Silakan login untuk memberikan rating.</p>
                @endauth

            </div>
        </div>


        <!-- Produk dari Toko Ini -->
        <div class="mt-10">
            <h2 class="text-2xl font-semibold mb-4">Produk dari Toko Ini</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6 ">
                @foreach ($storeProducts as $storeProduct)
                    <a href="{{ route('products.show', $storeProduct->id) }}" class="block">
                        <div class="bg-white shadow rounded-lg p-4 duration-500 hover:scale-105 hover:shadow-xl">
                            <img src="{{ filter_var($storeProduct->image, FILTER_VALIDATE_URL) ? $storeProduct->image : asset('storage/' . $storeProduct->image) }}"
                                alt="{{ $storeProduct->name }}" class="w-full h-40 object-cover rounded">
                            <h3 class="mt-2 font-semibold">{{ $storeProduct->name }}</h3>
                            <div class="flex items-center justify-between mt-2">
                                <p class="text-green-600 font-bold">Rp
                                    {{ number_format($storeProduct->price, 0, ',', '.') }}</p>
                                @if ($product->stock > 0)
                                    <form action="{{ route('cart.store') }}" method="POST" class="flex items-center">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="number" name="quantity" value="1" min="1"
                                            class="quantity-input w-16 h-8 p-2 border border-gray-300 rounded-md text-center"
                                            required>
                                        <button type="submit"
                                            class="flex items-center justify-center w-8 h-8 bg-gray-200 text-white rounded-full transition-all duration-300 hover:bg-gray-300 active:ring-2 active:ring-yellow-400 ml-2">
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
                                        class="flex items-center justify-center w-8 h-8 bg-gray-300 text-white rounded-full transition-all duration-300 cursor-not-allowed ml-2">
                                        <svg class="w-6 h-6 text-gray-600" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2"
                                                d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6" />
                                        </svg>
                                    </button>
                                @endif
                            </div>

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
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">
                @foreach ($relatedProducts as $relatedProduct)
                    <a href="{{ route('products.show', $relatedProduct->id) }}" class="block">
                        <div class="bg-white shadow rounded-lg p-4 duration-500 hover:scale-105 hover:shadow-xl">
                            <img src="{{ filter_var($relatedProduct->image, FILTER_VALIDATE_URL) ? $relatedProduct->image : asset('storage/' . $relatedProduct->image) }}"
                                alt="{{ $relatedProduct->name }}" class="w-full h-40 object-cover rounded">
                            <h3 class="mt-2 font-semibold">{{ $relatedProduct->name }}</h3>
                            <div class="flex items-center justify-between mt-2">
                                <p class="text-green-600 font-bold">
                                    Rp {{ number_format($relatedProduct->price, 0, ',', '.') }}
                                </p>
                                @if ($relatedProduct->stock > 0)
                                    <form action="{{ route('cart.store') }}" method="POST"
                                        class="flex items-center">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $relatedProduct->id }}">
                                        <input type="number" name="quantity" value="1" min="1"
                                            class="quantity-input w-16 h-8 p-2 border border-gray-300 rounded-md text-center"
                                            required>
                                        <button type="submit"
                                            class="flex items-center justify-center w-8 h-8 bg-gray-200 text-white rounded-full transition-all duration-300 hover:bg-gray-300 active:ring-2 active:ring-yellow-400 ml-2">
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
                                            <path stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2"
                                                d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6" />
                                        </svg>
                                    </button>
                                @endif
                            </div>

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
