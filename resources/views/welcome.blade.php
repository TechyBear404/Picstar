<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Picstar</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased">
    <div class="relative min-h-screen bg-gradient-to-br from-gray-900 to-gray-800">
        <!-- Navigation -->
        @if (Route::has('login'))
            <nav class="absolute top-0 right-0 p-6">
                @auth
                    <a href="{{ url('/home') }}"
                        class="px-4 py-2 text-sm text-purple-300 transition duration-150 ease-in-out hover:text-purple-100">Accueil</a>
                @else
                    <a href="{{ route('login') }}"
                        class="px-4 py-2 text-sm text-purple-300 transition duration-150 ease-in-out hover:text-purple-100">Connexion</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="px-4 py-2 ml-4 text-sm text-purple-300 transition duration-150 ease-in-out hover:text-purple-100">Inscription</a>
                    @endif
                @endauth
            </nav>
        @endif

        <!-- Main Content -->
        <div class="flex flex-col items-center justify-center min-h-screen px-4">

            <!-- Welcome Message -->
            <div class="flex items-center gap-4 mb-6 ">
                <h1 class="font-bold text-center text-purple-500 text-7xl">Picstar</h1>
                <span class="ml-2"><img src="{{ asset('storage/picstar_logo.png') }}" alt="Picstar logo"
                        class="w-20 h-20"></span>
            </div>
            <p class="max-w-2xl mb-8 text-xl text-center text-purple-200">
                Partagez vos moments de vie, exprimez-vous à travers vos photos et connectez-vous avec vos proches.
                Rejoignez une communauté dynamique où chaque instant compte.
            </p>

            <!-- CTA Buttons -->
            <div class="flex gap-4">
                <a href="{{ route('register') }}"
                    class="px-8 py-3 text-lg font-semibold text-white transition-all duration-200 bg-purple-600 rounded-lg hover:bg-purple-700 focus:ring-2 focus:ring-purple-400">
                    Commencer
                </a>
                <a href="{{ route('login') }}"
                    class="px-8 py-3 text-lg font-semibold text-purple-300 transition-all duration-200 border-2 border-purple-400 rounded-lg hover:bg-purple-800/30 focus:ring-2 focus:ring-purple-400">
                    Se connecter
                </a>
            </div>

            <!-- Features -->
            <div class="grid max-w-6xl grid-cols-1 gap-8 mt-16 md:grid-cols-3">
                <div class="p-6 text-center rounded-lg bg-gray-800/50">
                    <h3 class="mb-3 text-xl font-semibold text-purple-300">Partagez</h3>
                    <p class="text-gray-300">Partagez vos photos et stories avec vos amis, votre famille et le monde
                        entier</p>
                </div>
                <div class="p-6 text-center rounded-lg bg-gray-800/50">
                    <h3 class="mb-3 text-xl font-semibold text-purple-300">Connectez</h3>
                    <p class="text-gray-300">Suivez vos amis, likez leurs posts et échangez via les messages</p>
                </div>
                <div class="p-6 text-center rounded-lg bg-gray-800/50">
                    <h3 class="mb-3 text-xl font-semibold text-purple-300">Explorez</h3>
                    <p class="text-gray-300">Découvrez du contenu qui vous inspire et des tendances du monde entier</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
