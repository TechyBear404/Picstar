{{-- Composant pour gérer les likes des posts avec compteur et bouton interactif --}}
@props(['post'])
<div {{ $attributes->merge(['class' => 'flex items-center justify-between']) }}>
    {{-- Section du bouton like et compteur --}}
    <div class="flex items-center space-x-2">
        <button class="transition-transform focus:outline-none hover:scale-110"
            onclick="document.getElementById('postLikeForm-{{ $post->id }}').submit();">
            <x-fas-heart
                class="w-5 h-5 {{ Auth::user()->hasPostLike($post) ? 'text-purple-500' : 'text-gray-400 hover:text-purple-400' }}" />
        </button>
        <span class="text-white">{{ $likesCount ?? $post->postLikes()->count() }}</span>
    </div>
    {{-- Formulaire caché pour la soumission du like --}}
    <form id="postLikeForm-{{ $post->id }}" action="{{ route('posts.like', $post) }}" method="POST" class="hidden">
        @csrf
    </form>
</div>
