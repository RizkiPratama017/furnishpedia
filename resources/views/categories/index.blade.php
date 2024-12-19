<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <header>
        <x-navbar></x-navbar>
    </header>

    <div class="container mx-auto py-10 px-4">
        <h1 class="text-3xl font-bold text-center mb-8">Kategori</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($categories as $category)
                <a href="{{ route('categories.show', $category->slug) }}" class="block group">
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden transform transition hover:scale-105">
                        <div class="p-6">
                            <h2 class="text-xl font-semibold text-gray-800 group-hover:text-green-600 transition">
                                {{ $category->name }}
                            </h2>
                        </div>

                    </div>
                </a>
            @endforeach
        </div>
    </div>

</x-layout>
