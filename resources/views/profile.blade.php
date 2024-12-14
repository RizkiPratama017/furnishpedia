<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <header>
        <x-navbar></x-navbar>
    </header>
    <div class="flex flex-1 min-h-full">
        <main class="flex-1 bg-white overflow-y-auto">
            <div class="container mx-auto mt-5">
                <div class="flex justify-center">
                    <div class="w-full max-w-4xl">
                        <div class="bg-white shadow-md rounded-lg">
                            <div class="bg-gray-100 px-6 py-4 font-bold text-lg">
                                {{ __('Profile') }}
                            </div>

                            <div class="p-5">

                                @if (session('status'))
                                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 mb-3 rounded relative"
                                        role="alert">
                                        {{ session('status') }}
                                        <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3"
                                            aria-label="Close" onclick="this.parentElement.remove();">
                                            &times;
                                        </button>
                                    </div>
                                @endif

                                <div class="flex">
                                    <div class="w-1/3">
                                        @if ($user->image)
                                            <img src="{{ filter_var($user->image, FILTER_VALIDATE_URL) ? $user->image : asset('storage/' . $user->image) }}"
                                                class="rounded mx-auto w-32 h-32 object-cover"
                                                alt="{{ $user->image }}">
                                        @else
                                            <img src="{{ asset('img/r.jpg') }}"
                                                class="rounded mx-auto w-32 h-32 object-cover">
                                        @endif
                                    </div>
                                    <div class="w-2/3">
                                        <form method="POST" action="{{ route('profile.update', $user->id) }}"
                                            enctype="multipart/form-data" class="space-y-4">
                                            @method('PATCH')
                                            @csrf

                                            <div class="flex items-center">
                                                <label for="email"
                                                    class="w-1/3 text-right mr-4 font-medium">{{ __('Email Address') }}</label>
                                                <input id="email" type="email" readonly
                                                    class="w-2/3 border rounded-md px-3 py-2 @error('email') border-red-500 @enderror"
                                                    name="email" value="{{ old('email', $user->email) }}" required>
                                            </div>

                                            <div class="flex items-center">
                                                <label for="name"
                                                    class="w-1/3 text-right mr-4 font-medium">{{ __('Name') }}</label>
                                                <input id="name" type="text"
                                                    class="w-2/3 border rounded-md px-3 py-2 @error('name') border-red-500 @enderror"
                                                    name="name" value="{{ $user->name }}" required>
                                            </div>

                                            <div class="flex items-center">
                                                <label for="old_password"
                                                    class="w-1/3 text-right mr-4 font-medium">{{ __('Old Password') }}</label>
                                                <input id="old_password" type="password"
                                                    class="w-2/3 border rounded-md px-3 py-2 @error('old_password') border-red-500 @enderror"
                                                    name="old_password">
                                            </div>

                                            <div class="flex items-center">
                                                <label for="password"
                                                    class="w-1/3 text-right mr-4 font-medium">{{ __('New Password') }}</label>
                                                <input id="password" type="password"
                                                    class="w-2/3 border rounded-md px-3 py-2 @error('password') border-red-500 @enderror"
                                                    name="password">
                                            </div>

                                            <div class="flex items-center">
                                                <label for="password-confirm"
                                                    class="w-1/3 text-right mr-4 font-medium">{{ __('Confirm Password') }}</label>
                                                <input id="password-confirm" type="password"
                                                    class="w-2/3 border rounded-md px-3 py-2"
                                                    name="password_confirmation">
                                            </div>

                                            <div class="flex items-center">
                                                <label for="address"
                                                    class="w-1/3 text-right mr-4 font-medium">{{ __('Change Address') }}</label>
                                                <textarea id="address" rows="3" name="address" class="w-2/3 border rounded-md px-3">{{ $user->address }}</textarea>
                                            </div>

                                            <div class="flex items-center">
                                                <label for="image"
                                                    class="w-1/3 text-right mr-4 font-medium">{{ __('Change Profile image') }}</label>
                                                <input id="image" type="file"
                                                    class="w-2/3 border rounded-md px-3" name="image">
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
            </div>

        </main>
    </div>

</x-layout>
