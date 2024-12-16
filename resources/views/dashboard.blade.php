<x-dashboard-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="flex flex-1 min-h-full">
        {{-- Sidebar --}}
        <x-sidebar></x-sidebar>

        {{-- Main --}}
        <main class="flex-1 bg-white overflow-y-auto">

            <div class="p-6 grid grid-cols-3 gap-6">
                <!-- Cards -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <h2 class="text-gray-500">Total Revenue</h2>
                    <p class="text-2xl font-bold">IDR 10,215,845</p>
                    <p class="text-green-500 text-sm mt-2">↑ 33.87% from last week</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <h2 class="text-gray-500">Total Items Sold</h2>
                    <p class="text-2xl font-bold">128,980</p>
                    <p class="text-red-500 text-sm mt-2">↓ 33.87% from last week</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <h2 class="text-gray-500">Total Visitor</h2>
                    <p class="text-2xl font-bold">2,905,897</p>
                    <p class="text-green-500 text-sm mt-2">↑ 33.87% from last week</p>
                </div>

                <!-- Chart and Table -->
                <div class="col-span-2 bg-white p-6 rounded-lg shadow">
                    <h2 class="text-xl font-bold mb-4">Report Statistics</h2>
                    <div class="h-96 bg-gray-200 flex items-center justify-center rounded">
                        <!-- Placeholder for Chart -->

                        <span class="text-gray-400">[Chart Placeholder]</span>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow">
                    <h2 class="text-xl font-bold mb-4">Latest Transactions</h2>
                    <div class="flow-root">
                        <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                            <li class="py-3 sm:py-4">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <img class="w-8 h-8 rounded-full" src="{{ asset('/img/r.jpg') }}"
                                            alt="Neil image">
                                    </div>
                                    <div class="flex-1 min-w-0 ms-4">
                                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                            Neil Sims
                                        </p>
                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                            email@windster.com
                                        </p>
                                    </div>
                                    <div
                                        class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                        $320
                                    </div>
                                </div>
                            </li>
                            <li class="py-3 sm:py-4">
                                <div class="flex items-center ">
                                    <div class="flex-shrink-0">
                                        <img class="w-8 h-8 rounded-full" src="{{ asset('/img/r.jpg') }}"
                                            alt="Bonnie image">
                                    </div>
                                    <div class="flex-1 min-w-0 ms-4">
                                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                            Bonnie Green
                                        </p>
                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                            email@windster.com
                                        </p>
                                    </div>
                                    <div
                                        class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                        $3467
                                    </div>
                                </div>
                            </li>
                            <li class="py-3 sm:py-4">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <img class="w-8 h-8 rounded-full" src="{{ asset('/img/r.jpg') }}"
                                            alt="Michael image">
                                    </div>
                                    <div class="flex-1 min-w-0 ms-4">
                                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                            Michael Gough
                                        </p>
                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                            email@windster.com
                                        </p>
                                    </div>
                                    <div
                                        class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                        $67
                                    </div>
                                </div>
                            </li>
                            <li class="py-3 sm:py-4">
                                <div class="flex items-center ">
                                    <div class="flex-shrink-0">
                                        <img class="w-8 h-8 rounded-full" src="{{ asset('/img/r.jpg') }}"
                                            alt="Lana image">
                                    </div>
                                    <div class="flex-1 min-w-0 ms-4">
                                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                            Lana Byrd
                                        </p>
                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                            email@windster.com
                                        </p>
                                    </div>
                                    <div
                                        class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                        $367
                                    </div>
                                </div>
                            </li>
                            <li class="pt-3 pb-0 sm:pt-4">
                                <div class="flex items-center ">
                                    <div class="flex-shrink-0">
                                        <img class="w-8 h-8 rounded-full" src="{{ asset('/img/r.jpg') }}"
                                            alt="Thomas image">
                                    </div>
                                    <div class="flex-1 min-w-0 ms-4">
                                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                            Thomes Lean
                                        </p>
                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                            email@windster.com
                                        </p>
                                    </div>
                                    <div
                                        class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                        $2367
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>

        </main>
    </div>
</x-dashboard-layout>
