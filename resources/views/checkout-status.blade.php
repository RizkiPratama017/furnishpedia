<x-dashboard-layout>
    <x-slot:title>Checkout</x-slot:title>
    <div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">
        <div class="max-w-lg mx-auto bg-white shadow-md rounded-lg p-6">
            <div class="text-center">
                @if ($status == 'success')
                    <svg class="w-16 h-16 text-green-400 mx-auto mb-4" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm13.707-1.293a1 1 0 0 0-1.414-1.414L11 12.586l-1.793-1.793a1 1 0 0 0-1.414 1.414l2.5 2.5a1 1 0 0 0 1.414 0l4-4Z"
                            clip-rule="evenodd" />
                    </svg>
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Pembayaran Berhasil</h2>
                    <p class="text-gray-600 mb-6">Terima kasih atas pembelian Anda. Pesanan Anda sedang diproses.</p>
                @elseif ($status == 'pending')
                    <svg class="w-16 h-16 text-yellow-400 mx-auto mb-4" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"
                            clip-rule="evenodd" />
                    </svg>

                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Pembayaran Menunggu</h2>
                    <p class="text-gray-600 mb-6">Pembayaran Anda sedang diproses. Silakan tunggu konfirmasi lebih
                        lanjut.</p>
                @elseif ($status == 'failed')
                    <svg class="w-16 h-16 text-red-500 mx-auto mb-4" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm7.707-3.707a1 1 0 0 0-1.414 1.414L10.586 12l-2.293 2.293a1 1 0 1 0 1.414 1.414L12 13.414l2.293 2.293a1 1 0 0 0 1.414-1.414L13.414 12l2.293-2.293a1 1 0 0 0-1.414-1.414L12 10.586 9.707 8.293Z"
                            clip-rule="evenodd" />
                    </svg>

                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Pembayaran Gagal</h2>
                    <p class="text-gray-600 mb-6">Pembayaran Anda telah gagal. Silakan mencoba pembayaran lagi.</p>
                @endif
                <a href="/" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition">
                    Kembali ke Halaman Utama
                </a>
            </div>
        </div>
    </div>
</x-dashboard-layout>
