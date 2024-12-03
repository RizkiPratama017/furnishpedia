<x-dashboard-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="flex flex-1 min-h-full">
        {{-- Sidebar --}}
        <x-sidebar></x-sidebar>

        {{-- Main --}}
        <main class="flex-1 bg-white overflow-y-auto">
            {{-- Navbar --}}
            <div>
                <x-dashboard-navbar></x-dashboard-navbar>
            </div>
        </main>
    </div>
</x-dashboard-layout>
