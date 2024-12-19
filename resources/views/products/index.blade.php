<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <header>
        <x-navbar></x-navbar>
    </header>

    <div class="container mx-auto px-4 py-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Filter Produk</h1>

        <form action="{{ route('products.index') }}" method="GET" class="bg-white shadow-md rounded-lg p-6 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="form-group">
                    <label for="category_id" class="block text-sm font-medium text-gray-700">Kategori</label>
                    <select name="category_id" id="category_id"
                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Semua Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="price_min" class="block text-sm font-medium text-gray-700">Harga Minimum</label>
                    <input type="number" name="price_min" id="price_min" placeholder="0"
                        value="{{ request('price_min') }}"
                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <div class="form-group">
                    <label for="price_max" class="block text-sm font-medium text-gray-700">Harga Maksimum</label>
                    <input type="number" name="price_max" id="price_max" placeholder="1000000"
                        value="{{ request('price_max') }}"
                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
            </div>

            <div class="mt-4">
                <button type="submit"
                    class="w-full md:w-auto px-4 py-2 bg-indigo-600 text-white font-medium rounded-md shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    Filter
                </button>
            </div>
        </form>

        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Hasil Pencarian</h2>

        @if ($products->isEmpty())
            <p class="text-gray-500">Tidak ada produk yang sesuai dengan filter.</p>
        @else
            <section id="Projects"
                class="w-full max-w-screen-lg grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 px-4 py-4 mx-auto">
                @foreach ($products as $product)
                    <div
                        class="w-full md:w-72 bg-white shadow-md rounded-xl duration-500 hover:scale-105 hover:shadow-xl mb-10">
                        <a href="{{ route('products.show', $product->id) }}">
                            <img src="{{ filter_var($product->image, FILTER_VALIDATE_URL) ? $product->image : asset('storage/' . $product->image) }}"
                                alt="{{ $product->name }}" class="h-80 w-full object-cover rounded-t-xl" />
                            <div class="px-4 py-3">
                                <span
                                    class="text-gray-400 mr-3 uppercase text-xs">{{ $product->category->name }}</span>
                                <p class="text-lg font-bold text-black truncate block capitalize">{{ $product->name }}
                                </p>
                                <div class="flex items-center mt-3">
                                    <p class="text-lg font-semibold text-black cursor-auto">
                                        Rp.{{ number_format($product->price, 0, ',', '.') }}</p>
                                    @if ($product->original_price)
                                        <del>
                                            <p class="text-sm text-gray-600 ml-2">
                                                Rp.{{ number_format($product->original_price, 0, ',', '.') }}</p>
                                        </del>
                                    @endif

                                    <!-- Tampilkan rating produk dengan Heroicons -->
                                    <div class="ml-auto">
                                        <div class="flex items-center">
                                            @if ($product->ratings->count() > 0)
                                                <div class="flex items-center text-yellow-500">
                                                    <!-- Bintang penuh -->
                                                    @for ($i = 0; $i < floor($product->averageRating()); $i++)
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                                                            fill="currentColor" viewBox="0 0 20 20">
                                                            <path
                                                                d="M10 15l-3.4 2.2 1-4.8L3 7.7l4.8-.4L10 3l2.2 4.5 4.8.4-3.6 4.7 1 4.8L10 15z" />
                                                        </svg>
                                                    @endfor

                                                    <!-- Bintang setengah -->
                                                    @if ($product->averageRating() > floor($product->averageRating()))
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                                                            fill="currentColor" viewBox="0 0 20 20">
                                                            <path
                                                                d="M10 15l-3.4 2.2 1-4.8L3 7.7l4.8-.4L10 3l2.2 4.5 4.8.4-3.6 4.7 1 4.8L10 15z" />
                                                        </svg>
                                                    @endif
                                                </div>
                                                <span
                                                    class="ml-2 text-sm">{{ number_format($product->averageRating(), 1) }}
                                                    / 5</span>
                                            @else
                                                <span class="text-gray-500">No ratings yet</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="ml-auto">
                                        <!-- Tombol Keranjang -->
                                        @if ($product->stock > 0)
                                            <form action="{{ route('cart.store') }}" method="POST"
                                                class="flex items-center">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <input type="number" name="quantity" value="1" min="1"
                                                    class="quantity-input w-16 h-8 p-2 border border-gray-300 rounded-md text-center"
                                                    required>
                                                <button type="submit"
                                                    class="flex items-center justify-center w-8 h-8 bg-gray-200 text-white rounded-full transition-all duration-300 hover:bg-gray-300 active:ring-2 active:ring-yellow-400">
                                                    <svg class="w-6 h-6 text-gray-800 dark:text-white"
                                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                        width="24" height="24" fill="none"
                                                        viewBox="0 0 24 24">
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

                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </section>

        @endif
    </div>
</x-layout>
