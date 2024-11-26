<x-app-layout>
    <div class="container px-4 mx-auto mt-6">
        <x-search />

        <di v class="grid-masonry">
            @foreach ($posts as $post)
                <div class="w-full p-1 pb-0 grid-masonry-item sm:w-1/2 lg:w-1/3">
                    <a href="{{ route('posts.show', ['post' => $post->id]) }}" class="block">
                        <div
                            class="overflow-hidden transition-transform duration-300 bg-gray-800 shadow-lg rounded-xl hover:-translate-y-1">
                            <!-- Header - always visible -->
                            <div class="flex items-center gap-2 p-2 bg-gray-800">
                                <x-avatar :user="$post->user" size="sm" border="sm" />
                                <div class="flex flex-col">
                                    <span class="text-sm font-semibold text-white">{{ $post->user->name }}</span>
                                    <span
                                        class="text-xs text-gray-300">{{ $post->created_at->locale('fr')->diffForHumans() }}</span>
                                </div>
                            </div>

                            <!-- Image container with hover effects -->
                            <div class="relative group">
                                <img src="{{ asset('storage/' . $post->image) }}" alt="Post image"
                                    class="object-cover w-full transition-opacity duration-300 group-hover:opacity-90">

                                <!-- Stats overlay - visible on hover -->
                                <div
                                    class="absolute inset-0 flex items-center justify-center space-x-6 transition-opacity duration-300 opacity-0 bg-black/60 group-hover:opacity-100">
                                    <span class="flex items-center text-white">
                                        <x-fas-heart class="w-4 h-4 mr-1" />
                                        {{ $post->postLikes->count() }}
                                    </span>
                                    <span class="flex items-center text-white">
                                        <x-fas-comment class="w-4 h-4 mr-1" />
                                        {{ $post->comments->count() }}
                                    </span>
                                </div>
                            </div>

                            <!-- Description - always visible -->
                            <div class="p-2 bg-gray-800">
                                <p class="text-sm text-gray-300 line-clamp-1">
                                    {{ $post->content }}
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
    </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const grid = document.querySelector('.grid-masonry');
            const masonry = new Masonry(grid, {
                itemSelector: '.grid-masonry-item',
                percentPosition: true,
                transitionDuration: '0.2s',
                columnWidth: '.grid-masonry-item',
                gutter: 0
            });

            // Réinitialiser Masonry après le chargement des images
            imagesLoaded(grid).on('progress', function() {
                masonry.layout();
            });
        });
    </script>

    <style>
        .grid-masonry {
            display: flex;
            flex-wrap: wrap;
            margin-left: -1rem;
            margin-right: -1rem;
        }

        .grid-masonry-item {
            margin-bottom: 1rem;
        }
    </style>
</x-app-layout>
