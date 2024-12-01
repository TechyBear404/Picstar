<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-gray-300 bg-gray-900">
    <div class="flex flex-col items-center min-h-screen pt-6 sm:justify-center sm:pt-0">

        <div>
            <a href="/">
                <span
                    class="flex flex-col items-center justify-center mt-6 text-3xl font-bold text-purple-400 sm:flex-row">
                    <span>Pic</span>
                    <span class="hidden sm:inline">star</span>
                    <x-fas-star class="w-8 h-8 ml-2" />
                </span>
            </a>
        </div>

        <div class="w-full mt-6 sm:max-w-md">
            {{ $slot }}
        </div>
    </div>
    </div>
</body>

</html>
