<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HomePage</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="node_modules/@glidejs/glide/dist/css/glide.core.min.css">
</head>
<body>
  <header>
    <nav class="bg-white dark:bg-gray-800 antialiased">
        <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0 py-4">
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
                  <a href="#" title="" class="flex text-sm font-medium text-gray-900 hover:text-primary-700 dark:text-white dark:hover:text-primary-500">
                    Home
                  </a>
                </li>
                <li class="shrink-0">
                  <a href="#" title="" class="flex text-sm font-medium text-gray-900 hover:text-primary-700 dark:text-white dark:hover:text-primary-500">
                    Category
                  </a>
                </li>
                <li class="shrink-0">
                  <a href="#" title="" class="flex text-sm font-medium text-gray-900 hover:text-primary-700 dark:text-white dark:hover:text-primary-500">
                    About
                  </a>
                </li>
              
              </ul>
            </div>

            <form class="max-w-md mx-auto">   
                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input type="search" id="default-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Cari Barang" required />
                    <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                </div>
            </form>
      
            <div class="flex items-center lg:space-x-2">
      
              <button id="myCartDropdownButton1" data-dropdown-toggle="myCartDropdown1" type="button" class="inline-flex items-center rounded-lg justify-center p-2 hover:bg-gray-100 dark:hover:bg-gray-700 text-sm font-medium leading-none text-gray-900 dark:text-white">
                <span class="sr-only">
                  Cart
                </span>
                <svg class="w-5 h-5 lg:me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312"/>
                </svg> 
                <span class="hidden sm:flex">My Cart</span>
                <svg class="hidden sm:flex w-4 h-4 text-gray-900 dark:text-white ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7"/>
                </svg>              
              </button>
      
              <div id="myCartDropdown1" class="hidden z-10 mx-auto max-w-sm space-y-4 overflow-hidden rounded-lg bg-white p-4 antialiased shadow-lg dark:bg-gray-800">
                <div class="grid grid-cols-2">
                  <div>
                    <a href="#" class="truncate text-sm font-semibold leading-none text-gray-900 dark:text-white hover:underline">Apple iPhone 15</a>
                    <p class="mt-0.5 truncate text-sm font-normal text-gray-500 dark:text-gray-400">$599</p>
                  </div>
            
                  <div class="flex items-center justify-end gap-6">
                    <p class="text-sm font-normal leading-none text-gray-500 dark:text-gray-400">Qty: 1</p>
            
                    <button data-tooltip-target="tooltipRemoveItem1a" type="button" class="text-red-600 hover:text-red-700 dark:text-red-500 dark:hover:text-red-600">
                      <span class="sr-only"> Remove </span>
                      <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M2 12a10 10 0 1 1 20 0 10 10 0 0 1-20 0Zm7.7-3.7a1 1 0 0 0-1.4 1.4l2.3 2.3-2.3 2.3a1 1 0 1 0 1.4 1.4l2.3-2.3 2.3 2.3a1 1 0 0 0 1.4-1.4L13.4 12l2.3-2.3a1 1 0 0 0-1.4-1.4L12 10.6 9.7 8.3Z" clip-rule="evenodd" />
                      </svg>
                    </button>
                    <div id="tooltipRemoveItem1a" role="tooltip" class="tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-gray-700">
                      Remove item
                      <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                  </div>
                </div>
            
                <div class="grid grid-cols-2">
                  <div>
                    <a href="#" class="truncate text-sm font-semibold leading-none text-gray-900 dark:text-white hover:underline">Apple iPad Air</a>
                    <p class="mt-0.5 truncate text-sm font-normal text-gray-500 dark:text-gray-400">$499</p>
                  </div>
            
                  <div class="flex items-center justify-end gap-6">
                    <p class="text-sm font-normal leading-none text-gray-500 dark:text-gray-400">Qty: 1</p>
            
                    <button data-tooltip-target="tooltipRemoveItem2a" type="button" class="text-red-600 hover:text-red-700 dark:text-red-500 dark:hover:text-red-600">
                      <span class="sr-only"> Remove </span>
                      <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M2 12a10 10 0 1 1 20 0 10 10 0 0 1-20 0Zm7.7-3.7a1 1 0 0 0-1.4 1.4l2.3 2.3-2.3 2.3a1 1 0 1 0 1.4 1.4l2.3-2.3 2.3 2.3a1 1 0 0 0 1.4-1.4L13.4 12l2.3-2.3a1 1 0 0 0-1.4-1.4L12 10.6 9.7 8.3Z" clip-rule="evenodd" />
                      </svg>
                    </button>
                    <div id="tooltipRemoveItem2a" role="tooltip" class="tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-gray-700">
                      Remove item
                      <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                  </div>
                </div>
            
                <div class="grid grid-cols-2">
                  <div>
                    <a href="#" class="truncate text-sm font-semibold leading-none text-gray-900 dark:text-white hover:underline">Apple Watch SE</a>
                    <p class="mt-0.5 truncate text-sm font-normal text-gray-500 dark:text-gray-400">$598</p>
                  </div>
            
                  <div class="flex items-center justify-end gap-6">
                    <p class="text-sm font-normal leading-none text-gray-500 dark:text-gray-400">Qty: 2</p>
            
                    <button data-tooltip-target="tooltipRemoveItem3b" type="button" class="text-red-600 hover:text-red-700 dark:text-red-500 dark:hover:text-red-600">
                      <span class="sr-only"> Remove </span>
                      <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M2 12a10 10 0 1 1 20 0 10 10 0 0 1-20 0Zm7.7-3.7a1 1 0 0 0-1.4 1.4l2.3 2.3-2.3 2.3a1 1 0 1 0 1.4 1.4l2.3-2.3 2.3 2.3a1 1 0 0 0 1.4-1.4L13.4 12l2.3-2.3a1 1 0 0 0-1.4-1.4L12 10.6 9.7 8.3Z" clip-rule="evenodd" />
                      </svg>
                    </button>
                    <div id="tooltipRemoveItem3b" role="tooltip" class="tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-gray-700">
                      Remove item
                      <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                  </div>
                </div>
            
                <div class="grid grid-cols-2">
                  <div>
                    <a href="#" class="truncate text-sm font-semibold leading-none text-gray-900 dark:text-white hover:underline">Sony Playstation 5</a>
                    <p class="mt-0.5 truncate text-sm font-normal text-gray-500 dark:text-gray-400">$799</p>
                  </div>
            
                  <div class="flex items-center justify-end gap-6">
                    <p class="text-sm font-normal leading-none text-gray-500 dark:text-gray-400">Qty: 1</p>
            
                    <button data-tooltip-target="tooltipRemoveItem4b" type="button" class="text-red-600 hover:text-red-700 dark:text-red-500 dark:hover:text-red-600">
                      <span class="sr-only"> Remove </span>
                      <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M2 12a10 10 0 1 1 20 0 10 10 0 0 1-20 0Zm7.7-3.7a1 1 0 0 0-1.4 1.4l2.3 2.3-2.3 2.3a1 1 0 1 0 1.4 1.4l2.3-2.3 2.3 2.3a1 1 0 0 0 1.4-1.4L13.4 12l2.3-2.3a1 1 0 0 0-1.4-1.4L12 10.6 9.7 8.3Z" clip-rule="evenodd" />
                      </svg>
                    </button>
                    <div id="tooltipRemoveItem4b" role="tooltip" class="tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-gray-700">
                      Remove item
                      <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                  </div>
                </div>
            
                <div class="grid grid-cols-2">
                  <div>
                    <a href="#" class="truncate text-sm font-semibold leading-none text-gray-900 dark:text-white hover:underline">Apple iMac 20"</a>
                    <p class="mt-0.5 truncate text-sm font-normal text-gray-500 dark:text-gray-400">$8,997</p>
                  </div>
            
                  <div class="flex items-center justify-end gap-6">
                    <p class="text-sm font-normal leading-none text-gray-500 dark:text-gray-400">Qty: 3</p>
            
                    <button data-tooltip-target="tooltipRemoveItem5b" type="button" class="text-red-600 hover:text-red-700 dark:text-red-500 dark:hover:text-red-600">
                      <span class="sr-only"> Remove </span>
                      <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M2 12a10 10 0 1 1 20 0 10 10 0 0 1-20 0Zm7.7-3.7a1 1 0 0 0-1.4 1.4l2.3 2.3-2.3 2.3a1 1 0 1 0 1.4 1.4l2.3-2.3 2.3 2.3a1 1 0 0 0 1.4-1.4L13.4 12l2.3-2.3a1 1 0 0 0-1.4-1.4L12 10.6 9.7 8.3Z" clip-rule="evenodd" />
                      </svg>
                    </button>
                    <div id="tooltipRemoveItem5b" role="tooltip" class="tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-gray-700">
                      Remove item
                      <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                  </div>
                </div>
            
                <a href="#" title="" class="mb-2 me-2 inline-flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800" role="button"> Proceed to Checkout </a>
              </div>
      
              <button id="userDropdownButton1" data-dropdown-toggle="userDropdown1" type="button" class="inline-flex items-center rounded-lg justify-center p-2 hover:bg-gray-100 dark:hover:bg-gray-700 text-sm font-medium leading-none text-gray-900 dark:text-white">
                <svg class="w-5 h-5 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-width="2" d="M7 17v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                </svg>              
                Account
                <svg class="w-4 h-4 text-gray-900 dark:text-white ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7"/>
                </svg> 
              </button>
      
              <div id="userDropdown1" class="hidden z-10 w-56 divide-y divide-gray-100 overflow-hidden overflow-y-auto rounded-lg bg-white antialiased shadow dark:divide-gray-600 dark:bg-gray-700">
                <ul class="p-2 text-start text-sm font-medium text-gray-900 dark:text-white">
                  <li><a href="#" title="" class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600"> My Account </a></li>
                  <li><a href="#" title="" class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600"> My Orders </a></li>
                  <li><a href="#" title="" class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600"> Settings </a></li>
                  <li><a href="#" title="" class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600"> Favourites </a></li>
                  <li><a href="#" title="" class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600"> Delivery Addresses </a></li>
                  <li><a href="#" title="" class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600"> Billing Data </a></li>
                </ul>
            
                <div class="p-2 text-sm font-medium text-gray-900 dark:text-white">
                  <a href="#" title="" class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600"> Sign Out </a>
                </div>
              </div>
      
              <button type="button" data-collapse-toggle="ecommerce-navbar-menu-1" aria-controls="ecommerce-navbar-menu-1" aria-expanded="false" class="inline-flex lg:hidden items-center justify-center hover:bg-gray-100 rounded-md dark:hover:bg-gray-700 p-2 text-gray-900 dark:text-white">
                <span class="sr-only">
                  Open Menu
                </span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M5 7h14M5 12h14M5 17h14"/>
                </svg>                
              </button>
            </div>
          </div>
      
          <div id="ecommerce-navbar-menu-1" class="bg-gray-50 dark:bg-gray-700 dark:border-gray-600 border border-gray-200 rounded-lg py-3 hidden px-4 mt-4">
            <ul class="text-gray-900 dark:text-white text-sm font-medium dark:text-white space-y-3">
              <li>
                <a href="#" class="hover:text-primary-700 dark:hover:text-primary-500">Home</a>
              </li>
              <li>
                <a href="#" class="hover:text-primary-700 dark:hover:text-primary-500">Best Sellers</a>
              </li>
              <li>
                <a href="#" class="hover:text-primary-700 dark:hover:text-primary-500">Gift Ideas</a>
              </li>
              <li>
                <a href="#" class="hover:text-primary-700 dark:hover:text-primary-500">Games</a>
              </li>
              <li>
                <a href="#" class="hover:text-primary-700 dark:hover:text-primary-500">Electronics</a>
              </li>
              <li>
                <a href="#" class="hover:text-primary-700 dark:hover:text-primary-500">Home & Garden</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>

      <body>
      {{-- Carousel --}}
      <div id="default-carousel" class="relative w-full" data-carousel="slide">
        <!-- Carousel wrapper -->
        <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
             <!-- Item 1 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="https://c4.wallpaperflare.com/wallpaper/452/939/736/sofa-furniture-chair-cushion-wallpaper-preview.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
            <!-- Item 2 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="https://images.alphacoders.com/255/255263.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
            <!-- Item 3 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="https://w0.peakpx.com/wallpaper/280/795/HD-wallpaper-gray-room-modern-interiors-gray-furniture-laminate-on-wall-modern-design-living-room.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
            <!-- Item 4 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="https://images.rawpixel.com/image_800/czNmcy1wcml2YXRlL3Jhd3BpeGVsX2ltYWdlcy93ZWJzaXRlX2NvbnRlbnQvbHIvcC00NjctdGQtMTUxNDMtMDQtbW9ja3VwXzEuanBn.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
            <!-- Item 5 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="https://c4.wallpaperflare.com/wallpaper/215/944/975/warm-and-modern-living-room-living-room-set-wallpaper-preview.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
        </div>
        <!-- Slider indicators -->
        <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
            <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 4" data-carousel-slide-to="3"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 5" data-carousel-slide-to="4"></button>
        </div>
        <!-- Slider controls -->
        <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                </svg>
                <span class="sr-only">Previous</span>
            </span>
        </button>
        <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                </svg>
                <span class="sr-only">Next</span>
            </span>
        </button>
      </div>
 {{-- Carousel --}}

        <br>
        <div class="text-center p-10">
          <h1 class="font-bold text-4xl mb-4">Daftar Produk</h1>
          <h1 class="text-3xl">Produk</h1>
      </div>
      
      <!-- ✅ Grid Section - Starts Here 👇 -->
      <section id="Projects"
    class="w-full max-w-screen-xl mx-auto grid grid-cols-1 lg:grid-cols-3 md:grid-cols-2 justify-items-center justify-center gap-y-5 gap-x-4 mt-10 mb-5">
    
    <!-- ✅ Product card 1 - Starts Here 👇 -->
    <div class="w-72 bg-white shadow-md rounded-xl duration-500 hover:scale-105 hover:shadow-xl">
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
    <!-- 🛑 Product card 1 - Ends Here -->
      
          <!--   ✅ Product card 2 - Starts Here 👇 -->
          <div class="w-72 bg-white shadow-md rounded-xl duration-500 hover:scale-105 hover:shadow-xl">
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
          <!--   🛑 Product card 2- Ends Here  -->
      
          <!--   ✅ Product card 3 - Starts Here 👇 -->
          <div class="w-72 bg-white shadow-md rounded-xl duration-500 hover:scale-105 hover:shadow-xl">
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
          <!--   🛑 Product card 3 - Ends Here  -->
      
          <!--   ✅ Product card 4 - Starts Here 👇 -->
          <div class="w-72 bg-white shadow-md rounded-xl duration-500 hover:scale-105 hover:shadow-xl">
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
          <!--   🛑 Product card 4 - Ends Here  -->
      
          <!--   ✅ Product card 5 - Starts Here 👇 -->
          <div class="w-72 bg-white shadow-md rounded-xl duration-500 hover:scale-105 hover:shadow-xl">
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
          <!--   🛑 Product card 5 - Ends Here  -->
      
          <!--   ✅ Product card 6 - Starts Here 👇 -->
          <div class="w-72 bg-white shadow-md rounded-xl duration-500 hover:scale-105 hover:shadow-xl">
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
          <!--   🛑 Product card 6 - Ends Here  -->
      
      </section>
      
      </body>

      <footer>
        <div class="px-4 pt-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8">
          <div class="grid gap-16 row-gap-10 mb-8 lg:grid-cols-6">
            <div class="md:max-w-md lg:col-span-2">
              <a href="/" aria-label="Go home" title="Ruma" class="inline-flex items-center">
                <svg class="w-8 text-deep-purple-accent-400" viewBox="0 0 24 24" stroke-linejoin="round" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" stroke="currentColor" fill="none">
                  <rect x="3" y="1" width="7" height="12"></rect>
                  <rect x="3" y="17" width="7" height="6"></rect>
                  <rect x="14" y="1" width="7" height="6"></rect>
                  <rect x="14" y="11" width="7" height="12"></rect>
                </svg>
                <span class="ml-2 text-xl font-bold tracking-wide text-gray-800 uppercase">Ruma</span>
              </a>
              <div class="mt-4 lg:max-w-sm">
                <p class="text-sm text-gray-800">
                  Ruma adalah Marketplace yang Menjual Furnitur Rumah
                </p>
                <p class="mt-4 text-sm text-gray-800">
                  Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.
                </p>
              </div>
            </div>
            <div class="grid grid-cols-2 gap-5 row-gap-8 lg:col-span-4 md:grid-cols-4">
              <div>
                <p class="font-semibold tracking-wide text-gray-800">Company</p>
                <ul class="mt-2 space-y-2">
                  <li>
                    <a href="/" class="text-gray-600 transition-colors duration-300 hover:text-deep-purple-accent-400">About Us</a>
                  </li>
                  <li>
                    <a href="/" class="text-gray-600 transition-colors duration-300 hover:text-deep-purple-accent-400">Our Service</a>
                  </li>
                  <li>
                    <a href="/" class="text-gray-600 transition-colors duration-300 hover:text-deep-purple-accent-400">Privacy & Policy</a>
                  </li>
                  <li>
                    <a href="/" class="text-gray-600 transition-colors duration-300 hover:text-deep-purple-accent-400">Affiliate Program</a>
                  </li>
                </ul>
              </div>
              <div>
                <p class="font-semibold tracking-wide text-gray-800">Business</p>
                <ul class="mt-2 space-y-2">
                  <li>
                    <a href="/" class="text-gray-600 transition-colors duration-300 hover:text-deep-purple-accent-400">Web</a>
                  </li>
                  <li>
                    <a href="/" class="text-gray-600 transition-colors duration-300 hover:text-deep-purple-accent-400">eCommerce</a>
                  </li>
                  <li>
                    <a href="/" class="text-gray-600 transition-colors duration-300 hover:text-deep-purple-accent-400">Business</a>
                  </li>
                  <li>
                    <a href="/" class="text-gray-600 transition-colors duration-300 hover:text-deep-purple-accent-400">Entertainment</a>
                  </li>
                  <li>
                    <a href="/" class="text-gray-600 transition-colors duration-300 hover:text-deep-purple-accent-400">Portfolio</a>
                  </li>
                </ul>
              </div>
              
              
            </div>
          </div>
          <div class="flex flex-col justify-between pt-5 pb-10 border-t sm:flex-row">
            <p class="text-sm text-gray-600">
              © Copyright 2024 Ruma.id. All rights reserved.
            </p>
            <div class="flex items-center mt-4 space-x-4 sm:mt-0">
              <a href="/" class="text-gray-500 transition-colors duration-300 hover:text-deep-purple-accent-400">
                <svg viewBox="0 0 24 24" fill="currentColor" class="h-5">
                  <path
                    d="M24,4.6c-0.9,0.4-1.8,0.7-2.8,0.8c1-0.6,1.8-1.6,2.2-2.7c-1,0.6-2,1-3.1,1.2c-0.9-1-2.2-1.6-3.6-1.6 c-2.7,0-4.9,2.2-4.9,4.9c0,0.4,0,0.8,0.1,1.1C7.7,8.1,4.1,6.1,1.7,3.1C1.2,3.9,1,4.7,1,5.6c0,1.7,0.9,3.2,2.2,4.1 C2.4,9.7,1.6,9.5,1,9.1c0,0,0,0,0,0.1c0,2.4,1.7,4.4,3.9,4.8c-0.4,0.1-0.8,0.2-1.3,0.2c-0.3,0-0.6,0-0.9-0.1c0.6,2,2.4,3.4,4.6,3.4 c-1.7,1.3-3.8,2.1-6.1,2.1c-0.4,0-0.8,0-1.2-0.1c2.2,1.4,4.8,2.2,7.5,2.2c9.1,0,14-7.5,14-14c0-0.2,0-0.4,0-0.6 C22.5,6.4,23.3,5.5,24,4.6z"
                  ></path>
                </svg>
              </a>
              <a href="/" class="text-gray-500 transition-colors duration-300 hover:text-deep-purple-accent-400">
                <svg viewBox="0 0 30 30" fill="currentColor" class="h-6">
                  <circle cx="15" cy="15" r="4"></circle>
                  <path
                    d="M19.999,3h-10C6.14,3,3,6.141,3,10.001v10C3,23.86,6.141,27,10.001,27h10C23.86,27,27,23.859,27,19.999v-10   C27,6.14,23.859,3,19.999,3z M15,21c-3.309,0-6-2.691-6-6s2.691-6,6-6s6,2.691,6,6S18.309,21,15,21z M22,9c-0.552,0-1-0.448-1-1   c0-0.552,0.448-1,1-1s1,0.448,1,1C23,8.552,22.552,9,22,9z"
                  ></path>
                </svg>
              </a>
              <a href="/" class="text-gray-500 transition-colors duration-300 hover:text-deep-purple-accent-400">
                <svg viewBox="0 0 24 24" fill="currentColor" class="h-5">
                  <path
                    d="M22,0H2C0.895,0,0,0.895,0,2v20c0,1.105,0.895,2,2,2h11v-9h-3v-4h3V8.413c0-3.1,1.893-4.788,4.659-4.788 c1.325,0,2.463,0.099,2.795,0.143v3.24l-1.918,0.001c-1.504,0-1.795,0.715-1.795,1.763V11h4.44l-1,4h-3.44v9H22c1.105,0,2-0.895,2-2 V2C24,0.895,23.105,0,22,0z"
                  ></path>
                </svg>
              </a>
            </div>
          </div>
        </div>
      </footer>

      

      <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
      <script src="https://storage.ko-fi.com/cdn/scripts/overlay-widget.js"></script>
      <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>