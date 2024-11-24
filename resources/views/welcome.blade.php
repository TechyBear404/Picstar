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
            <!-- Logo -->
            <div class="mb-8">
                <svg class="w-24 h-24 text-purple-400" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M4 16L8.586 11.414C8.96106 11.0389 9.46967 10.8284 10 10.8284C10.5303 10.8284 11.0389 11.0389 11.414 11.414L16 16M14 14L15.586 12.414C15.9611 12.0389 16.4697 11.8284 17 11.8284C17.5303 11.8284 18.0389 12.0389 18.414 12.414L20 14M14 8H14.01M6 20H18C18.5304 20 19.0391 19.7893 19.4142 19.4142C19.7893 19.0391 20 18.5304 20 18V6C20 5.46957 19.7893 4.96086 19.4142 4.58579C19.0391 4.21071 18.5304 4 18 4H6C5.46957 4 4.96086 4.21071 4.58579 4.58579C4.21071 4.96086 4 5.46957 4 6V18C4 18.5304 4.21071 19.0391 4.58579 19.4142C4.96086 19.7893 5.46957 20 6 20Z"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>

            <!-- Welcome Message -->
            <h1 class="mb-6 text-5xl font-bold text-center text-white">Bienvenue sur Picstar</h1>
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
