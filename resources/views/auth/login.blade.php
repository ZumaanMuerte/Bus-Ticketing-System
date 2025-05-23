<x-guest-layout>
        <div class="backdrop-blur-xl bg-white/10 border border-white/30 shadow-2xl rounded-xl p-8 w-full max-w-md mr-12">
            <h2 class="text-2xl font-bold text-center text-white mb-4">Sign in to your account</h2>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" class="text-white" />
                    <x-text-input id="email" type="email" name="email" required autofocus class="w-full bg-white/20 text-black border border-white/40" />
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-red-200" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <x-input-label for="password" :value="__('Password')" class="text-white" />
                    <x-text-input id="password" type="password" name="password" required class="w-full bg-white/20 text-black border border-white/40" />
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-red-200" />
                </div>

                <!-- Remember Me -->
                <div class="mb-4 flex items-center text-white">
                    <input type="checkbox" id="remember" name="remember" class="mr-2">
                    <label for="remember" class="text-sm">Remember me</label>
                </div>

                <!-- Submit Button -->
                <div class="mb-4">
                    <button class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded w-full">
                        {{ __('Log in') }}
                    </button>
                </div>

                <!-- Forgot Password -->
                <div class="text-center">
                    <a href="{{ route('password.request') }}" class="text-sm text-blue-300 hover:underline">Forgot password?</a>
                </div>

                <!-- Register -->
                <div class="text-center mt-4 text-white">
                    <span class="text-sm">Don't have an account?</span>
                    <a href="{{ route('register') }}" class="text-blue-300 hover:underline"> Register</a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
