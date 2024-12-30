<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <header>
        <x-navbar></x-navbar>
    </header>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
            <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" data-dismiss="alert">
                <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20">
                    <path
                        d="M14.348 5.652a.5.5 0 10-.707.707L9.707 10l3.934 3.934a.5.5 0 00.707-.707L10.414 10l3.934-3.934z">
                    </path>
                </svg>
            </button>
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
            <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" data-dismiss="alert">
                <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20">
                    <path
                        d="M14.348 5.652a.5.5 0 10-.707.707L9.707 10l3.934 3.934a.5.5 0 00.707-.707L10.414 10l3.934-3.934z">
                    </path>
                </svg>
            </button>
        </div>
    @endif


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

        {{-- Category Section --}}
        <div class="container mx-auto py-10 px-4">
            <h1 class="text-3xl font-bold text-center mb-8">Kategori</h1>
            <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($categories as $category)
                    <a href="{{ route('categories.show', $category->slug) }}" class="block group">
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden transform transition hover:scale-105">
                            <div class="p-4"> <!-- Padding dikurangi untuk membuat lebih kecil -->
                                <h2 class="text-lg font-semibold text-gray-800 group-hover:text-green-600 transition">
                                    <!-- Ukuran teks diubah -->
                                    {{ $category->name }}
                                </h2>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>


        {{-- Hero Section --}}
        <section
            class="px-5 py-10 bg-gradient-to-r from-orange-600 to-yellow-500 lg:py-20 min-h-screen flex items-center justify-center text-white">
            <div class="grid lg:grid-cols-2 items-center justify-items-center gap-10 max-w-7xl w-full">
                <div class="order-2 lg:order-1 flex flex-col justify-center items-center text-center space-y-6">
                    <p class="text-4xl font-bold md:text-7xl">{{ $products[0]->name }}</p>
                    <a href="{{ route('products.index') }}"
                        class="text-lg md:text-2xl bg-black text-white py-3 px-8 mt-10 hover:bg-zinc-800 transition-all">
                        Lihat Produk Lainnya
                    </a>
                </div>
                <div class="order-1 lg:order-2">
                    <a href="{{ route('products.show', $product->id) }}">
                        <img class="h-96 w-96 object-cover lg:w-[600px] lg:h-[600px] shadow-xl rounded-full transition-transform transform hover:scale-105"
                            src="{{ filter_var($products[0]->image, FILTER_VALIDATE_URL) ? $products[0]->image : asset('storage/' . $products[0]->image) }}"
                            alt="{{ $products[0]->name }}">
                    </a>
                </div>
            </div>
        </section>


        {{-- Product List Section --}}
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
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </section>
    </div>

    <x-footer></x-footer>
</x-layout>
