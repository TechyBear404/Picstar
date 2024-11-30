@props(['posts'])

<div class="flex flex-col items-center gap-4">
    @foreach ($posts as $post)
        <div class="w-full max-w-3xl p-1 pb-0 ">
            <div
                class="overflow-hidden transition-transform duration-300 bg-gray-800 shadow-lg rounded-xl hover:-translate-y-1">
                <!-- Header - always visible -->
                <div class="flex items-center gap-2 p-2 bg-gray-800">
                    <x-avatar :user="$post->user" size="sm" border="sm" />
                    <div class="flex flex-col">
                        <span class="text-sm font-semibold text-white">{{ $post->user->name }}</span>
                        <span class="text-xs text-gray-300">{{ $post->created_at->locale('fr')->diffForHumans() }}</span>
                    </div>
                    @if (Auth::id() === $post->userId)
                        <a href="{{ route('posts.edit', $post->id) }}"
                            class="px-3 py-1 ml-auto text-xs font-medium text-gray-300 transition-colors duration-200 bg-gray-700 rounded-full hover:bg-gray-600 hover:text-white">
                            Modifier
                        </a>
                    @endif
                </div>

                <!-- Image container with hover effects -->
                <a href="{{ route('posts.show', ['post' => $post->id]) }}" class="block">
                    <div class="relative group ">
                        <img src="{{ asset('storage/' . $post->image) }}" alt="Post image"
                            class="object-cover w-full h-[400px] transition-opacity duration-300 group-hover:opacity-90">

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
                </a>

                <!-- Description - always visible -->
                <div class="p-2 bg-gray-800">
                    <p class="text-sm text-gray-300 line-clamp-1">
                        {{ $post->content }}
                    </p>
                </div>
            </div>
        </div>
    @endforeach
</div>
