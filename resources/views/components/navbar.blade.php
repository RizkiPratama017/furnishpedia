@php
    $cartItems = \App\Models\Cart::with('product')->where('user_id', auth()->id())->get();
    $totalItems = $cartItems->sum('quantity');
@endphp

<nav class="bg-white dark:bg-gray-800 sticky top-0 z-50">
    <div class="max-w-screen-xl px-4 mx-auto py-4">
        <div class="flex items-center justify-between">

            <div class="flex items-center space-x-8">
                <div class="shrink-0">
                    <a href="#" title="" class="">
                        <img class="block w-auto h-8 dark:hidden" src="img/ruma.png" alt="">
                        <img class="hidden w-auto h-8 dark:block" src="img/ruma.png" alt="">
                    </a>
                </div>

                <ul class="hidden lg:flex items-center justify-start gap-6 md:gap-8 py-3 sm:justify-center">
                    <li>
                        <a href="#" title=""
                            class="flex text-sm font-medium text-gray-900 hover:text-primary-700 dark:text-white dark:hover:text-primary-500">
                            Home
                        </a>
                    </li>
                    <li class="shrink-0">
                        <a href="#" title=""
                            class="flex text-sm font-medium text-gray-900 hover:text-primary-700 dark:text-white dark:hover:text-primary-500">
                            Category
                        </a>
                    </li>
                    <li class="shrink-0">
                        <a href="#" title=""
                            class="flex text-sm font-medium text-gray-900 hover:text-primary-700 dark:text-white dark:hover:text-primary-500">
                            About
                        </a>
                    </li>
                </ul>
            </div>

            <form method="GET" action="{{ route('search') }}" class="max-w-md mx-auto" id="search-form">
                <label for="default-search"
                    class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Pencarian</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="search" name="q" id="search"
                        class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Cari Barang" required />
                    <button type="submit"
                        class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Cari</button>
                </div>
            </form>

            <div class="flex items-center lg:space-x-2">

                <!-- Cart Dropdown -->
                <button id="dropdownCartButton" data-dropdown-toggle="dropdownCart"
                    class="inline-flex items-center justify-center p-2 text-gray-900 bg-white rounded-lg hover:bg-gray-100 dark:text-white dark:bg-gray-800 dark:hover:bg-gray-700">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312" />
                    </svg>
                    <span class="ml-2">My Cart ({{ $totalItems ?? 0 }})</span>
                    <svg class="hidden sm:flex w-4 h-4 text-gray-900 dark:text-white ms-1" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 9-7 7-7-7" />
                    </svg>
                </button>

                <!-- Cart Items Dropdown -->
                <div id="dropdownCart"
                    class="hidden z-10 w-64 bg-white rounded-lg shadow divide-y divide-gray-100 dark:bg-gray-700 dark:divide-gray-600">
                    <ul class="p-2 space-y-2 text-sm text-gray-900 dark:text-gray-100">
                        @foreach ($cartItems as $item)
                            <li class="flex items-center p-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-600">
                                <a href="{{ route('products.show', $item->product->id) }}"
                                    class="flex items-center w-full">
                                    {{ $item->product->name }}
                                    <span class="ml-auto text-gray-500 dark:text-gray-400">
                                        {{ $item->quantity }} x
                                        Rp.{{ number_format($item->product->price, 0, ',', '.') }}
                                    </span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="p-2">
                        {{-- <a href="{{ route('checkout.index') }}" --}}
                        <a href="#"
                            class="block w-full text-center text-white bg-blue-600 px-4 py-2 rounded-md hover:bg-blue-700">
                            Proceed to Checkout
                        </a>
                    </div>
                </div>

                <!-- User Dropdown -->
                <button id="dropdownUserButton" data-dropdown-toggle="dropdownUser"
                    class="inline-flex items-center justify-center p-2 text-gray-900 bg-white rounded-lg hover:bg-gray-100 dark:text-white dark:bg-gray-800 dark:hover:bg-gray-700">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 17v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                    Account
                    <svg class="w-4 h-4 text-gray-900 dark:text-white ms-1" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 9-7 7-7-7" />
                    </svg>
                </button>

                <div id="dropdownUser"
                    class="hidden z-10 w-56 bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-800 dark:divide-gray-600">
                    @if (Auth::check())
                        <ul class="p-2 space-y-2 text-sm text-gray-900 dark:text-white">
                            <li>
                                <a href="#"
                                    class="block p-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-600">
                                    My Account
                                </a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block p-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-600">
                                    My Orders
                                </a>
                            </li>
                            <li>
                                @if (Auth::user()->role === 'buyer')
                                    <a href="/bukatoko"
                                        class="block p-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-600">
                                        Buka Toko
                                    </a>
                                @endif
                            </li>
                            @if (Auth::user()->role === 'seller')
                                <li>
                                    <a href="/dashboard"
                                        class="block p-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-600">
                                        Dashboard Seller
                                    </a>
                                </li>
                            @elseif (Auth::user()->role === 'admin')
                                <li>
                                    <a href="/dashboard"
                                        class="block p-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-600">
                                        Dashboard Admin
                                    </a>
                                </li>
                            @endif
                        </ul>
                        <div class="p-2">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="block w-full p-2 text-center text-white bg-blue-600 hover:bg-blue-700 rounded-md">
                                    Log Out
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="p-2">
                            <a href="{{ route('login') }}"
                                class="block w-full text-center text-white bg-blue-600 px-4 py-2 rounded-md hover:bg-blue-700">
                                Log In
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</nav>
