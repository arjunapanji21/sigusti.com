<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-gray-50 to-white">
        <div class="w-full sm:max-w-md px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-xl">
            <div class="mb-8 text-center">
                <div class="flex justify-center mb-4">
                    <img src="{{ asset('images/logo.svg') }}" alt="Logo" class="h-12 w-auto">
                </div>
                <h2 class="text-2xl font-bold text-gray-900">Verify Your Email</h2>
                <p class="text-gray-600 my-2">Before you can access the dashboard, please verify your email address by clicking the link we just sent to your inbox.</p>
                <x-primary-button 
                        id="gmail-button"
                        onclick="window.open('https://mail.google.com/mail/u/0/#inbox', '_blank')"
                        class="bg-gradient-to-r cursor-pointer from-green-600 to-emerald-500 hover:opacity-90 disabled:opacity-50 disabled:cursor-not-allowed"
                    >
                        <span id="button-text">Go to Email</span>
                    </x-primary-button>
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 text-sm font-medium text-green-600">
                    A new verification link has been sent to your email address.
                </div>
            @endif

            <div class="mt-4 flex items-center justify-between">
                <form method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <x-primary-button 
                        id="resend-button"
                        disabled
                        class="bg-gradient-to-r from-cyan-600 to-blue-500 hover:opacity-90 disabled:opacity-50 disabled:cursor-not-allowed"
                    >
                        <span id="button-text">{{ __('Resend Verification Email') }}</span>
                        <span id="countdown" class="ml-1">(60s)</span>
                    </x-primary-button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm text-gray-600 hover:text-gray-900">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const button = document.getElementById('resend-button');
            const countdown = document.getElementById('countdown');
            let timeLeft = 60;

            const timer = setInterval(() => {
                timeLeft--;
                countdown.textContent = `(${timeLeft}s)`;
                
                if (timeLeft <= 0) {
                    clearInterval(timer);
                    button.disabled = false;
                    countdown.textContent = '';
                }
            }, 1000);

            button.addEventListener('click', () => {
                button.disabled = true;
                timeLeft = 60;
                countdown.textContent = `(${timeLeft}s)`;
                
                const newTimer = setInterval(() => {
                    timeLeft--;
                    countdown.textContent = `(${timeLeft}s)`;
                    
                    if (timeLeft <= 0) {
                        clearInterval(newTimer);
                        button.disabled = false;
                        countdown.textContent = '';
                    }
                }, 1000);
            });
        });
    </script>
</x-guest-layout>
