<nav x-data="{ open: false }" class="w-64 min-h-screen bg-white text-black shadow-lg flex flex-col px-6 py-8">
    
    <!-- Logo -->
    <div class="flex flex-col justify-center mb-10">
        @if(Auth::check())
            <a href="{{ route(Auth::user()->role === 'admin' ? 'dashboard' : (Auth::user()->role === 'client' ? 'user' : 'dispatcher.index')) }}">
                <x-application-logo/>
            </a>
        @endif
    </div>
    <br class="my-4 border-t border-gray-700">
    @if(Auth::check())
    <div class="mt-auto pt-6 border-t border-gray-700">
        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button class="w-full flex items-center space-x-3 text-sm font-medium hover:text-gray-300">
                    <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('default-avatar.png') }}" class="w-10 h-10 rounded-full" alt="Avatar">
                    <span>{{ Auth::user()->name }}</span>
                </button>
            </x-slot>

            <x-slot name="content">
                <x-dropdown-link :href="route('profile.edit')">Profile</x-dropdown-link>
    
            </x-slot>
        </x-dropdown>
    </div>
    @endif

    <br class="my-4 border-t border-gray-700">

    <!-- Navigation Links -->
    <div class="space-y-2 flex gap-2 flex-col">
        @if(Auth::check())
            @if(Auth::user()->role === 'admin')
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="flex items-center space-x-2 px-3 py-2 rounded-md hover:bg-gray-100">
                    <span>Dashboard</span>
                </x-nav-link>
                <x-nav-link :href="route('bus.index')" :active="request()->routeIs('bus.*')" class="flex items-center space-x-2 px-3 py-2 rounded-md hover:bg-gray-100">
                    <span>Bus</span>
                </x-nav-link>

                <!-- Dropdown -->
                <x-dropdown class="w-full">
                    <x-slot name="trigger">
                        <button class="w-full flex justify-between items-center px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-100 transition">
                            <span class="inline-flex items-center space-x-2">
                                <span>On-Field Employees</span>
                            </span>
                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('driver.index')">Driver</x-dropdown-link>
                        <x-dropdown-link :href="route('conductor.index')">Conductor</x-dropdown-link>
                        <x-dropdown-link :href="route('dispatcher.index')">Dispatcher</x-dropdown-link>
                    </x-slot>
                </x-dropdown>
            @elseif(Auth::user()->role === 'client')
                <x-nav-link :href="route('user')" :active="request()->routeIs('user')" class="flex items-center space-x-2 px-3 py-2 rounded-md hover:bg-gray-700">
                    <span>User Page</span>
                </x-nav-link>
            @elseif(Auth::user()->role === 'employee')
                <x-nav-link :href="route('dispatcher.index')" :active="request()->routeIs('dispatcher.*')" class="flex items-center space-x-2 px-3 py-2 rounded-md hover:bg-gray-700">
                    <span>Dispatcher</span>
                </x-nav-link>
            @endif
        @endif
    </div>

    <!-- Logout Button -->
    @if(Auth::check())
    <div>
        <x-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                </x-nav-link>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">Log Out</x-dropdown-link>
        </form>
    </div>
    @endif
</nav>
