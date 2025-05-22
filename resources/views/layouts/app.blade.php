<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased"
      style="background-image: url('{{ asset('images/SAKto.jpg') }}'); background-repeat: no-repeat !important; background-size: cover !important; background-position: center !important;">
        <div class="flex h-screen bg-black bg-opacity-70 backdrop-blur-sm">
            <!-- Sidebar Navigation -->
            @include('layouts.navigation')

            <div class="flex-1">
                <!-- Page Heading -->
                @isset($header)
                    <header class="bg-white dark:bg-gray-800 text-gray-800 bg-opacity-90">
                        <div class="max-w-full mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <!-- Page Content -->
                <main>
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
