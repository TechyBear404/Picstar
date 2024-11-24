<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-300">
            {{ __('Accueil') }}
        </h2>
    </x-slot> --}}
    <div class="container px-4 mx-auto mt-6">
        <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($posts as $post)
                <div
                    class="overflow-hidden transition-transform duration-300 bg-gray-800 shadow-lg rounded-xl hover:-translate-y-1">
                    <img src="{{ $post->image }}" alt="Post image"
                        class="object-cover w-full h-64 transition-opacity duration-300 hover:opacity-90">
                    <div class="flex items-center justify-between p-4">
                        <div class="flex space-x-6">
                            <span
                                class="flex items-center text-gray-300 transition-colors duration-200 hover:text-purple-400">
                                <x-fas-heart class="w-5 h-5 mr-2" />
                                {{ $post->likes_count }}
                            </span>
                            <span
                                class="flex items-center text-gray-300 transition-colors duration-200 hover:text-purple-400">
                                <x-fas-comment class="w-5 h-5 mr-2" />
                                {{ $post->comments_count }}
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
