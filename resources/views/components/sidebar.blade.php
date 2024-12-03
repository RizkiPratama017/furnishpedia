<aside class="bg-gray-800 text-white w-64 p-4 flex flex-col">
    <h2 class="text-xl font-semibold mb-4 mx-2 my-2">Penjual</h2>
    <ul class="space-y-2">
        <li><a href="/" class="block px-2 py-1 hover:bg-gray-700 rounded">Dashboard</a></li>
        <li><a href="/dashboard-category" class="block px-2 py-1 hover:bg-gray-700 rounded">Kategori</a></li>
        <li><a href="/dashboard-product" class="block px-2 py-1 hover:bg-gray-700 rounded">Produk</a></li>
        <li><a href="#" class="block px-2 py-1 hover:bg-gray-700 rounded">Profile</a></li>
        {{-- <li><a href="#" class="block px-2 py-1 hover:bg-gray-700 rounded">Logout</a></li> --}}
        <form action="/logout" method="POST">
            @csrf
                <button type="submit" class="block px-2 py-1 hover:bg-gray-700 rounded"> Sign out </button>
        </form>
    </ul>
</aside>
