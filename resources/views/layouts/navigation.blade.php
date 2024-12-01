{{-- Barre de navigation principale avec état de recherche géré par Alpine.js --}}
<nav x-data="{
    open: false,
    initSearchState() {
        return localStorage.getItem('searchVisible') === 'true'
    },
    handleSearchClick() {
        $dispatch('toggle-search');
    }
}" class="flex flex-col h-full bg-gray-800 border-r border-gray-700">
    {{-- Container principal de navigation --}}
    <div class="flex flex-col flex-1 h-full px-2 sm:px-6 lg:px-8">
        <div class="flex flex-col flex-1 ">
            {{-- Logo de l'application avec texte responsive --}}
            <div class="flex items-center py-4 shrink-0">
                <a href="{{ route('home') }}">
                    <span
                        class="flex flex-col items-center justify-center text-3xl font-bold text-purple-400 sm:flex-row">
                        <span>Pic</span>
                        <span class="hidden sm:inline">star</span>
                        <span class="ml-2"><img src="{{ asset('storage/picstar_logo.png') }}" alt="Picstar logo"
                                class="w-10 h-10"></span>
                    </span>
                </a>
            </div>

            {{-- Liste des liens de navigation principaux avec icônes --}}
            <div class="flex-1 overflow-y-auto">
                <div class="flex flex-col space-y-2 sm:space-y-4">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        <x-fas-home class="w-5 h-5 sm:mr-3" />
                        <span class="hidden sm:inline">{{ __('Accueil') }}</span>
                    </x-nav-link>
                    <x-nav-link :href="route('profile.posts')" :active="request()->routeIs('profile.posts')">
                        <x-fas-images class="w-5 h-5 sm:mr-3" />
                        <span class="hidden sm:inline">{{ __('Mes publications') }}</span>
                    </x-nav-link>
                    <x-nav-link :href="route('profile.following')" :active="request()->routeIs('profile.following')">
                        <x-fas-user-friends class="w-5 h-5 sm:mr-3" />
                        <span class="hidden sm:inline">{{ __('Abonnements') }}</span>
                    </x-nav-link>
                    <x-nav-link :href="route('profile.followers')" :active="request()->routeIs('profile.followers')">
                        <x-fas-users class="w-5 h-5 sm:mr-3" />
                        <span class="hidden sm:inline">{{ __('Abonnés') }}</span>
                    </x-nav-link>
                    <x-nav-link @click="handleSearchClick" :class="{ 'bg-gray-700 text-purple-400': initSearchState() }" class="cursor-pointer hover:bg-gray-700">
                        <x-fas-search class="w-5 h-5 sm:mr-3" />
                        <span class="hidden sm:inline">{{ __('Recherche') }}</span>
                    </x-nav-link>

                    <x-nav-link :href="route('posts.create')" :active="request()->routeIs('posts.create')">
                        <x-fas-plus class="w-5 h-5 sm:mr-3" />
                        <span class="hidden sm:inline">{{ __('Créer') }}</span>
                    </x-nav-link>
                </div>
            </div>
        </div>

        {{-- Menu déroulant du profil utilisateur --}}
        <div class="py-6">
            <x-dropdown align="top-right" width="48">
                <x-slot name="trigger">
                    <button
                        class="flex items-center w-full p-1 text-gray-200 transition-colors duration-200 rounded-lg sm:px-4 sm:py-2 hover:bg-gray-700 hover:text-purple-400">
                        <div class="flex items-center justify-center flex-grow gap-2 sm:justify-start">
                            <x-avatar :user="Auth::user()" size="md" border="sm" />
                            <span class="hidden text-xl sm:inline">{{ Auth::user()->name }}</span>
                        </div>
                        <x-fas-chevron-up class="hidden w-4 h-4 ml-2 sm:inline" />
                    </button>
                </x-slot>

                <x-slot name="content">
                    <div class="p-1 bg-gray-900 border border-gray-700 rounded-lg shadow-xl">
                        <x-dropdown-link :href="route('profile.edit')"
                            class="flex items-center px-4 py-2 text-sm text-gray-100 rounded-md hover:bg-gray-700 hover:text-purple-400">
                            <x-fas-user-cog class="w-4 h-4 mr-2" />
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                                class="flex items-center px-4 py-2 text-sm text-gray-100 rounded-md hover:bg-gray-700 hover:text-purple-400">
                                <x-fas-sign-out-alt class="w-4 h-4 mr-2" />
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </div>
                </x-slot>
            </x-dropdown>
        </div>
    </div>
</nav>
