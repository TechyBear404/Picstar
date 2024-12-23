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
    <script src="https://unpkg.com/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"></script>
    <script src="https://unpkg.com/imagesloaded@5/imagesloaded.pkgd.min.js"></script>
</head>

<body class="flex min-h-screen font-sans antialiased bg-gray-900">
    <!-- Fixed Navigation -->
    <div class="fixed inset-y-0 left-0 w-16 bg-gray-800 shadow-lg sm:w-64">
        @include('layouts.navigation')
    </div>

    <!-- Main Content -->
    <div class="flex flex-col flex-1 ml-16 sm:ml-64"> <!-- Added margin-left to offset fixed navigation -->
        @isset($header)
            <header class="bg-gray-800 shadow">
                <div class="px-4 py-6 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Search bar -->
        <x-search />

        <main class="flex-1 p-4 overflow-auto">
            {{ $slot }}
        </main>

        <!-- Notifications -->
        <x-notification />

        <!-- Scroll to top button -->
        <x-scroll-to-top />
    </div>

    @stack('scripts')
</body>

</html>
