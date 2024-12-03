<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
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
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Reset Password</h2>
        <p class="text-sm text-gray-600 mb-4">Enter your new password below.</p>

        <form action="/reset-password" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ request()->route('token') }}">

            <label class="block text-sm text-gray-600 mb-1">Email</label>
            <input type="email" name="email" class="w-full px-4 py-2 mb-4 border rounded-md focus:outline-none focus:ring focus:ring-blue-300" placeholder="Enter your email" required>
            
            <label class="block text-sm text-gray-600 mb-1">New Password</label>
            <input type="password" name="password" class="w-full px-4 py-2 mb-4 border rounded-md focus:outline-none focus:ring focus:ring-blue-300" placeholder="Enter new password" required>
            
            <label class="block text-sm text-gray-600 mb-1">Confirm Password</label>
            <input type="password" name="password_confirmation" class="w-full px-4 py-2 mb-4 border rounded-md focus:outline-none focus:ring focus:ring-blue-300" placeholder="Confirm your new password" required>
            
            <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Reset Password</button>
        </form>

        <div class="mt-4 text-center">
            <a href="/login" class="text-sm text-blue-600 hover:underline">Back to Login</a>
        </div>
    </div>
</body>
</html>
