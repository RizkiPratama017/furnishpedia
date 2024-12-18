<x-dashboard-layout>

    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="flex flex-1 min-h-full">
        {{-- Sidebar --}}
        <x-sidebar></x-sidebar>

        {{-- Main --}}
        <main class="flex-1 overflow-y-auto">

            {{-- Form --}}
            <div class="flex-1 bg-white overflow-y-auto m-5 shadow-lg rounded-lg p-6">
                <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Produk</h1>
                <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="product-id" name="id" value="{{ $product->id }}">

                    {{-- Nama Produk --}}
                    <div class="mb-5">
                        <label for="name" class="block text-gray-700 mb-2 font-medium">Nama Produk</label>
                        <input type="text" id="name" name="name" value="{{ $product->name }}"
                            class="w-full p-3 border border-gray-300 rounded-md focus:ring focus:ring-blue-300 focus:border-blue-500"
                            placeholder="Nama Produk" required />
                    </div>

                    {{-- Deskripsi --}}
                    <div class="mb-5">
                        <label for="description" class="block text-gray-700 mb-2 font-medium">Deskripsi</label>
                        <input type="text" id="description" name="description" value="{{ $product->description }}"
                            class="w-full p-3 border border-gray-300 rounded-md focus:ring focus:ring-blue-300 focus:border-blue-500"
                            placeholder="Deskripsi Produk" required />
                    </div>

                    {{-- Harga --}}
                    <div class="mb-5">
                        <label for="price" class="block text-gray-700 mb-2 font-medium">Harga</label>
                        <input type="number" id="price" name="price" value="{{ $product->price }}"
                            class="w-full p-3 border border-gray-300 rounded-md focus:ring focus:ring-blue-300 focus:border-blue-500"
                            placeholder="Harga Produk" required />
                    </div>

                    {{-- Stok --}}
                    <div class="mb-5">
                        <label for="stock" class="block text-gray-700 mb-2 font-medium">Stok</label>
                        <input type="number" id="stock" name="stock" value="{{ $product->stock }}"
                            class="w-full p-3 border border-gray-300 rounded-md focus:ring focus:ring-blue-300 focus:border-blue-500"
                            placeholder="Stok Produk" required />
                    </div>

                    {{-- Kategori --}}
                    <div class="mb-5">
                        <label for="category_id" class="block text-gray-700 mb-2 font-medium">Kategori</label>
                        <select id="category_id" name="category_id"
                            class="w-full p-3 border border-gray-300 rounded-md focus:ring focus:ring-blue-300 focus:border-blue-500"
                            required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Gambar --}}
                    <div class="mb-5">
                        <label for="image" class="block mb-2 text-gray-700 font-medium">Gambar Produk</label>
                        @if ($product->image)
                            <div class="mb-3">
                                <img src="{{ filter_var($product->image, FILTER_VALIDATE_URL) ? $product->image : asset('storage/' . $product->image) }}"
                                    class="h-20 object-cover" alt="Product Image" />
                            </div>
                        @endif
                        <input type="file" id="image" name="image"
                            class="w-full text-sm text-gray-900 border border-gray-300 rounded-md cursor-pointer"
                            accept="image/*">
                    </div>

                    {{-- Tombol --}}
                    <div class="flex justify-end space-x-3">
                        <a href="/dashboard/category"
                            class="px-5 py-2 text-gray-600 border border-gray-300 rounded-md hover:bg-gray-100 transition">
                            Kembali
                        </a>
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
