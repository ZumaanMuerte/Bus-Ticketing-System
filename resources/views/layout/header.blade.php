<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield("title")
    <title>@yield("title")</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="css/home.css">
</head>
<body class="bg-gray-100 flex">

   <!-- Top Panel (Full-Width Blue Background) -->
    <div class="fixed top-0 left-0 w-full h-16 bg-blue-900 shadow-md flex items-center px-6 z-50">
        <!-- Logo -->
        <img src="{{ asset('icons/logo-top.png') }}" alt="Urban Ride Logo" class="w-56 h-auto">
    </div>
    <!-- Sidebar -->
    @yield("sidebar");

    <!-- Main Content -->
    <div class="main-content flex-1 ml-64 md:ml-20 lg:ml-30 p-5 transition-all duration-300">
        @yield("Main")
    </div>
    <script>
        function toggleAddModal() {
            document.getElementById('addBusModal').classList.toggle('hidden');
        }

        function closeAddModal() {
            document.getElementById('addBusModal').classList.add('hidden');
        }
    </script>

</body>

</html>
