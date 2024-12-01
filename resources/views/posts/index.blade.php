<x-app-layout>
    <div class="container mx-auto mt-6 sm:px-4" x-data="{
        viewMode: localStorage.getItem('viewMode') || 'list'
    }"
        x-effect="localStorage.setItem('viewMode', viewMode)">
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

        @if ($posts->isEmpty())
            <div
                class="flex flex-col items-center justify-center max-w-3xl p-8 mx-auto mt-8 text-center bg-gray-800 rounded-lg">
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
