@props(['post'])

<div class="flex items-center justify-between p-4 border-b border-gray-700">
    <div class="flex items-center gap-3">
        <x-avatar :user="$post->user" size="md" border="sm" />
        <div>
            <h2 class="text-xl font-semibold text-white">{{ $post->user->name }}</h2>
            <span class="text-sm text-gray-400">{{ $post->created_at->locale('fr')->diffForHumans() }}</span>
        </div>
    </div>

    @if (Auth::id() !== $post->user->id)
        <x-post.follow-button :user="$post->user" />
    @endif
</div>
