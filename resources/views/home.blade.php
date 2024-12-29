<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <header>
        <x-navbar></x-navbar>
    </header>

    <div class="container mx-auto px-4">
        {{-- Carousel --}}
        <div id="default-carousel" class="relative w-full mb-10" data-carousel="slide">
            <!-- Carousel Container -->
            <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                @foreach ($products as $index => $product)
                    <a href="{{ route('products.show', $product->id) }}"
                        class="{{ $index === 0 ? '' : 'hidden' }} duration-700 ease-in-out" data-carousel-item>
                        <img src="{{ filter_var($product->image, FILTER_VALIDATE_URL) ? $product->image : asset('storage/' . $product->image) }}"
                            class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                            alt="{{ $product->name }}">
                        <div class="absolute bottom-0 left-0 w-full bg-black bg-opacity-50 text-white text-center py-2">
                            <p class="text-sm font-semibold">{{ $product->name }}</p>
                        </div>
                    </a>
                @endforeach
            </div>

            <!-- Slider Indicators -->
            <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
                @foreach ($products as $index => $product)
                    <button type="button"
                        class="w-3 h-3 rounded-full opacity-0 bg-gray-500 bg-opacity-50 hover:bg-opacity-75 transition"
                        aria-current="{{ $index === 0 ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}"
                        data-carousel-slide-to="{{ $index }}"></button>
                @endforeach
            </div>

            <!-- Slider Controls -->
            <button type="button"
                class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                data-carousel-prev>
                <span
                    class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 1 1 5l4 4" />
                    </svg>
                    <span class="sr-only">Previous</span>
                </span>
            </button>
            <button type="button"
                class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                data-carousel-next>
                <span
                    class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="sr-only">Next</span>
                </span>
            </button>
        </div>
        {{-- Carousel --}}

        {{-- Hero Section --}}
        <section class="px-5 py-10 bg-neutral-100 lg:py-20 min-h-screen flex items-center justify-center">
            <div class="grid lg:grid-cols-2 items-center justify-items-center gap-10 max-w-7xl w-full">
                <!-- Text Section -->
                <div class="order-2 lg:order-1 flex flex-col justify-center items-center text-center">
                    <p class="text-4xl font-bold md:text-7xl text-orange-600">25% OFF</p>
                    <p class="text-4xl font-bold md:text-7xl">SUMMER SALE</p>
                    <p class="mt-2 text-sm md:text-lg">For limited time only!</p>
                    <button class="text-lg md:text-2xl bg-black text-white py-3 px-8 mt-10 hover:bg-zinc-800">
                        Shop Now
                    </button>
                </div>
                <!-- Image Section -->
                <div class="order-1 lg:order-2">
                    <img class="h-96 w-96 object-cover lg:w-[600px] lg:h-[600px]"
                        src="https://media.dekoruma.com/catalogue/TNZ-466474.jpg?auto=webp&bg-color=ffffff&dpr=1&fit=bounds&optimize=high&pad=0&quality=20&trim-color=auto"
                        alt="">
                </div>
            </div>
        </section>
        {{-- Hero Section --}}

        {{-- Product List Heading --}}
        <div class="text-center p-10 mt-10">
            <h1 class="font-bold text-4xl mb-4">Daftar Produk</h1>
            <h1 class="text-3xl">Produk</h1>
        </div>

        {{-- Product Section --}}
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
                            <p class="text-lg font-bold text-black truncate block capitalize">{{ $product->name }}</p>
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
                    </div>
                </div>
            @endforeach
        </section>
    </div>

    <x-footer></x-footer>
</x-layout>
