@props(['post', 'likesCount'])

<div class="p-4 border-t border-gray-700">
    <div class="flex items-center justify-between mb-4">
        <div class="flex items-center space-x-2">
            <button class="transition-transform focus:outline-none hover:scale-110"
                onclick="document.getElementById('postLikeForm-{{ $post->id }}').submit();">
                <x-fas-heart
                    class="w-5 h-5 {{ Auth::user()->hasPostLike($post) ? 'text-purple-500' : 'text-gray-400 hover:text-purple-400' }}" />
            </button>
            <span class="text-white">{{ $likesCount ?? $post->postLikes()->count() }}</span>
        </div>
        <form id="postLikeForm-{{ $post->id }}" action="{{ route('posts.like', $post) }}" method="POST"
            class="hidden">
            @csrf
        </form>
    </div>

    <form action="{{ route('comments.store', $post) }}" method="POST" class="w-full">
        @csrf
        <div class="flex items-center min-w-0 gap-2 flex-nowrap">
            <x-emoji-picker targetInput="commentInput" />
            <div class="flex-1 min-w-0">
                <input type="text" id="commentInput" name="content"
                    class="w-full px-4 py-2 text-white bg-gray-700 border border-gray-600 rounded-lg focus:outline-none focus:border-purple-500 @error('content') border-red-500 @enderror"
                    placeholder="Ajouter un commentaire...">
            </div>
            <button type="submit" class="flex-none p-2 text-white bg-purple-500 rounded-lg hover:bg-purple-600">
                <x-fas-paper-plane class="w-5 h-5" />
            </button>
        </div>
        @error('content')
            <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
        @enderror
    </form>
</div>
