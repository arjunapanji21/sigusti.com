<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-gray-50 to-white">
        <div class="w-full sm:max-w-md px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-xl">
            <div class="mb-8 text-center">
                <div class="flex justify-center mb-4">
                    <img src="{{ asset('images/logo.svg') }}" alt="Logo" class="h-12 w-auto">
                </div>
                <h2 class="text-2xl font-bold text-gray-900">Welcome back!</h2>
                <p class="text-gray-600 mt-2">Please sign in to your account</p>
            </div>

            <!-- Session Status -->
            @if (session('status'))
                <div class="mb-4 bg-green-50 border border-green-200 text-green-600 px-4 py-3 rounded relative">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-gray-700" />
                    <x-text-input id="email" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <div class="flex justify-between items-center">
                        <x-input-label for="password" :value="__('Password')" class="text-gray-700" />
                        @if (Route::has('password.request'))
                            <a class="text-sm text-green-600 hover:text-green-700" href="{{ route('password.request') }}">
                                {{ __('Forgot password?') }}
                            </a>
                        @endif
                    </div>
                    <x-text-input id="password" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-green-600 shadow-sm focus:ring-green-500" name="remember">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div>
                    <x-primary-button class="w-full justify-center bg-gradient-to-r from-green-600 to-emerald-500 hover:opacity-90">
                        {{ __('Sign in') }}
                    </x-primary-button>
                </div>
            </form>

            <p class="mt-6 text-center text-sm text-gray-600">
                Don't have an account?
                <a href="{{ route('register') }}" class="font-medium text-green-600 hover:text-green-700">
                    Sign up
                </a>
            </p>
        </div>
    </div>
</x-guest-layout>
