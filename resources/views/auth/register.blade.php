<x-guest-layout>
        <div class="backdrop-blur-x1 bg-white/10 border border-white/30 shadow-2xl rounded-xl p-8 w-full max-w-md mr-12 text-white">
            <h2 class="text-2xl font-bold text-center mb-4">Create your account</h2>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-4">
                    <x-input-label for="name" :value="__('Name')" class="text-white" />
                    <x-text-input id="name" class="w-full bg-white/20 text-black placeholder-white border border-white/40" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-1 text-red-200" />
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" class="text-white" />
                    <x-text-input id="email" class="w-full bg-white/20 text-black placeholder-white border border-white/40" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-red-200" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <x-input-label for="password" :value="__('Password')" class="text-white" />
                    <x-text-input id="password" class="w-full bg-white/20 text-black placeholder-white border border-white/40" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-red-200" />
                </div>

                <!-- Confirm Password -->
                <div class="mb-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-white" />
                    <x-text-input id="password_confirmation" class="w-full bg-white/20 text-black placeholder-white border border-white/40" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-red-200" />
                </div>

                <div class="mb-4">
                    <button class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded w-full">
                        {{ __('Register') }}
                    </button>
                </div>

                <div class="text-center mt-4">
                    <span class="text-sm">Already have an account?</span>
                    <a href="{{ route('login') }}" class="text-blue-300 hover:underline">Login</a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
