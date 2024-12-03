<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <header>
        <x-navbar></x-navbar>
    </header>

    <body class="container mx-auto flex justify-center ">
        {{-- Carousel --}}
        <div id="default-carousel" class="relative w-full" data-carousel="slide">
            <!-- Carousel wrapper -->
            <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                <!-- Item 1 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="https://c4.wallpaperflare.com/wallpaper/452/939/736/sofa-furniture-chair-cushion-wallpaper-preview.jpg"
                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>
                <!-- Item 2 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="https://images.alphacoders.com/255/255263.jpg"
                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>
                <!-- Item 3 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="https://w0.peakpx.com/wallpaper/280/795/HD-wallpaper-gray-room-modern-interiors-gray-furniture-laminate-on-wall-modern-design-living-room.jpg"
                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>
                <!-- Item 4 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="https://images.rawpixel.com/image_800/czNmcy1wcml2YXRlL3Jhd3BpeGVsX2ltYWdlcy93ZWJzaXRlX2NvbnRlbnQvbHIvcC00NjctdGQtMTUxNDMtMDQtbW9ja3VwXzEuanBn.jpg"
                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>
                <!-- Item 5 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="https://c4.wallpaperflare.com/wallpaper/215/944/975/warm-and-modern-living-room-living-room-set-wallpaper-preview.jpg"
                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>
            </div>
            <!-- Slider indicators -->
            <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
                <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1"
                    data-carousel-slide-to="0"></button>
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2"
                    data-carousel-slide-to="1"></button>
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3"
                    data-carousel-slide-to="2"></button>
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 4"
                    data-carousel-slide-to="3"></button>
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 5"
                    data-carousel-slide-to="4"></button>
            </div>
            <!-- Slider controls -->
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


        <div class="text-center p-10 mt-10">
            <h1 class="font-bold text-4xl mb-4">Daftar Produk</h1>
            <h1 class="text-3xl">Produk</h1>
        </div>


        <section id="Projects"
            class="w-full max-w-screen-lg grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 px-4 py-4 mx-auto">

            {{--  mulai produk 1  --}}
            <div class="w-72 bg-white shadow-md rounded-xl duration-500 hover:scale-105 hover:shadow-xl mb-10">
                <a href="#">
                    <img src="https://images.pexels.com/photos/6508346/pexels-photo-6508346.jpeg?auto=compress&cs=tinysrgb&w=600"
                        alt="Product" class="h-80 w-72 object-cover rounded-t-xl" />
                    <div class="px-4 py-3 w-72">
                        <span class="text-gray-400 mr-3 uppercase text-xs">IKEO</span>
                        <p class="text-lg font-bold text-black truncate block capitalize">Lemari</p>
                        <div class="flex items-center">
                            <p class="text-lg font-semibold text-black cursor-auto my-3">Rp.150K</p>
                            <del>
                                <p class="text-sm text-gray-600 cursor-auto ml-2">Rp.199K</p>
                            </del>
                            <div class="ml-auto"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    fill="currentColor" class="bi bi-bag-plus" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5z" />
                                    <path
                                        d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                                </svg></div>
                        </div>
                    </div>
                </a>
            </div>
            {{-- akhir produk 1 --}}

            <div class="w-72 bg-white shadow-md rounded-xl duration-500 hover:scale-105 hover:shadow-xl mb-10">
                <a href="#">
                    <img src="https://images.unsplash.com/photo-1565814329452-e1efa11c5b89?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTZ8fGxhbXB8ZW58MHx8MHx8fDA%3D"
                        alt="Product" class="h-80 w-72 object-cover rounded-t-xl" />
                    <div class="px-4 py-3 w-72">
                        <span class="text-gray-400 mr-3 uppercase text-xs">Sanex</span>
                        <p class="text-lg font-bold text-black truncate block capitalize">Lampu</p>
                        <div class="flex items-center">
                            <p class="text-lg font-semibold text-black cursor-auto my-3">Rp.49K</p>
                            <del>
                                <p class="text-sm text-gray-600 cursor-auto ml-2">Rp.100K</p>
                            </del>
                            <div class="ml-auto"><svg xmlns="http://www.w3.org/2000/svg" width="20"
                                    height="20" fill="currentColor" class="bi bi-bag-plus" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5z" />
                                    <path
                                        d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                                </svg></div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="w-72 bg-white shadow-md rounded-xl duration-500 hover:scale-105 hover:shadow-xl mb-10">
                <a href="#">
                    <img src="https://plus.unsplash.com/premium_photo-1725075084469-b9c0272fdcf1?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NXx8Y2xvY2t8ZW58MHx8MHx8fDA%3D"
                        alt="Product" class="h-80 w-72 object-cover rounded-t-xl" />
                    <div class="px-4 py-3 w-72">
                        <span class="text-gray-400 mr-3 uppercase text-xs">sumsang</span>
                        <p class="text-lg font-bold text-black truncate block capitalize">Jam Dinding</p>
                        <div class="flex items-center">
                            <p class="text-lg font-semibold text-black cursor-auto my-3">Rp.100K</p>
                            <del>
                                <p class="text-sm text-gray-600 cursor-auto ml-2">Rp.150K</p>
                            </del>
                            <div class="ml-auto"><svg xmlns="http://www.w3.org/2000/svg" width="20"
                                    height="20" fill="currentColor" class="bi bi-bag-plus" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5z" />
                                    <path
                                        d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                                </svg></div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="w-72 bg-white shadow-md rounded-xl duration-500 hover:scale-105 hover:shadow-xl mb-10">
                <a href="#">
                    <img src="https://images.unsplash.com/photo-1499933374294-4584851497cc?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MjJ8fGZ1cm5pdHVyZXxlbnwwfHwwfHx8MA%3D%3D"
                        alt="Product" class="h-80 w-72 object-cover rounded-t-xl" />
                    <div class="px-4 py-3 w-72">
                        <span class="text-gray-400 mr-3 uppercase text-xs">IKEO</span>
                        <p class="text-lg font-bold text-black truncate block capitalize">Meja</p>
                        <div class="flex items-center">
                            <p class="text-lg font-semibold text-black cursor-auto my-3">Rp.99K</p>
                            <del>
                                <p class="text-sm text-gray-600 cursor-auto ml-2">Rp.199K</p>
                            </del>
                            <div class="ml-auto"><svg xmlns="http://www.w3.org/2000/svg" width="20"
                                    height="20" fill="currentColor" class="bi bi-bag-plus" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5z" />
                                    <path
                                        d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                                </svg></div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="w-72 bg-white shadow-md rounded-xl duration-500 hover:scale-105 hover:shadow-xl mb-10">
                <a href="#">
                    <img src="https://images.unsplash.com/photo-1506898667547-42e22a46e125?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTh8fGZ1cm5pdHVyZXxlbnwwfHwwfHx8MA%3D%3D"
                        alt="Product" class="h-80 w-72 object-cover rounded-t-xl" />
                    <div class="px-4 py-3 w-72">
                        <span class="text-gray-400 mr-3 uppercase text-xs">IKEO</span>
                        <p class="text-lg font-bold text-black truncate block capitalize">Sofa Single</p>
                        <div class="flex items-center">
                            <p class="text-lg font-semibold text-black cursor-auto my-3">Rp.149K</p>
                            <del>
                                <p class="text-sm text-gray-600 cursor-auto ml-2">Rp.200K</p>
                            </del>
                            <div class="ml-auto"><svg xmlns="http://www.w3.org/2000/svg" width="20"
                                    height="20" fill="currentColor" class="bi bi-bag-plus" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5z" />
                                    <path
                                        d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                                </svg></div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="w-72 bg-white shadow-md rounded-xl duration-500 hover:scale-105 hover:shadow-xl mb-10">
                <a href="#">
                    <img src="https://images.unsplash.com/photo-1567016432779-094069958ea5?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8ZnVybml0dXJlfGVufDB8fDB8fHww"
                        alt="Product" class="h-80 w-72 object-cover rounded-t-xl" />
                    <div class="px-4 py-3 w-72">
                        <span class="text-gray-400 mr-3 uppercase text-xs">IKEO</span>
                        <p class="text-lg font-bold text-black truncate block capitalize">Sofa Double</p>
                        <div class="flex items-center">
                            <p class="text-lg font-semibold text-black cursor-auto my-3">Rp.249K</p>
                            <del>
                                <p class="text-sm text-gray-600 cursor-auto ml-2">Rp.399K</p>
                            </del>
                            <div class="ml-auto"><svg xmlns="http://www.w3.org/2000/svg" width="20"
                                    height="20" fill="currentColor" class="bi bi-bag-plus" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5z" />
                                    <path
                                        d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                                </svg></div>
                        </div>
                    </div>
                </a>
            </div>


        </section>

    </body>

    <x-footer></x-footer>
</x-layout>
