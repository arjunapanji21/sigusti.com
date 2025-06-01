<x-guest-layout>
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <img class="mx-auto h-12 w-auto" src="{{ asset('logo.png') }}" alt="Laravel Boilerplate">
            <h2 class="mt-6 text-center text-2xl font-bold leading-9 tracking-tight text-base-dark">Sign in to your account</h2>
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

            <form class="space-y-6" action="{{ route('login') }}" method="POST">
                @csrf
                
                <x-text-input
                    type="email"
                    name="email"
                    label="Email address"
                    value="{{ old('email') }}"
                    required
                    autocomplete="email"
                />

                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm font-medium leading-6 text-base-dark">Password</label>
                        <div class="text-sm">
                            <a href="#" class="font-semibold text-primary hover:text-primary-light">Forgot password?</a>
                        </div>
                    </div>
                    <div class="mt-2">
                        <input id="password" name="password" type="password" autocomplete="current-password" required class="block w-full rounded-md border-0 py-1.5 text-base-dark shadow-sm ring-1 ring-inset ring-base-light/30 placeholder:text-base-light focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 px-3">
                    </div>
                </div>

                <div class="flex items-center">
                    <input id="remember" name="remember" type="checkbox" class="h-4 w-4 rounded border-base-light/30 text-primary focus:ring-primary">
                    <label for="remember" class="ml-2 block text-sm text-base-dark">Remember me</label>
                </div>

                <div>
                    <button type="submit" class="flex w-full justify-center rounded-md bg-primary px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:opacity-90 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary transition-all duration-200">Sign in</button>
                </div>
            </form>

            <p class="mt-10 text-center text-sm text-base-light">
                Not a member?
                <a href="{{ route('register') }}" class="font-semibold leading-6 text-primary hover:text-primary-light">Create an account</a>
            </p>
        </div>
    </div>
</x-guest-layout>
