<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-gray-50 to-white">
        <div class="w-full sm:max-w-md px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-xl">
            <div class="mb-8 text-center">
                <div class="flex justify-center mb-4">
                    <img src="{{ asset('logo.png') }}" alt="Logo" class="h-12 w-auto">
                </div>
                <h2 class="text-2xl font-bold text-gray-900">Create your account</h2>
                <p class="text-gray-600 mt-2">Start your 14-day free trial</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Full Name')" class="text-gray-700" />
                    <x-text-input id="name" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-gray-700" />
                    <x-text-input id="email" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Phone -->
                <div>
                    <x-input-label for="phone" :value="__('Phone Number')" class="text-gray-700" />
                    <x-text-input id="phone" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500" type="tel" name="phone" :value="old('phone')" required autocomplete="tel" />
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" class="text-gray-700" />
                    <x-text-input id="password" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-700" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div>
                    <x-primary-button class="w-full justify-center bg-gradient-to-r from-green-600 to-emerald-500 hover:opacity-90">
                        {{ __('Create Account') }}
                    </x-primary-button>
                </div>

                <p class="text-center text-sm text-gray-600">
                    By creating an account, you agree to our
                    <a href="{{route('terms')}}" class="text-green-600 hover:text-green-700">Terms of Service</a>
                    and
                    <a href="{{route('privacy')}}" class="text-green-600 hover:text-green-700">Privacy Policy</a>
                </p>
            </form>

            <p class="mt-6 text-center text-sm text-gray-600">
                Already have an account?
                <a href="{{ route('login') }}" class="font-medium text-green-600 hover:text-green-700">
                    Sign in
                </a>
            </p>
        </div>
    </div>
</x-guest-layout>
