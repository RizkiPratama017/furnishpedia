<aside class="bg-gray-800 text-white w-64 p-4 flex flex-col">
    <div class="flex text-sm bg-gray-800 rounded-full md:me-0" id="user-menu-button" aria-expanded="false"
        data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
        <span class="sr-only">Open user menu</span>
        <img class="w-8 h-8 rounded-full" src="{{ asset('img/r.jpg') }}" alt="user photo">
        <h2 class="text-xl font-semibold mb-5 mx-2 my-1">User Penjual</h2>
    </div>
    <ul class="space-y-2">
        <li>
            <a href="/dashboard" class="block px-2 py-1 hover:bg-gray-700 rounded flex items-center">
                <svg class="w-6 h-6 text-white  dark:text-gray-800" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 6.025A7.5 7.5 0 1 0 17.975 14H10V6.025Z" />
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13.5 3c-.169 0-.334.014-.5.025V11h7.975c.011-.166.025-.331.025-.5A7.5 7.5 0 0 0 13.5 3Z" />
                </svg>

                Dashboard
            </a>
        </li>
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
        <li>
            <a href="#" class="block px-2 py-1 hover:bg-gray-700 rounded flex items-center">
                <svg class="w-6 h-6 text-white dark:text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-width="2"
                        d="M7 17v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>

                Profile
            </a>
        </li>
        <li>
            <form action="/logout" method="POST">
            @csrf
                <button type="submit" class="block px-2 py-1 hover:bg-gray-700 rounded"> Sign out </button>
        </form>
        </li>
    </ul>
</aside>
