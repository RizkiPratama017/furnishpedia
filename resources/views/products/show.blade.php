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

            <!-- Product Information -->
            <div class="md:w-1/2">
                <h1 class="text-3xl font-bold mb-4">{{ $product->name }}</h1>
                <p class="text-2xl font-semibold text-green-600 mb-2">Rp
                    {{ number_format($product->price, 0, ',', '.') }}</p>
                <p class="text-sm text-gray-500 mb-4">Stok Tersisa: <span class="font-bold">{{ $product->stock }}</span>
                </p>
                <p class="text-sm  mb-4">{{ $product->description }}</p>

                <!-- Quantity and Cart -->
                @if ($product->stock > 0)
                    <form action="{{ route('cart.store') }}" method="POST" class="flex items-center gap-4">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="flex items-center border border-gray-300 rounded-md">
                            <button type="button" class="px-3 py-2 text-gray-500 hover:bg-gray-100"
                                onclick="this.nextElementSibling.stepDown()">−</button>
                            <input type="number" name="quantity" value="1" min="1"
                                max="{{ $product->stock }}"
                                class="w-16 h-10 text-center border-none focus:outline-none">
                            <button type="button" class="px-3 py-2 text-gray-500 hover:bg-gray-100"
                                onclick="this.previousElementSibling.stepUp()">+</button>
                        </div>
                        <button type="submit"
                            class="flex items-center justify-center w-8 h-8 bg-gray-200 text-white rounded-full transition-all duration-300 hover:bg-gray-300 active:ring-2 active:ring-yellow-400">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6" />
                            </svg>
                        </button>
                    </form>
                @else
                    <button type="button" disabled
                        class="bg-gray-400 text-white px-4 py-2 rounded-lg cursor-not-allowed">Stok Habis</button>
                @endif
            </div>
        </div>
    </div>

    <x-footer></x-footer>
</x-layout>
