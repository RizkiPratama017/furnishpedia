<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="flex items-center justify-center min-h-screen bg-gray-50 mt-10">
        <div class="flex w-full max-w-4xl bg-white rounded-lg shadow-lg">
            <!-- Kiri -->
            <div class="flex flex-col items-center justify-center w-1/2 p-8 bg-blue-50">
                <h1 class="text-2xl font-bold text-gray-800 mb-7">Mulai berjualan di Furnishpedia!</h1>
                <img src="https://via.placeholder.com/300" alt="Illustration" class="mb-4">
            </div>

            {{-- kanan --}}
            <div class="flex flex-col w-1/2 p-8 space-y-6">
                <h2 class="text-lg font-medium text-gray-800 mb-4">Silahkan Verifikasi Dulu Akun Anda</h2>
                <div class="space-y-4">
                    <div class="border p-4 rounded-lg">
                        <h3 class="font-semibold text-gray-800">Silahkan Klik Dibawah Ini</h3>
                        <a href="/profil"
                            class="mt-3 inline-block px-6 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400">
                            Verifikasi Akun
                        </a>
                    </div>
                </div>

                <div class="flex justify-between items-center mt-6">
                    <p class="text-sm text-gray-600">Status Verifikasi: <span class="font-semibold text-red-600">Belum
                            Verifikasi</span></p>
                    <button class="px-6 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700">Refresh
                        Status</button>
                </div>
            </div>
        </div>
    </div>
</x-layout>
