<nav x-data="{ open: false }" class="flex flex-col h-full bg-gray-800 border-r border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="flex flex-col flex-1 h-full px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col flex-1 ">
            <!-- Logo -->
            <div class="flex items-center py-4 shrink-0">
                <a href="{{ route('home') }}">
                    {{-- <x-application-logo class="block w-auto text-gray-800 fill-current h-9" /> --}}
                    <span class="text-3xl font-bold text-purple-400">Picstar</span>
                </a>
            </div>

            <!-- Navigation Links - Make it scrollable if needed -->
            <div class="flex-1 overflow-y-auto">
                <div class="flex flex-col space-y-4">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        <x-fas-home class="w-5 h-5 mr-3" />
                        <span>{{ __('Home') }}</span>
                    </x-nav-link>
                    <x-nav-link :href="route('profile.posts')" :active="request()->routeIs('profile.posts')">
                        <x-fas-images class="w-5 h-5 mr-3" />
                        <span>{{ __('Mes publications') }}</span>
                    </x-nav-link>
                    <x-nav-link href="#" :active="request()->routeIs('search')">
                        <x-fas-search class="w-5 h-5 mr-3" />
                        <span>{{ __('Recherche') }}</span>
                    </x-nav-link>
                    <x-nav-link :href="route('posts.create')" :active="request()->routeIs('posts.create')">
                        <x-fas-plus class="w-5 h-5 mr-3" />
                        <span>{{ __('Créer') }}</span>
                    </x-nav-link>
                </div>
            </div>
        </div>

        <!-- Settings Dropdown - Keep at bottom -->
        <div class="py-6">
            <x-dropdown align="top" width="48">
                <x-slot name="trigger">
                    <button
                        class="flex items-center w-full px-4 py-2 text-gray-200 transition-colors duration-200 rounded-lg hover:bg-gray-700 hover:text-purple-400">
                        <div class="flex items-center flex-grow gap-2">
                            <x-avatar :user="Auth::user()" size="md" border="sm" />
                            <span class="text-xl">{{ Auth::user()->name }}</span>
                        </div>
                        <x-fas-chevron-up class="w-4 h-4 ml-2" />
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

        <!-- Hamburger -->
        <div class="flex items-center mt-4 sm:hidden">
            <button @click="open = ! open"
                class="inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500">
                <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                {{ __('Home') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('profile.posts')" :active="request()->routeIs('profile.posts')">
                {{ __('Mes publications') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="#" :active="request()->routeIs('search')">
                {{ __('Recherche') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('posts.create')" :active="request()->routeIs('posts.create')">
                {{ __('Créer') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
                <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
