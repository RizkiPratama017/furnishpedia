@if ($categories->isEmpty())
    <tr>
        <td colspan="8" class="text-center py-4 text-gray-500">Data tidak ditemukan</td>
    </tr>
@else
    @foreach ($categories as $category)
        <tr class="hover:bg-gray-100 text-gray-700">
            <td class="px-4 py-2 border">{{ $category->id }}</td>
            <td class="px-4 py-2 border">{{ $category->name }}</td>
            <td class="px-4 py-2 border">{{ $category->slug }}</td>
            <td class="px-4 py-2 border text-center">
                {{-- Button Edit --}}
                <a href="/dashboard/category/{{ $category->id }}" class="text-blue-500 hover:text-blue-700 mx-2">
                    Edit
                </a>

                {{-- Button Delete --}}
                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline">
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
@endif
