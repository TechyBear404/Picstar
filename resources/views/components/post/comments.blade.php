@props(['comments'])

{{-- Section des commentaires avec système de réponses --}}
<div class="space-y-4">
    @forelse ($comments as $comment)
        {{-- Bloc individuel de commentaire --}}
        <div class="p-3 space-y-2 bg-gray-700 rounded-lg">
            {{-- En-tête: auteur et actions --}}
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <x-avatar :user="$comment->user" size="sm" border="sm" />
                    <div>
                        <span class="text-sm font-semibold text-white">{{ $comment->user->name }}</span>
                        <span
                            class="ml-2 text-xs text-gray-400">{{ $comment->created_at->locale('fr')->diffForHumans() }}</span>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <button class="focus:outline-none"
                        onclick="document.getElementById('commentLikeForm{{ $comment->id }}').submit();">
                        <x-fas-heart
                            class="w-4 h-4 {{ Auth::user()->hasLikeComment($comment) ? 'text-purple-500' : 'text-gray-400 hover:text-purple-400' }}" />
                    </button>
                    <span class="text-xs text-white">{{ $comment->commentLikes()->count() }}</span>
                    <form id="commentLikeForm{{ $comment->id }}" action="{{ route('comments.like', $comment) }}"
                        method="POST" class="hidden">
                        @csrf
                    </form>
                </div>
            </div>

            {{-- Contenu du commentaire --}}
            <p class="text-sm text-gray-300">{{ $comment->content }}</p>

            {{-- Actions du commentaire (Répondre, Supprimer) --}}
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

            {{-- Formulaire de réponse caché --}}
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

            {{-- Système de réponses imbriquées --}}
            @foreach ($comment->replies as $reply)
                <div class="p-2 mt-2 ml-4 space-y-1 bg-gray-800 rounded-lg">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <x-avatar :user="$comment->user" size="xs" border="xs" />
                            <div>
                                <span class="text-xs font-semibold text-white">{{ $reply->user->name }}</span>
                                <span
                                    class="ml-2 text-xs text-gray-400">{{ $reply->created_at->locale('fr')->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                    <p class="text-xs text-gray-300">{{ $reply->content }}</p>
                </div>
            @endforeach
        </div>
    @empty
        {{-- Message d'absence de commentaires --}}
        <p class="text-sm text-gray-400">Aucun commentaire pour le moment</p>
    @endforelse
</div>

{{-- Script JavaScript pour gérer l'affichage/masquage du formulaire de réponse --}}
<script>
    function toggleReplyForm(commentId) {
        const form = document.getElementById(`replyForm${commentId}`);
        form.classList.toggle('hidden');
    }
</script>
