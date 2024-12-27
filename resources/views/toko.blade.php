<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <header>
        <x-navbar></x-navbar>
    </header>
    <div class="container mx-auto mt-5">
        <div class="container mx-auto mt-5 px-4">
            <!-- Informasi Toko -->
            <div class="flex items-center justify-between mb-6 p-4 bg-white rounded-lg shadow-lg border border-gray-200">
                <div class="flex items-center space-x-4">
                    <!-- Logo Toko -->
                    <img src="{{ filter_var($user->image, FILTER_VALIDATE_URL) ? $user->image : asset('storage/' . $user->image) }}"
                        alt="Logo {{ $user->name }}" class="w-16 h-16 rounded-full">
                    <div>
                        <!-- Nama Toko -->
                        <h1 class="text-2xl font-bold text-gray-800">{{ $user->name }}</h1>
                        <!-- Status dan Lokasi -->
                        <p class="text-gray-500"><span class="text-green-500">Online</span> • {{ $user->address }}</p>
                    </div>
                </div>
            </div>

            <section id="Projects"
                class="w-full max-w-screen-lg grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 px-4 py-4 mx-auto">
                @foreach ($products as $product)
                    <div
                        class="w-full md:w-72 bg-white shadow-md rounded-xl duration-500 hover:scale-105 hover:shadow-xl mb-10">
                        <a href="{{ route('products.show', $product->id) }}">
                            <img src="{{ filter_var($product->image, FILTER_VALIDATE_URL) ? $product->image : asset('storage/' . $product->image) }}"
                                alt="{{ $product->name }}" class="h-80 w-full object-cover rounded-t-xl" />
                            <div class="px-4 py-3">
                                <span class="text-gray-400 mr-3 uppercase text-xs">{{ $product->category->name }}</span>
                                <p class="text-lg font-bold text-black truncate block capitalize">{{ $product->name }}
                                </p>
                                <div class="flex items-center justify-between mt-3">
                                    <p class="text-lg font-semibold text-black cursor-auto">
                                        Rp.{{ number_format($product->price, 0, ',', '.') }}
                                    </p>
                                    @if ($product->original_price)
                                        <del>
                                            <p class="text-sm text-gray-600 ml-2">
                                                Rp.{{ number_format($product->original_price, 0, ',', '.') }}
                                            </p>
                                        </del>
                                    @endif

                                    @if ($product->stock > 0)
                                        <form action="{{ route('cart.store') }}" method="POST"
                                            class="flex items-center ml-4">
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
                                            class="flex items-center justify-center w-8 h-8 bg-gray-300 text-white rounded-full transition-all duration-300 cursor-not-allowed ml-4">
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
                        </a>
                        <div class="flex items-center px-4 py-3">
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
                            <span class="ml-2 text-sm text-gray-500">{{ number_format($averageRating, 1) }} / 5</span>
                        </div>
                    </div>
                @endforeach
            </section>
        </div>
    </div>
</x-layout>
