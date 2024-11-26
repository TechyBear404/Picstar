<x-app-layout>
    <div class="container px-4 mx-auto mt-6">
        <div class="flex flex-col lg:flex-row h-[calc(100vh-5rem)] bg-gray-800 rounded-xl overflow-hidden">
            {{-- Section Image --}}
            <div class="w-full h-full border-r border-gray-700 lg:w-2/3">
                <div class="relative w-full h-full">
                    <img src="{{ asset('storage/' . $post->image) }}" alt="Post image"
                        class="absolute inset-0 object-scale-down w-full h-full">
                </div>
            </div>

            {{-- Section Contenu --}}
            <div class="flex flex-col w-full h-full lg:w-1/3">
                <x-post.header :post="$post" />

                <div class="flex-1 overflow-y-auto scrollbar-thin scrollbar-thumb-gray-600">
                    <div class="p-4 space-y-6">
                        {{-- Contenu du post --}}
                        <x-post.content :content="$post->content" />

                        {{-- Metadata (Tags + Collaborateurs) --}}
                        <x-post.metadata :tags="$post->tags" :collaborators="$post->colabs" />

                        {{-- Section Commentaires --}}
                        <x-post.comments :comments="$post->comments" />
                    </div>
                </div>

                {{-- Footer avec likes et form de commentaire --}}
                <x-post.footer :post="$post" :likes-count="$post->likes_count" />
            </div>
        </div>
    </div>
</x-app-layout>
