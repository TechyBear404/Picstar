<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-300">
            {{ __('Accueil') }}
        </h2>
    </x-slot> --}}
    <div class="container px-4 mx-auto mt-6">
        <div class="columns-3">
            @foreach ($posts as $post)
                <a href="{{ route('posts.show', $post) }}" class="block">
                    <div
                        class="mb-4 overflow-hidden transition-transform duration-300 bg-gray-800 shadow-lg rounded-xl hover:-translate-y-1">
                        <div class="relative group">
                            <img src="{{ asset('storage/' . $post->image) }}" alt="Post image"
                                class="object-cover w-full transition-opacity duration-300 group-hover:opacity-50">
                            <div
                                class="absolute inset-0 flex items-center justify-center space-x-6 transition-opacity duration-300 opacity-0 group-hover:opacity-100">
                                <span
                                    class="flex items-center text-white transition-colors duration-200 hover:text-purple-400">
                                    <x-fas-heart class="w-5 h-5 mr-2" />
                                    {{ $post->postLikes->count() > 0 ? $post->postLikes->count() : 0 }}
                                </span>
                                <span
                                    class="flex items-center text-white transition-colors duration-200 hover:text-purple-400">
                                    <x-fas-comment class="w-5 h-5 mr-2" />
                                    {{ $post->comments->count() > 0 ? $post->comments->count() : 0 }}
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</x-app-layout>
