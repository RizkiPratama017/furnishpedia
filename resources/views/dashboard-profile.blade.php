<x-dashboard-layout>

    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="flex flex-1 min-h-full">
        {{-- Sidebar --}}
        <x-sidebar></x-sidebar>

        {{-- Main --}}
        <main class="flex-1 bg-white overflow-y-auto">

            {{-- Modal Edit Product --}}
            <div class="relative p-4 w-full max-w-2xl max-h-full">

                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">

                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Edit Profile
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                            <a href="/dashboard/">
                                <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                            </a>
                            <span class="sr-only">Tutup</span>
                        </button>
                    </div>

                    <!-- Modal body -->
                    <div class="p-4 md:p-5 space-y-4">
                        <form class="max-w mx-auto" method="POST" action="" enctype="multipart/form-data">
                            @csrf <!-- Token CSRF untuk keamanan -->
                            @method('PUT')
                            <input type="hidden" id="id" name="id" value="">
                            <div class="mb-5">
                                <label for="email"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                <input type="text" id="email" name="email" value="" disabled
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="email@example.com" required />
                            </div>
                            <div class="mb-5">
                                <label for="name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                <input type="text" id="name" name="name" value=""
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="John Doe" required />
                            </div>
                            <div class="mb-5">
                                <label for="password"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                                <input type="password" id="password" name="password" value=""
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="******" required />
                            </div>
                            <div class="mb-5">
                                <label for="address"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
                                <textarea id="address" rows="4" name="address" value="" required
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Jl. Example No. 10C"></textarea>
                            </div>

                            <div class="mb-5">
                                <label for="gambar"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Gambar Profile
                                </label>
                                {{-- @if ($user->image)
                                    <div class="mb-3">
                                        <img src="{{ filter_var($user->image, FILTER_VALIDATE_URL) ? $user->image : asset('storage/' . $product->image) }}"
                                            class="h-8" alt="Product Image" />
                                    </div>
                                @endif --}}
                                <input type="file" id="gambar" name="image"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                    accept="image/*">
                            </div>

                            <!-- Submit Button -->
                            <div
                                class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                <button type="submit" id="modal-submit"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Simpan</button>
                                <button type="button"
                                    class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">
                                    <a href="/dashboard/product">Kembali</a>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </main>
    </div>

</x-dashboard-layout>
