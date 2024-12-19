<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <header>
        <x-navbar></x-navbar>
    </header>
    <div class="flex flex-1 min-h-full">
        <main class="flex-1 bg-white overflow-y-auto">
            <div class="container mx-auto my-5">
                <div class="flex justify-center">
                    <div class="w-full max-w-4xl">
                        <div class="bg-white shadow-md rounded-lg">
                            <div class="bg-gray-100 px-6 py-4 font-bold text-lg">
                                {{ __('Profile') }}
                            </div>

                            <div class="p-6">
                                @if (session('status'))
                                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 mb-4 rounded relative"
                                        role="alert">
                                        {{ session('status') }}
                                        <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3"
                                            aria-label="Close" onclick="this.parentElement.remove();">
                                            &times;
                                        </button>
                                    </div>
                                @endif

                                <!-- Display Profile Picture -->
                                <div class="flex justify-center mb-6">
                                    <div class="w-40 h-40">
                                        @if ($user->image)
                                            <img src="{{ filter_var($user->image, FILTER_VALIDATE_URL) ? $user->image : asset('storage/' . $user->image) }}"
                                                class="rounded-full w-full h-full object-cover shadow-md"
                                                alt="Profile Picture">
                                        @else
                                            <img src="{{ asset('img/default-profile.png') }}"
                                                class="rounded-full w-full h-full object-cover shadow-md"
                                                alt="Default Profile Picture">
                                        @endif
                                    </div>
                                </div>

                                <div class="w-2/3 mx-auto">
                                    <form method="POST" action="{{ route('profile.update', $user->id) }}"
                                        enctype="multipart/form-data" class="space-y-6 bg-white p-6 rounded-md">
                                        @method('PATCH')
                                        @csrf

                                        <div class="grid grid-cols-3 items-center gap-4">
                                            <label for="email" class="font-medium text-gray-700 text-right">
                                                {{ __('Email Address') }}
                                            </label>
                                            <div class="col-span-2">
                                                <input id="email" type="email" readonly
                                                    class="w-full border border-gray-300 rounded-md px-3 py-2 bg-gray-100 @error('email') border-red-500 @enderror"
                                                    name="email" value="{{ old('email', $user->email) }}" required>
                                            </div>
                                        </div>

                                        <div class="grid grid-cols-3 items-center gap-4">
                                            <label for="name" class="font-medium text-gray-700 text-right">
                                                {{ __('Name') }}
                                            </label>
                                            <div class="col-span-2">
                                                <input id="name" type="text"
                                                    class="w-full border border-gray-300 rounded-md px-3 py-2 @error('name') border-red-500 @enderror"
                                                    name="name" value="{{ $user->name }}" required>
                                            </div>
                                        </div>

                                        <div class="grid grid-cols-3 items-center gap-4">
                                            <label for="old_password" class="font-medium text-gray-700 text-right">
                                                {{ __('Old Password') }}
                                            </label>
                                            <div class="col-span-2">
                                                <input id="old_password" type="password"
                                                    class="w-full border border-gray-300 rounded-md px-3 py-2 @error('old_password') border-red-500 @enderror"
                                                    name="old_password">
                                            </div>
                                        </div>

                                        <div class="grid grid-cols-3 items-center gap-4">
                                            <label for="password" class="font-medium text-gray-700 text-right">
                                                {{ __('New Password') }}
                                            </label>
                                            <div class="col-span-2">
                                                <input id="password" type="password"
                                                    class="w-full border border-gray-300 rounded-md px-3 py-2 @error('password') border-red-500 @enderror"
                                                    name="password">
                                            </div>
                                        </div>

                                        <div class="grid grid-cols-3 items-center gap-4">
                                            <label for="password-confirm" class="font-medium text-gray-700 text-right">
                                                {{ __('Confirm Password') }}
                                            </label>
                                            <div class="col-span-2">
                                                <input id="password-confirm" type="password"
                                                    class="w-full border border-gray-300 rounded-md px-3 py-2"
                                                    name="password_confirmation">
                                            </div>
                                        </div>

                                        <div class="grid grid-cols-3 items-start gap-4">
                                            <label for="address" class="font-medium text-gray-700 text-right pt-2">
                                                {{ __('Change Address') }}
                                            </label>
                                            <div class="col-span-2">
                                                <textarea id="address" rows="3" name="address" class="w-full border border-gray-300 rounded-md px-3 py-2">{{ $user->address }}</textarea>

                                            </div>
                                        </div>

                                        {{-- API OSM maps --}}
                                        <div class="w-full max-w-4xl mt-8">
                                            <div id="osm-map" style="height: 300px;"></div>
                                        </div>
                                        

                                        <div class="grid grid-cols-3 items-center gap-4">
                                            <label for="image" class="font-medium text-gray-700 text-right">
                                                {{ __('Change Profile Image') }}
                                            </label>
                                            <div class="col-span-2">
                                                <input id="image" type="file"
                                                    class="w-full border border-gray-300 rounded-md" name="image">
                                            </div>
                                        </div>

                                        <div class="flex justify-end">
                                            <button type="submit"
                                                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                                {{ __('Update Profile') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Create Leaflet map.
        var map = L.map('osm-map').setView([0, 0], 2); // Default view (world)
    
        // Add OSM tile layer to the Leaflet map.
        L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
    
        // Marker variable
        var marker;
    
        // Function to update the map based on coordinates
        function updateMap(lat, lon) {
            // Update map view
            map.setView([lat, lon], 14);
    
            // Add or move marker
            if (marker) {
                marker.setLatLng([lat, lon]);
            } else {
                marker = L.marker([lat, lon]).addTo(map);
            }
        }
    
        // Function to fetch coordinates from an address
        function getCoordinates(address) {
            if (!address) return;
    
            fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(address)}`)
                .then(response => response.json())
                .then(data => {
                    if (data && data[0]) {
                        var lat = data[0].lat;
                        var lon = data[0].lon;
    
                        // Update map
                        updateMap(lat, lon);
                    }
                })
                .catch(error => {
                    console.error('Error fetching coordinates:', error);
                    // Do nothing on error
                });
        }
    
        // Event listener for address input
        document.getElementById('address').addEventListener('input', function (e) {
            var address = e.target.value;
            getCoordinates(address);
        });
    
        // Reverse geocoding: Get address from coordinates
        map.on('click', function (e) {
            var lat = e.latlng.lat;
            var lon = e.latlng.lng;
    
            fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lon}`)
                .then(response => response.json())
                .then(data => {
                    if (data && data.display_name) {
                        // Update address field
                        document.getElementById('address').value = data.display_name;
    
                        // Update marker
                        updateMap(lat, lon);
                    }
                })
                .catch(error => {
                    console.error('Error fetching address:', error);
                    // Do nothing on error
                });
        });
    </script>
    
    
    
</x-layout>
