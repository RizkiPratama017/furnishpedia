<aside class="bg-gray-800 text-white w-64 p-4 flex flex-col hidden lg:block">
    <ul class="space-y-2">
        {{-- Dashboard --}}
        <li>
            <a href="/dashboard" class="block px-2 py-1 hover:bg-gray-700 rounded flex items-center">
                <svg class="w-6 h-6 text-white dark:text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 6.025A7.5 7.5 0 1 0 17.975 14H10V6.025Z" />
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13.5 3c-.169 0-.334.014-.5.025V11h7.975c.011-.166.025-.331.025-.5A7.5 7.5 0 0 0 13.5 3Z" />
                </svg>
                Dashboard
            </a>
        </li>

        {{-- Kategori --}}
        <li>
            <a href="/dashboard/category" class="block px-2 py-1 hover:bg-gray-700 rounded flex items-center">
                <svg class="w-6 h-6 text-white dark:text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15.583 8.445h.01M10.86 19.71l-6.573-6.63a.993.993 0 0 1 0-1.4l7.329-7.394A.98.98 0 0 1 12.31 4l5.734.007A1.968 1.968 0 0 1 20 5.983v5.5a.992.992 0 0 1-.316.727l-7.44 7.5a.974.974 0 0 1-1.384.001Z" />
                </svg>
                Kategori
            </a>
        </li>

        {{-- Produk --}}
        <li>
            <a href="/dashboard/product" class="block px-2 py-1 hover:bg-gray-700 rounded flex items-center">
                <svg class="w-6 h-6 text-white dark:text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="none" viewBox="0 0 24 24">
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
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312" />
                    </svg>
                    Order
                </a>
            </li>
        @endif

        {{-- Profile --}}
        <li>
            <a href="/profile" class="block px-2 py-1 hover:bg-gray-700 rounded flex items-center">
                <svg class="w-6 h-6 text-white dark:text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-width="2"
                        d="M7 17v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
                Profile
            </a>
        </li>

        {{-- Logout --}}
        <li>
            <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="block px-2 py-1 hover:bg-gray-700 rounded"> Logout </button>
            </form>
        </li>
    </ul>
</aside>
