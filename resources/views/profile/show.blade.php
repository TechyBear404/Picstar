<x-app-layout>
    <div class="px-4 py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
        {{-- Profile Header --}}
        <div class="p-6 mb-6 bg-gray-800 rounded-lg shadow-lg">
            <div class="flex items-center space-x-6">
                <x-avatar :user="$user" size="xl" border="md" />

                <div class="flex-1">
                    <div class="flex items-center justify-between">
                        <h1 class="text-2xl font-bold text-white">{{ $user->name }}</h1>
                        @if (auth()->id() !== $user->id)
                            <form action="{{ route('follow.store', $user) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="px-4 py-2 rounded-full {{ auth()->user()->isFollowing($user)
                                        ? 'bg-gray-700 hover:bg-gray-600 text-gray-300'
                                        : 'bg-blue-600 hover:bg-blue-700 text-white' }}">
                                    {{ auth()->user()->isFollowing($user) ? 'Unfollow' : 'Follow' }}
                                </button>
                            </form>
                        @endif
                    </div>

                    <div class="mt-2 text-gray-400">{{ $user->bio }}</div>

                    <div class="flex mt-4 space-x-6 text-sm text-gray-400">
                        <div class="flex items-center">
                            <x-fas-camera class="w-4 h-4 mr-2" />
                            <span class="font-semibold text-white">{{ $user->posts()->count() }}</span>
                            <span class="ml-1">posts</span>
                        </div>
                        <div class="flex items-center">
                            <x-fas-users class="w-4 h-4 mr-2" />
                            <span class="font-semibold text-white">{{ $user->followers()->count() }}</span>
                            <span class="ml-1">followers</span>
                        </div>
                        <div class="flex items-center">
                            <x-fas-user-plus class="w-4 h-4 mr-2" />
                            <span class="font-semibold text-white">{{ $user->following()->count() }}</span>
                            <span class="ml-1">following</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Posts Grid --}}
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($posts as $post)
                <div class="overflow-hidden bg-gray-800 rounded-lg shadow-lg">
                    <a href="{{ route('posts.show', $post) }}" class="block">
                        <div class="relative group">
                            <img src="{{ asset('storage/' . $post->image) }}" alt="Post by {{ $user->name }}"
                                class="object-cover w-full h-64 transition-opacity duration-300 group-hover:opacity-75">

                            <div
                                class="absolute inset-0 flex items-center justify-center space-x-6 transition-opacity duration-300 opacity-0 bg-black/60 group-hover:opacity-100">
                                <span class="flex items-center text-white">
                                    <x-fas-heart class="w-5 h-5 mr-2" />
                                    {{ $post->likes()->count() }}
                                </span>
                                <span class="flex items-center text-white">
                                    <x-fas-comment class="w-5 h-5 mr-2" />
                                    {{ $post->comments->count() }}
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>
