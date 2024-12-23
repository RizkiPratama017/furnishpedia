<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <header>
        <x-navbar></x-navbar>
    </header>
    <div class="w-full mt-6 px-4">
        <div class="grid grid-cols-3 gap-6">

            <!-- Keranjang Belanja -->
            <div class="col-span-2 bg-white p-4 rounded-lg shadow">
                <h1 class="text-2xl font-bold mb-4">Keranjang Belanja</h1>

                @if ($cartItems->isEmpty())
                    <div class="bg-yellow-100 text-yellow-700 p-4 rounded mb-4">
                        Keranjang Anda kosong. Silakan tambahkan produk.
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full border-collapse">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-4 py-2 text-left">
                                        <input type="checkbox" id="select-all" class="form-checkbox">
                                    </th>
                                    <th class="px-4 py-2 text-left">Produk</th>
                                    <th class="px-4 py-2 text-left">Harga</th>
                                    <th class="px-4 py-2 text-left">Jumlah</th>
                                    <th class="px-4 py-2 text-left">Total</th>
                                    <th class="px-4 py-2 text-left">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cartItems as $item)
                                    <tr class="border-b">
                                        <td class="px-4 py-2">
                                            <input type="checkbox" name="select-item" value="{{ $item->id }}"
                                                class="form-checkbox">
                                        </td>
                                        <td class="px-4 py-2 flex items-center gap-4">
                                            <img src="{{ filter_var($item->product->image, FILTER_VALIDATE_URL) ? $item->product->image : asset('storage/' . $item->product->image) }}"
                                                alt="{{ $item->product->name }}" class="w-16 h-16 object-cover rounded">
                                            <span>{{ $item->product->name }}</span>
                                        </td>
                                        <td class="px-4 py-2">Rp {{ number_format($item->product->price, 0, ',', '.') }}
                                        </td>
                                        <td class="px-4 py-2">
                                            <div class="flex items-center gap-2">

                                                <form action="{{ route('cart.update', $item->id) }}" method="POST"
                                                    class="flex items-center">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="quantity"
                                                        value="{{ max(1, $item->quantity - 1) }}">
                                                    <button type="submit" class="text-gray-500 hover:text-gray-700">
                                                        <svg class="w-6 h-6 text-gray-800 dark:text-white"
                                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                            width="24" height="24" fill="none"
                                                            viewBox="0 0 24 24">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                        </svg>

                                                    </button>
                                                </form>


                                                <span class="text-gray-700 font-semibold">{{ $item->quantity }}</span>


                                                <form action="{{ route('cart.update', $item->id) }}" method="POST"
                                                    class="flex items-center">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="quantity"
                                                        value="{{ $item->quantity + 1 }}">
                                                    <button type="submit" class="text-gray-500 hover:text-gray-700">
                                                        <svg class="w-6 h-6 text-gray-800 dark:text-white"
                                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                            width="24" height="24" fill="none"
                                                            viewBox="0 0 24 24">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                        </svg>

                                                    </button>
                                                </form>
                                            </div>
                                        </td>

                                        <td class="px-4 py-2">Rp
                                            {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                                        </td>
                                        <td class="px-4 py-2">
                                            <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700">
                                                    <!-- Heroicons Trash Icon -->
                                                    <svg class="w-6 h-6 text-red-500 dark:text-white" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        fill="none" viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            <!-- Ringkasan Belanja -->
            <div class="col-span-1 bg-white p-4 rounded-lg shadow">
                <h2 class="text-xl font-semibold mb-4">Ringkasan Belanja</h2>
                <div class="mb-4">
                    <p class="text-gray-700">Total:</p>
                    <p class="text-2xl font-bold">
                        Rp
                        {{ number_format($cartItems->sum(fn($item) => $item->product->price * $item->quantity), 0, ',', '.') }}
                    </p>
                </div>
                <a href="{{ route('checkout.index') }}"
                    class="block mt-2 w-full text-center px-4 py-2 bg-green-500 text-white font-semibold rounded hover:bg-green-600">
                    Checkout
                </a>
            </div>
        </div>
    </div>
</x-layout>
