<nav class="bg-gray-800 text-white">
    <div class="flex flex-wrap items-center justify-between p-4">
        <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="{{ asset('img/fp.jpg') }}" class="h-8 rounded" alt="Ruma.id Logo" />
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Furnishpedia</span>
        </a>
        <button data-collapse-toggle="navbar-hamburger" type="button"
            class="inline-flex items-center justify-center p-2 w-10 h-10 text-sm text-gray-500 rounded-lg hover:bg-gray-800 focus:ring-2 ring-gray-300 md:hidden"
            aria-controls="navbar-hamburger" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M1 1h15M1 7h15M1 13h15" />
            </svg>
        </button>
        <div class="hidden w-full md:hidden" id="navbar-hamburger">
            <ul class="flex flex-col font-medium mt-4 rounded-lg bg-gray-800 text-white">
                {{-- Dashboard --}}
                <li>
                    <a href="/dashboard" class="block px-2 py-1 hover:bg-gray-700 rounded flex items-center">
                        <svg class="w-6 h-6 text-white dark:text-gray-800" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 6.025A7.5 7.5 0 1 0 17.975 14H10V6.025Z" />
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13.5 3c-.169 0-.334.014-.5.025V11h7.975c.011-.166.025-.331.025-.5A7.5 7.5 0 0 0 13.5 3Z" />
                        </svg>
                        Dashboard
                    </a>
                </li>

                {{-- Kategori --}}
                @if (Auth::user()->role === 'admin')
                    <!-- Tampilkan semua kategori -->
                    <li>
                        <a href="/dashboard/category"
                            class="block px-2 py-1 hover:bg-gray-700 rounded flex items-center">
                            <svg class="w-6 h-6 text-white dark:text-gray-800" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M15.583 8.445h.01M10.86 19.71l-6.573-6.63a.993.993 0 0 1 0-1.4l7.329-7.394A.98.98 0 0 1 12.31 4l5.734.007A1.968 1.968 0 0 1 20 5.983v5.5a.992.992 0 0 1-.316.727l-7.44 7.5a.974.974 0 0 1-1.384.001Z" />
                            </svg>
                            Kategori
                        </a>
                    </li>
                @else
                @endif

                {{-- Produk --}}
                <li>
                    <a href="/dashboard/product" class="block px-2 py-1 hover:bg-gray-700 rounded flex items-center">
                        <svg class="w-6 h-6 text-white dark:text-gray-800" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 10V6a3 3 0 0 1 3-3v0a3 3 0 0 1 3 3v4m3-2 .917 11.923A1 1 0 0 1 17.92 21H6.08a1 1 0 0 1-.997-1.077L6 8h12Z" />
                        </svg>
                        Produk
                    </a>
                </li>

                {{-- Order: Tampilkan Hanya untuk Penjual --}}
                @if (auth()->user()->role === 'seller')
                    <li>
                        <a href="/dashboard/order" class="block px-2 py-1 hover:bg-gray-700 rounded flex items-center">
                            <svg class="w-6 h-6 text-white dark:text-gray-800" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312" />
                            </svg>
                            Order
                        </a>
                    </li>
                @endif

                {{-- Logout --}}
                <li>
                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit" class="block px-2 py-1 hover:bg-gray-700 rounded"> Logout </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
