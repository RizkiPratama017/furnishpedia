<nav class=" bg-gray-800 text-white">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="{{ asset('img/r.jpg') }}" class="h-8 rounded" alt="Ruma.id Logo" />
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Furnishpedia</span>
        </a>
        <button data-collapse-toggle="navbar-hamburger" type="button"
            class="inline-flex items-center justify-center p-2 w-10 h-10 text-sm text-gray-500 rounded-lg hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-200"
            aria-controls="navbar-hamburger" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M1 1h15M1 7h15M1 13h15" />
            </svg>
        </button>
        <div class="hidden w-full" id="navbar-hamburger">
            <ul class="flex flex-col font-medium mt-4 rounded-lg bg-gray-800 text-white">
                <li>
                    <a href="/home" class="block py-2 px-3 text-white hover:bg-gray-100 hover:text-black"
                        aria-current="page">Home</a>
                </li>
                <li>
                    <a href="/category"
                        class="block py-2 px-3 text-white rounded hover:bg-gray-100 hover:text-black">Category</a>
                </li>
                <li>
                    <a href="/product"
                        class="block py-2 px-3 text-white rounded hover:bg-gray-100 hover:text-black">Product</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
