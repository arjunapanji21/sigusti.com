<x-guest-layout>
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <img class="mx-auto h-12 w-auto" src="{{ asset('logo.png') }}" alt="Laravel Boilerplate">
            <h2 class="mt-6 text-center text-2xl font-bold leading-9 tracking-tight text-base-dark">Create your account</h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            @if ($errors->any())
                <div class="mb-4 rounded-md bg-primary/10 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-primary" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-primary">There were errors with your submission</h3>
                            <div class="mt-2 text-sm text-primary">
                                <ul class="list-disc pl-5 space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <form class="space-y-6" action="{{ route('register') }}" method="POST">
                @csrf
    
                <x-text-input
                    name="name"
                    label="Full name"
                    value="{{ old('name') }}"
                    required
                />
    
                <x-text-input
                    type="email"
                    name="email"
                    label="Email address"
                    value="{{ old('email') }}"
                    required
                    autocomplete="email"
                />
    
                <x-text-input
                    type="text"
                    name="phone"
                    label="Phone number"
                    value="{{ old('phone') }}"
                    autocomplete="tel"
                />
    
                <x-text-input
                    type="password"
                    name="password"
                    label="Password"
                    required
                    autocomplete="new-password"
                />
    
                <x-text-input
                    type="password"
                    name="password_confirmation"
                    label="Confirm password"
                    required
                    autocomplete="new-password"
                />
    
                <div>
                    <button type="submit" class="flex w-full justify-center rounded-md bg-primary px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:opacity-90 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary transition-all duration-200">Create account</button>
                </div>
            </form>

            <p class="mt-10 text-center text-sm text-base-light">
                Already have an account?
                <a href="{{ route('login') }}" class="font-semibold leading-6 text-primary hover:text-primary-light">Sign in</a>
            </p>
        </div>
    </div>
</x-guest-layout>
