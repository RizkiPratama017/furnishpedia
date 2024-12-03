<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-image: url('{{ asset('img/rumabackground.svg') }}');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-800 bg-opacity-50">
    <div class="bg-white shadow-md rounded-md max-w-md w-full p-6 bg-opacity-90">
        <ul class="flex justify-center mb-6">
            <li>
                <a href="{{ route('login') }}" class="px-4 py-2 text-blue-600 font-semibold border-b-2 border-blue-600">Login</a>
            </li>
            <li class="ml-6">
                <a href="{{ route('register') }}" class="px-4 py-2 text-gray-600 font-semibold border-b-2 border-transparent hover:text-blue-600 hover:border-blue-600">Register</a>
            </li>
        </ul>

        <h2 class="text-xl font-semibold text-gray-700 mb-4">Login to Your Account</h2>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <label class="block text-sm text-gray-600 mb-1">Email</label>
            <input type="email" name="email" class="w-full px-4 py-2 mb-4 border rounded-md focus:outline-none focus:ring focus:ring-blue-300" placeholder="Enter your email" required>
            
            <label class="block text-sm text-gray-600 mb-1">Password</label>
            <input type="password" name="password" class="w-full px-4 py-2 mb-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-300" placeholder="Enter your password" required>
            
            <div class="flex justify-between items-center mb-4">
                <label class="flex items-center text-sm text-gray-600">
                    <input type="checkbox" id="remember" name="remember" class="mr-2"> Remember Me
                </label>
                <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:underline">Forgot Password?</a>
            </div>
            
            <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Login</button>
        </form>

        <div class="mt-4">
            <p class="text-sm text-gray-600 mb-2">Or login with</p>
            <div class="flex gap-4">
                <a href="{{ route('social.login', 'facebook') }}" class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Facebook</a>
                <a href="{{ route('social.login', 'github') }}" class="flex-1 px-4 py-2 bg-gray-900 text-white rounded-md hover:bg-gray-800">GitHub</a>
                <a href="{{ route('social.login', 'google') }}" class="flex-1 px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">Google</a>
            </div>
        </div>
    </div>
</body>
</html>
