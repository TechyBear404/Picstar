@props(['posts'])

<div class="grid-masonry" x-init="() => {
    const grid = $el;
    const masonry = new Masonry(grid, {
        itemSelector: '.grid-masonry-item',
        percentPosition: true,
        transitionDuration: '0.2s',
        columnWidth: '.grid-masonry-item',
        gutter: 0
    });

    imagesLoaded(grid).on('progress', function() {
        masonry.layout();
    });
}">
    @foreach ($posts as $post)
        <div class="w-full p-1 pb-1 grid-masonry-item sm:w-1/2 lg:w-1/3">
            <div
                class="overflow-hidden transition-transform duration-300 bg-gray-800 shadow-lg rounded-xl hover:-translate-y-1">

                <div class="flex items-center gap-2 p-2 bg-gray-800">
                    <x-avatar :user="$post->user" size="sm" border="sm" />
                    <div class="flex flex-col">
                        <a href="{{ route('profile.show', $post->user) }}"
                            class="text-sm font-semibold text-gray-200 transition-colors hover:text-purple-400">
                            {{ $post->user->name }}
                        </a>
                        <span
                            class="text-xs text-gray-300">{{ $post->created_at->locale('fr')->diffForHumans() }}</span>
                    </div>
                    @if (Auth::id() === $post->userId)
                        <a href="{{ route('posts.edit', $post->id) }}"
                            class="px-3 py-1 ml-auto text-xs font-medium text-gray-300 transition-colors duration-200 bg-gray-700 rounded-full hover:bg-gray-600 hover:text-white">
                            Modifier
                        </a>
                    @endif
                </div>

                <!-- Image container with hover effects -->
                <a href="{{ route('posts.show', ['post' => $post->id]) }}" class="relative block group">
                    <img src="{{ asset('storage/' . $post->image) }}" alt="Post image"
                        class="object-cover w-full transition-opacity duration-300 group-hover:opacity-90">

                    <div
                        class="absolute inset-0 flex items-center justify-center space-x-6 transition-opacity duration-300 opacity-0 bg-black/60 group-hover:opacity-100">
                        <div class="flex items-center text-white cursor-pointer" onclick="event.preventDefault();">
                            <x-like-post :post="$post" />
                        </div>
                        <div class="flex items-center text-white">
                            <x-fas-comment class="w-5 h-5 mr-1" />
                            {{ $post->comments->count() }}
                        </div>
                    </div>
                </a>

                <div class="p-2 bg-gray-800">
                    <p class="text-sm text-gray-300 line-clamp-1">
                        {{ $post->content }}
                    </p>
                </div>
            </div>
        </div>
    @endforeach
</div>
