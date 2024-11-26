@props(['post'])

<div class="flex items-center justify-between p-4 border-b border-gray-700">
    <div class="flex items-center gap-3">
        <img src="{{ $post->user->avatar ?? asset('images/default-avatar.png') }}"
            class="object-cover w-10 h-10 rounded-full">
        <h2 class="text-xl font-semibold text-white">{{ $post->user->name }}</h2>
    </div>

    @if (Auth::id() !== $post->user->id)
        <x-post.follow-button :user="$post->user" />
    @endif
</div>
