<x-app-layout>
    {{-- Container principal avec gestion de la vue --}}
    <div class="container mx-auto mt-6 sm:px-4" x-data="{
        viewMode: localStorage.getItem('viewMode') || 'list'
    }"
        x-effect="localStorage.setItem('viewMode', viewMode)">
        {{-- Bouton de changement de vue --}}
        <button @click="viewMode = viewMode === 'masonry' ? 'list' : 'masonry'"
            class="fixed z-50 inline-flex items-center justify-center p-3 text-gray-300 transition-all duration-200 ease-in-out border border-gray-700 rounded-full shadow-lg opacity-70 hover:opacity-100 right-4 top-4 md:right-8 md:top-8 bg-gray-800/90 backdrop-blur-sm hover:bg-gray-700 hover:text-white hover:border-purple-500"
            title="Changer la vue">
            <template x-if="viewMode === 'masonry'">
                <x-fas-grip class="w-5 h-5" />
            </template>
            <template x-if="viewMode === 'list'">
                <x-fas-table class="w-5 h-5" />
            </template>
        </button>

        {{-- Affichage en mode grille --}}
        <template x-if="viewMode === 'masonry'">
            <div>
                {{-- Section fil d'actualité --}}
                <div>
                    <h2 class="flex items-center gap-3 mb-6 text-2xl font-bold text-indigo-100">
                        <x-fas-user-group class="w-6 h-6" />
                        Fil d'actualité
                    </h2>
                    <x-posts-masonry :posts="$followedPosts" />
                </div>
                {{-- Section posts populaires --}}
                <div class="mt-6">
                    <h2 class="flex items-center gap-3 mb-6 text-2xl font-bold text-indigo-100">
                        <x-fas-fire class="w-6 h-6 text-orange-500" />
                        Publications populaires
                    </h2>
                    <x-posts-masonry :posts="$trendingPosts" />
                </div>

            </div>
        </template>

        {{-- Affichage en mode liste --}}
        <template x-if="viewMode === 'list'">
            <div>
                <div>
                    <h2 class="flex items-center gap-3 mb-6 text-2xl font-bold text-indigo-100">
                        <x-fas-user-group class="w-6 h-6" />
                        Fil d'actualité
                    </h2>
                    <x-posts-list :posts="$followedPosts" />
                </div>
                <div class="mt-6">
                    <h2 class="flex items-center gap-3 mb-6 text-2xl font-bold text-indigo-100">
                        <x-fas-fire class="w-6 h-6 text-orange-500" />
                        Publications populaires
                    </h2>
                    <x-posts-list :posts="$trendingPosts" />
                </div>
            </div>
        </template>
    </div>
</x-app-layout>
