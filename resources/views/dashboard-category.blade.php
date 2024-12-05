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
            <div class="pt-6">
                <div class="text-center">
                    <h1 class="text-2xl font-bold">Data Kategori</h1>
                </div>

                <div class="px-6 mb-3">
                    <button class="px-2 py-2 bg-green-500 rounded-md text-white text-lg shadow-md"
                        data-modal-target="modal_add" data-modal-toggle="modal_add" type="button">Tambah
                    </button>
                </div>

                @if (session('success'))
                    <div class="p-4 mb-4 mx-6 text-sm text-green-800 bg-green-50 dark:bg-gray-800 dark:text-green-400"
                        role="alert">
                        <span class="px-2 py-2 font-medium">{{ session('success') }}</span>
                    </div>
                @endif

                @if (session('failed'))
                    <div class="p-4 mb-4 mx-6 text-sm text-red-800 bg-red-50 dark:bg-gray-800 dark:text-red-400"
                        role="alert">
                        <span class="px-2 py-2 font-medium">{{ session('failed') }}</span>
                    </div>
                @endif
            </div>

            <!-- Table -->
            <div class="overflow-x-auto px-6 pb-3">
                <table class="min-w-full bg-white border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200 text-left">
                            <th class="px-6 py-3 border-b border-gray-300">Id</th>
                            <th class="px-6 py-3 border-b border-gray-300">Nama</th>
                            <th class="px-6 py-3 border-b border-gray-300">slug</th>
                            <th class="px-6 py-3 border-b border-gray-300">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr class="hover:bg-gray-100">
                                <td class="px-6 py-4 border-b border-gray-300">{{ $category->id }}</td>
                                <td class="px-6 py-4 border-b border-gray-300">{{ $category->name }}</td>
                                <td class="px-6 py-4 border-b border-gray-300">{{ $category->slug }}</td>
                                <td class="px-6 py-4 border-b border-gray-300">
                                    {{-- Button Edit --}}
                                    <button class="text-blue-500 hover:underline" title="Edit"><a
                                            href="/dashboard/category/{{ $category->id }}">
                                            <svg class="w-6
                                        h-6 text-blue-500 dark:text-white"
                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                                            </svg>
                                        </a>

                                    </button>
                                    {{-- Button Delete --}}
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:underline ml-4" title="Delete"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus item ini?')">
                                            <svg class="w-6 h-6 text-red-500 dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="py-3 grid place-items-center">
                {{ $categories->links() }}
            </div>

            {{-- Modal Add Category --}}
            <div id="modal_add" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-2xl max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div
                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 id="modal-title" class="text-xl font-semibold text-gray-900 dark:text-white">
                                Tambah Kategori
                            </h3>
                            <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-hide="modal_add">
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
                            <form id="modal-form" method="POST" action="{{ route('categories.store') }}">
                                @csrf <!-- Token CSRF untuk keamanan -->
                                <input type="hidden" id="category-id" name="id">
                                <div class="mb-5">
                                    <label for="nama"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                        Kategori</label>
                                    <input type="text" id="nama" name="name"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Isi nama kategori" required />
                                </div>
                                <div class="mb-5">
                                    <label for="slug"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Slug</label>
                                    <input type="text" id="slug" name="slug"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Isi slug" required />
                                </div>
                        </div>

                        <!-- Modal footer -->
                        <div
                            class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                            <button type="submit" id="modal-submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                Simpan
                            </button>
                            </form>
                            <button data-modal-hide="modal_add" type="button"
                                class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">
                                Batal
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>

</x-dashboard-layout>
