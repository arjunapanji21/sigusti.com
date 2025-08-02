<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="{{ url(asset('favicon.ico')) }}">
    <title>{{ isset($title) ? $title : 'Error' }} - {{ config('app.name', 'SI-GUSTI') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-background">
    <div class="min-h-screen flex flex-col justify-center items-center">
        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
        
        <!-- Footer -->
        <footer class="mt-8 text-center text-base-light text-sm">
            <p>&copy; {{ date('Y') }} {{ config('app.name', 'SI-GUSTI') }}. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>
