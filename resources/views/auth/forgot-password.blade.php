<x-guest-layout>
        <div class="backdrop-blur-xl bg-white/10 border border-white/30 shadow-2xl rounded-xl p-8 w-full max-w-md mr-12 text-white">
            <h2 class="text-2xl font-bold text-center mb-4">Reset your password</h2>

            <div class="mb-4 text-sm text-white-600 dark:text-white-400">
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </div>

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-500">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" class="text-white" />
                    <x-text-input id="email" class="w-full bg-white/20 text-black placeholder-white border border-white/40" type="email" name="email" :value="old('email')" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-red-200" />
                </div>

                <div class="mb-4">
                    <button class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded w-full">
                        {{ __('Send Password Reset Link') }}
                    </button>
                </div>

                <div class="text-center mt-4">
                    <span class="text-sm">Remember your password?</span>
                    <a href="{{ route('login') }}" class="text-blue-300 hover:underline">Log in</a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
