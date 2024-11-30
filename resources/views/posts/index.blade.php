<x-app-layout>
    <div class="container px-4 mx-auto mt-6" x-data="{ viewMode: 'list' }">
        <div class="flex items-center justify-between mb-6">
            <x-search />

            <button @click="viewMode = viewMode === 'masonry' ? 'list' : 'masonry'"
                class="inline-flex items-center justify-center p-2.5 text-indigo-600 bg-indigo-50 rounded-lg border border-indigo-200 shadow-sm transition-all duration-200 ease-in-out hover:bg-indigo-100 hover:text-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 active:scale-95"
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
            <x-posts-masonry :posts="$posts" />
        </template>

        <template x-if="viewMode === 'list'">
            <x-posts-list :posts="$posts" />
        </template>
    </div>
</x-app-layout>
