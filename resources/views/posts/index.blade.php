<x-app-layout>
    <div class="container px-4 mx-auto mt-6" x-data="{ viewMode: 'list' }">
        <div class="flex items-center justify-between mb-6">
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
        @if ($posts->isEmpty())
            <div class="flex flex-col items-center justify-center p-8 mt-8 text-center bg-gray-800 rounded-lg">
                <x-fas-inbox class="w-16 h-16 mb-4 text-gray-600" />
                <h3 class="mb-2 text-xl font-medium text-gray-300">Aucune publication trouvée</h3>
            </div>
        @else
            <template x-if="viewMode === 'masonry'">
                <x-posts-masonry :posts="$posts" />
            </template>

            <template x-if="viewMode === 'list'">
                <x-posts-list :posts="$posts" />
            </template>
        @endif

    </div>
</x-app-layout>
