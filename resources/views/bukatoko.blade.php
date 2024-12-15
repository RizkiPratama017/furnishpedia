<x-layout>
    <x-slot:title>
        {{-- {{ $title }} --}}
        title
    </x-slot:title>
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
                        @if ($errors->has('otp'))
                        <div class="text-red-500">{{ $errors->first('otp') }}</div>
                    @endif
                    
                    <form id="verify-otp-form" method="POST" action="{{ route('verify.otp') }}">
                        @csrf
                        <label for="otp">Masukkan Kode OTP:</label>
                        <input type="text" name="otp" id="otp" required minlength="6" maxlength="6">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Verifikasi</button>
                    </form>

                    {{-- <form  method="POST" action="/send-otp">
                        
                <button type="submit">Send OTP</button>
                    </form> --}}

                    <form action="{{ route('send.otp')}}" method="post">
                        @csrf
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                            Send OTP
                        </button>
                    </form>
                    </div>
                </div>

                <div class="flex justify-between items-center mt-6">
                    <p class="text-sm text-gray-600">Status Verifikasi:

                    @if(Auth::user()->is_verified)
                        <span class="font-semibold text-blue-600"> Sudah Aktif</span>
                    @else
                        <span class="font-semibold text-red-600"> belum Aktif</span>
                    @endif
                    </p>
                    
                    <a href="/">Kembali</a>
                    {{-- <button class="px-6 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700">Refresh
                        Status</button> --}}
                </div>
               
            
            </div>
        </div>
    </div>

    <script>
        document.getElementById('send-otp-form').addEventListener('submit', async function(e) {
    e.preventDefault();
    let response = await fetch(this.action, {
        method: 'POST',        
        headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
    });
    let data = await response.json();
    alert(data.message || data.error);
});

document.getElementById('verify-otp-form').addEventListener('submit', async function(e) {
    e.preventDefault();
    let formData = new FormData(this);
    let response = await fetch(this.action, {
        method: 'POST',
        body: formData,
        headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
    });
    let data = await response.json();
    alert(data.message || data.error);
});

    </script>
    
</x-layout>
