<x-app-layout>
    <div class="container px-4 mx-auto mt-6" x-data="{ viewMode: 'list' }">
        <div class="flex items-center justify-between mb-6">
            <x-search />

            <button @click="viewMode = viewMode === 'masonry' ? 'list' : 'masonry'"
                class="inline-flex items-center justify-center p-2 text-gray-300 transition-all duration-200 ease-in-out bg-gray-800 border border-gray-700 rounded-lg shadow-sm hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-900 focus:ring-indigo-500 active:scale-95"
                title="Changer la vue">
                <template x-if="viewMode === 'masonry'">
                    <x-fas-grip class="w-5 h-5" />
                </template>
                <template x-if="viewMode === 'list'">
                    <x-fas-table class="w-5 h-5" />
                </template>
            </button>
        </div>

        <template x-if="viewMode === 'masonry'">
            <div>
                <div>
                    <h2 class="flex items-center gap-3 mb-6 text-2xl font-bold text-indigo-100">
                        <x-fas-user-group class="w-6 h-6" />
                        Fil d'actualité
                    </h2>
                    <x-posts-masonry :posts="$followedPosts" />
                </div>
                <div class="mt-6">
                    <h2 class="flex items-center gap-3 mb-6 text-2xl font-bold text-indigo-100">
                        <x-fas-fire class="w-6 h-6 text-orange-500" />
                        Publications populaires
                    </h2>
                    <x-posts-masonry :posts="$trendingPosts" />
                </div>

            </div>
        </template>

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
