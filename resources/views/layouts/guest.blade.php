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
                    class="flex items-center justify-center gap-2 mt-6 text-5xl font-bold text-purple-400 sm:flex-row">
                    <span>Picstar</span>
                    <picture class="ml-2 w-14 h-14"><img src="{{ asset('storage/picstar_logo.png') }}"
                            alt="Picstar logo" class=""></picture>
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
