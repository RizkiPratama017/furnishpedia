<x-dashboard-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="flex min-h-screen">
        {{-- Sidebar --}}
        <x-sidebar></x-sidebar>

        {{-- Main  --}}
        <main class="flex-1 bg-white overflow-y-auto m-5 shadow-md rounded">
            <div class="container mx-auto px-4 py-6">
                {{-- Header --}}
                <div class="flex flex-wrap justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold text-gray-800">Kategori</h1>
                    <button class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 transition"
                        data-modal-target="modal_add" data-modal-toggle="modal_add" type="button">
                        Tambah
                    </button>
                </div>

                {{-- Alert --}}
                <div>
                    @if (session('success'))
                        <div class="p-4 mb-4 text-sm text-green-800 bg-green-50 dark:bg-gray-800 dark:text-green-400"
                            role="alert">
                            <span class="px-2 py-2 font-medium">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if (session('failed'))
                        <div class="p-4 mb-4 text-sm text-red-800 bg-red-50 dark:bg-gray-800 dark:text-red-400"
                            role="alert">
                            <span class="px-2 py-2 font-medium">{{ session('failed') }}</span>
                        </div>
                    @endif
                </div>

                {{-- Search Bar --}}
                <div class="mb-6">
                    <form method="GET" action="{{ route('categories.search') }}" class="w-full md:w-1/2 mx-auto">
                        <div class="relative">
                            <input type="search" name="search"
                                class="w-full p-3 pl-10 text-gray-700 border rounded-md focus:outline-none focus:ring focus:ring-blue-300"
                                placeholder="Cari kategori..." value="{{ request('search') }}" required />
                            <span class="absolute left-3 top-3 text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-4.35-4.35M17 10.5a6.5 6.5 0 11-13 0 6.5 6.5 0 0113 0z" />
                                </svg>
                            </span>
                        </div>
                    </form>
                </div>

                {{-- Table --}}
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                        <thead class="bg-gray-800 text-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left border">Id</th>
                                <th class="px-4 py-2 text-left border">Nama</th>
                                <th class="px-4 py-2 text-left border">Slug</th>
                                <th class="px-4 py-2 text-center border">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr class="hover:bg-gray-100 text-gray-700">
                                    <td class="px-4 py-2 border">{{ $category->id }}</td>
                                    <td class="px-4 py-2 border">{{ $category->name }}</td>
                                    <td class="px-4 py-2 border">{{ $category->slug }}</td>
                                    <td class="px-4 py-2 border text-center">
                                        {{-- Button Edit --}}
                                        <a href="/dashboard/category/{{ $category->id }}"
                                            class="text-blue-500 hover:text-blue-700 mx-2">
                                            Edit
                                        </a>

                                        {{-- Button Delete --}}
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700 mx-2"
                                                onclick="return confirm('Yakin ingin menghapus kategori ini?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="mt-6 flex justify-center">
                    {{ $categories->links() }}
                </div>

                {{-- Modal --}}
                <div id="modal_add" tabindex="-1" aria-hidden="true"
                    class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
                    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
                        {{-- Header --}}
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-lg font-bold">Tambah Kategori</h2>
                            <button data-modal-hide="modal_add" class="text-gray-500 hover:text-gray-700">
                                ✖
                            </button>
                        </div>

                        {{-- Form --}}
                        <form method="POST" action="{{ route('categories.store') }}">
                            @csrf
                            <div class="mb-4">
                                <label for="name" class="block text-gray-700 mb-2">Nama Kategori</label>
                                <input type="text" id="name" name="name"
                                    class="w-full p-2 border rounded-md focus:ring focus:ring-blue-300"
                                    placeholder="Nama kategori" required />
                            </div>
                            <div class="mb-4">
                                <label for="slug" class="block text-gray-700 mb-2">Slug</label>
                                <input type="text" id="slug" name="slug"
                                    class="w-full p-2 border rounded-md focus:ring focus:ring-blue-300"
                                    placeholder="Slug kategori" required />
                            </div>

                            {{-- Buttons --}}
                            <div class="flex justify-end">
                                <button type="button" data-modal-hide="modal_add"
                                    class="mr-2 px-4 py-2 text-gray-600 border rounded-md hover:bg-gray-200">
                                    Batal
                                </button>
                                <button type="submit"
                                    class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>

    @vite('resources/js/category.js')
</x-dashboard-layout>
