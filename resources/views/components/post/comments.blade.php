@props(['comments'])

<div class="space-y-4">
    @forelse ($comments as $comment)
        <div class="p-3 space-y-2 bg-gray-700 rounded-lg">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <img src="{{ $comment->user->avatar ?? asset('images/default-avatar.png') }}"
                        class="object-cover w-6 h-6 rounded-full">
                    <span class="text-sm font-semibold text-white">{{ $comment->user->name }}</span>
                </div>
                <div class="flex items-center gap-2">
                    <button class="focus:outline-none"
                        onclick="document.getElementById('commentLikeForm{{ $comment->id }}').submit();">
                        <x-fas-heart
                            class="w-4 h-4 {{ Auth::user()->hasLikeComment($comment) ? 'text-purple-500' : 'text-purple-400' }}" />
                    </button>
                    <span class="text-xs text-white">{{ $comment->commentLikes()->count() }}</span>
                    <form id="commentLikeForm{{ $comment->id }}" action="{{ route('comments.like', $comment) }}"
                        method="POST" class="hidden">
                        @csrf
                    </form>
                </div>
            </div>
            <p class="text-sm text-gray-300">{{ $comment->content }}</p>

            <div class="flex items-center gap-2 mt-2">
                <button onclick="toggleReplyForm('{{ $comment->id }}')"
                    class="text-xs text-purple-400 hover:text-purple-500">
                    Répondre
                </button>
                @if ($comment->userId === Auth::id())
                    <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-xs text-red-400 hover:text-red-500">
                            Supprimer
                        </button>
                    </form>
                @endif
            </div>

            <form id="replyForm{{ $comment->id }}" action="{{ route('comments.reply', $comment) }}" method="POST"
                class="hidden mt-2">
                @csrf
                <div class="flex items-center space-x-2">
                    <x-emoji-picker targetInput="replyInput{{ $comment->id }}" />
                    <input type="text" id="replyInput{{ $comment->id }}" name="content"
                        class="flex-1 px-4 py-2 text-sm text-white bg-gray-800 border border-gray-600 rounded-lg focus:outline-none focus:border-purple-500"
                        placeholder="Répondre...">
                    <button type="submit"
                        class="px-3 py-1 text-sm text-white bg-purple-500 rounded-lg hover:bg-purple-600">
                        Envoyer
                    </button>
                </div>
            </form>

            {{-- Display replies using the relationship --}}
            @foreach ($comment->replies as $reply)
                <div class="p-2 mt-2 ml-4 space-y-1 bg-gray-800 rounded-lg">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <img src="{{ $reply->user->avatar ?? asset('images/default-avatar.png') }}"
                                class="object-cover w-5 h-5 rounded-full">
                            <span class="text-xs font-semibold text-white">{{ $reply->user->name }}</span>
                        </div>
                    </div>
                    <p class="text-xs text-gray-300">{{ $reply->content }}</p>
                </div>
            @endforeach
        </div>
    @empty
        <p class="text-sm text-gray-400">Aucun commentaire pour le moment</p>
    @endforelse
</div>

<script>
    function toggleReplyForm(commentId) {
        const form = document.getElementById(`replyForm${commentId}`);
        form.classList.toggle('hidden');
    }
</script>
