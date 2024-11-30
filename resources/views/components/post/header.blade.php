@props(['post'])

<div class="flex items-center justify-between p-4 border-b border-gray-700">
    <div class="flex flex-row items-center gap-3 mr-2">
        <x-avatar :user="$post->user" size="md" border="sm" />
        <div>
            <a href="{{ route('profile.show', $post->user) }}"
                class="text-xl font-semibold text-gray-200 transition-colors hover:text-purple-400">
                {{ $post->user->name }}
            </a>
            <span class="text-sm text-gray-400">{{ $post->created_at->locale('fr')->diffForHumans() }}</span>
        </div>
    </div>
    @if (Auth::id() === $post->userId)
        <div>
            <a href="{{ route('posts.edit', $post) }}"
                class="px-4 py-1.5 text-sm font-medium text-gray-300 transition-colors duration-200 rounded-full bg-gray-700 hover:bg-gray-600 hover:text-white">
                Modifier
            </a>
        </div>
    @endif

    @if (Auth::id() !== $post->user->id)
        <x-post.follow-button :user="$post->user" />
    @endif
</div>
