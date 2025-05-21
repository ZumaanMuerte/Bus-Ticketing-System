<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Urban Ride</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('/images/BusWallpaper.jpg') no-repeat center center/cover;
            z-index: -1;
        }
    </style>
</head>
<body class="min-h-screen">
    <div class="flex flex-col md:flex-row items-center justify-start min-h-screen bg-black bg-opacity-80 backdrop-blur-md px-6 md:px-60">
        <div class="text-left mb-8 md:mb-0 md:mr-16">
            <h1 class="text-3xl font-bold text-white drop-shadow-md">"The city moves, and so do we. Urban Ride, your journey starts here."</h1>
            <p class="text-white mt-2 drop-shadow">Enter your info, we’ll help you with that!</p>
        </div>

        <div class="w-full max-w-md">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
