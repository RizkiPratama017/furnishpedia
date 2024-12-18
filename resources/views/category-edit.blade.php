<x-dashboard-layout>

    <x-slot:title>{{ $title }}</x-slot:title>


    <div class="flex flex-1 h-screen">
        {{-- Sidebar --}}
        <x-sidebar></x-sidebar>

        {{-- Main --}}
        <main class="flex-1 overflow-y-auto">

            {{-- form --}}
            <div class="flex-1 bg-white overflow-y-auto m-5 shadow-lg rounded-lg p-6">
                <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit</h1>
                <form method="POST" action="{{ route('categories.update', $category->id) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="category-id" name="id" value="{{ $category->id }}">
                    <div class="mb-6">
                        <label for="name" class="block text-gray-700 mb-2 font-medium">Nama Kategori</label>
                        <input type="text" id="name" name="name" value="{{ $category->name }}"
                            class="w-full p-3 border
                            border-gray-300 rounded-md focus:ring focus:ring-blue-300 focus:border-blue-500"
                            placeholder="Nama kategori" required />
                    </div>
                    <div class="mb-6">
                        <label for="slug" class="block text-gray-700 mb-2 font-medium">Slug</label>
                        <input type="text" id="slug" name="slug" value="{{ $category->slug }}"
                            class="w-full p-3 border
                            border-gray-300 rounded-md focus:ring focus:ring-blue-300 focus:border-blue-500"
                            placeholder="Slug kategori" required />
                    </div>

                    {{-- Buttons --}}
                    <div class="flex justify-end space-x-3">
                        <button type="button"
                            class="px-5 py-2 text-gray-600 border border-gray-300 rounded-md hover:bg-gray-100 transition">
                            <a href="/dashboard/category">Kembali</a>
                        </button>
                        <button type="submit"
                            class="px-5 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>

        </main>
    </div>

</x-dashboard-layout>
