<x-dashboard-layout>

    <x-slot:title>{{ $title }}</x-slot:title>


    <div class="flex flex-1 min-h-full">
        {{-- Sidebar --}}
        <x-sidebar></x-sidebar>

        {{-- Main --}}
        <main class="flex-1 bg-white overflow-y-auto">
            {{-- Navbar --}}
            <x-dashboard-navbar></x-dashboard-navbar>

            {{-- Title & Add Button --}}
            <div class="grid grid-flow-col px-6 pt-6">
                <div class="col-span-full">
                    <h1 class="text-2xl font-bold mb-6">Data Produk</h1>
                </div>

                <div class="mb-5 col-end-1" data-modal-target="default-modal" data-modal-toggle="default-modal"
                    type="button">
                    <a href="#" class="px-3 py-3 bg-green-400 rounded-md text-white text-lg shadow-md">Tambah</a>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto px-6 pb-3">
                <table class="min-w-full bg-white border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200 text-left">
                            <th class="px-6 py-3 border-b border-gray-300">No</th>
                            <th class="px-6 py-3 border-b border-gray-300">Gambar</th>
                            <th class="px-6 py-3 border-b border-gray-300">Nama</th>
                            <th class="px-6 py-3 border-b border-gray-300">Deskripsi</th>
                            <th class="px-6 py-3 border-b border-gray-300">Harga</th>
                            <th class="px-6 py-3 border-b border-gray-300">Stok</th>
                            <th class="px-6 py-3 border-b border-gray-300">Kategori</th>
                            <th class="px-6 py-3 border-b border-gray-300">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr class="hover:bg-gray-100">
                                <td class="px-6 py-4 border-b border-gray-300">{{ $product->id }}</td>
                                <td class="px-6 py-4 border-b border-gray-300"><img src="img/r.jpg" class="h-8"
                                        alt="Ruma.id Logo" /></td>
                                <td class="px-6 py-4 border-b border-gray-300">{{ $product->name }}</td>
                                <td class="px-6 py-4 border-b border-gray-300">
                                    {{ Str::limit($product->description, 20) }}</td>
                                <td class="px-6 py-4 border-b border-gray-300">{{ $product->price }}</td>
                                <td class="px-6 py-4 border-b border-gray-300">{{ $product->stock }}</td>
                                <td class="px-6 py-4 border-b border-gray-300">{{ $product->category_id }}</td>
                                <td class="px-6 py-4 border-b border-gray-300">
                                    <button class="text-blue-500 hover:underline">Ubah</button>
                                    <button class="text-red-500 hover:underline ml-4">Hapus</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="py-3 grid place-items-center">
                <x-pagination></x-pagination>
            </div>

            {{-- Modal Add Product --}}
            <div id="default-modal" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-2xl max-h-full">

                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">

                        <!-- Modal header -->
                        <div
                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Tambah Produk
                            </h3>
                            <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-hide="default-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Tutup</span>
                            </button>
                        </div>

                        <!-- Modal body -->
                        <div class="p-4 md:p-5 space-y-4">
                            <form class="max-w mx-auto">
                                <div class="mb-5">
                                    <label for="namaproduk"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                        Produk</label>
                                    <input type="text" id="namaproduk"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Isi nama produk" required />
                                </div>
                                <div class="mb-5">
                                    <label for="deskripsi"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                                    <input type="text" id="deskripsi"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Isi deskripsi" required />
                                </div>
                                <div class="mb-5">
                                    <label for="harga"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga</label>
                                    <input type="number" id="harga"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Isi harga" required />
                                </div>
                                <div class="mb-5">
                                    <label for="stok"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stok</label>
                                    <input type="number" id="stok"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Isi stok" required />
                                </div>

                                {{-- Select Option Category --}}
                                <div>
                                    <label for="countries"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori</label>
                                    <select id="countries"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        <option selected>Pilih Kategori</option>
                                        <option value="US">Laptop</option>
                                        <option value="CA">Smartphone</option>
                                        <option value="FR">Tablet</option>
                                        <option value="DE">Desktop</option>
                                    </select>
                                </div>

                            </form>
                        </div>

                        <!-- Modal footer -->
                        <div
                            class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                            <button data-modal-hide="default-modal" type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Simpan</button>
                            <button data-modal-hide="default-modal" type="button"
                                class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Batal</button>
                        </div>

                    </div>
                </div>
            </div>

        </main>
    </div>

</x-dashboard-layout>
