<div class="fixed top-16 left-0 h-[calc(100vh-64px)] bg-white shadow-md flex flex-col p-5
                transition-all duration-300 ease-in-out w-64 md:w-20 lg:w-64">
    <h2 class="text-gray-700 font-bold mb-6 md:hidden lg:block">ADMINISTRATOR</h2>

    <ul class="space-y-4">
        <li>
            <a href="{{ route('homepage') }}" class="group flex items-center font-semibold text-gray-700 p-2 rounded-lg transition
                                hover:bg-blue-900 hover:text-white">
                <img src="{{ asset('icons/return(dark).png') }}" alt="return" class="w-6 h-6 transition
                                group-hover:invert group-hover:brightness-100">
                <span class="ml-2 md:hidden lg:inline-block">Return</span>
            </a>
        </li>
        <li>
            <a href="{{ route('bus') }}" class="group flex items-center font-semibold text-gray-700 p-2 rounded-lg transition
                                hover:bg-blue-900 hover:text-white">
                <img src="{{ asset('icons/bus.png') }}" alt="bus" class="w-6 h-6 transition
                                group-hover:invert group-hover:brightness-100">
                <span class="ml-2 md:hidden lg:inline-block">Bus</span>
            </a>
        </li>

    </ul>

    <!-- Logout Button -->
    <div class="mt-auto pt-6">
        <form action="{{ route('logout') }}" method="POST">
        @csrf
            <a href="#" class="group flex items-center font-semibold text-red-700 p-2 rounded-lg transition
                                    hover:bg-blue-900 hover:text-white">
                        <img src="{{ asset('icons/logout.png') }}" alt="Home" class="w-6 h-6 transition
                                    group-hover:invert group-hover:brightness-100">
                <span class="ml-2 md:hidden lg:inline-block"><button type="submit">Logout</button></span>
            </a>
        </form>
    </div>
</div>
