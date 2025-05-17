<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <style>
        .slideshow {
            position: relative;
            width: 100%;
            height: 60vh; /* Medium height */
            overflow: hidden;
        }
        .slideshow::before {
            content: '';
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            z-index: 0;
            animation: slideshowAnim 30s infinite;
            transition: transform 2s ease;
        }

        @keyframes slideshowAnim {
            0%    { background-image: url('/images/BusWallpaper.jpg'); }
            20%   { background-image: url('/images/butuan.png'); }
            40%   { background-image: url('/images/gingoog.jpg'); }
            60%   { background-image: url('/images/malaybalay.png'); }
            80%   { background-image: url('/images/surigao.png'); }
            100%  { background-image: url('/images/davao.jpg'); }
        }

        .slideshow-content {
            position: relative;
            z-index: 1;
        }

        .slideshow:hover::before {
            transform: scale(1.1); /* Zoom on hover */
        }
    </style>

</head>
<body class="bg-white text-gray-800">
    <nav class="flex justify-between items-center p-6 shadow">
        <div class="flex items-center space-x-3">
            <img src="{{ asset('icons/logo.png') }}" alt="Logo" class="h-12">
            <span class="text-2xl font-bold">Urban Ride</span>
        </div>

        <div class="space-x-4 pr-6">
            <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Register</a>
            <a href="{{ route('login') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Login</a>
        </div>
    </nav>

    <section class="slideshow text-center text-white flex items-center justify-center">
        <div class="slideshow-content transition-transform duration-500 hover:scale-105">
            <h1 class="text-5xl font-bold drop-shadow-lg">Places you want to go</h1>
        </div>
    </section>

    <section class="bg-white text-center py-16">
        <div class="max-w-3xl mx-auto px-4">
            <div class="flex items-center justify-center space-x-3 mb-6">
                <img src="{{ asset('icons/logo.png') }}" alt="Logo" class="h-12">
                <h2 class="text-2xl font-bold">Urban Ride</h2>
            </div>

            <p class="text-gray-700">
                Urban Ride is a modern bus ticketing platform that helps passengers find available buses based on location, 
                view trip schedules, and book seats with ease. Whether you're commuting or traveling long-distance, 
                our system ensures fast, secure, and reliable reservations.
            </p>
        </div>
    </section>
</body>
</html>
