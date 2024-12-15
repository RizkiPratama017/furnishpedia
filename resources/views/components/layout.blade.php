<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <!-- Flowbite CSS -->
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <!-- Glide.js CSS -->
    <link rel="stylesheet" href="node_modules/@glidejs/glide/dist/css/glide.core.min.css">

    <style>
        #results {
            max-height: 300px;
            overflow-y: auto;
            position: absolute;
            z-index: 1000;
            background-color: white;
            width: 100%;
        }
    </style>
</head>

<body class="h-full m-0">

    <div class="h-screen">

        <main class="h-screen">
            {{ $slot }}
        </main>
    </div>

    <!-- Flowbite JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <!-- Glide.js JavaScript -->
    <script src="node_modules/@glidejs/glide/dist/glide.min.js"></script>
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>

</html>
