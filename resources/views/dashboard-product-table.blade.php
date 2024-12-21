@if ($products->isEmpty())
    <tr>
        <td colspan="8" class="text-center py-4 text-gray-500">Data tidak ditemukan</td>
    </tr>
@else
    @foreach ($products as $product)
        <tr class="hover:bg-gray-100 text-gray-700">
            <td class="px-4 py-2 border">{{ $product->id }}</td>
            <td class="px-4 py-2 border">
                <img src="{{ $product->image ? (filter_var($product->image, FILTER_VALIDATE_URL) ? $product->image : asset('storage/' . $product->image)) : asset('img/default-picture.png') }}"
                    alt="Gambar Produk" class="h-10 w-10 object-cover rounded-md">
            </td>
            <td class="px-4 py-2 border">{{ $product->name }}</td>
            <td class="px-4 py-2 border">{{ Str::limit($product->description, 20) }}</td>
            <td class="px-4 py-2 border">Rp{{ number_format($product->price, 0, ',', '.') }}</td>
            <td class="px-4 py-2 border">{{ $product->stock }}</td>
            <td class="px-4 py-2 border">{{ $product->category->name ?? 'Tidak ada' }}</td>
            <td class="px-4 py-2 border text-center">
                {{-- Button Edit --}}
                <a href="/dashboard/product/{{ $product->id }}" class="text-blue-500 hover:text-blue-700 mx-2">Edit</a>

                {{-- Button Delete --}}
                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:text-red-700 mx-2"
                        onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</button>
                </form>
            </td>
        </tr>
    @endforeach
@endif
