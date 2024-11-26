@props(['user', 'showUnfollow' => false])

@if (Auth::user()->isFollowing($user) || $showUnfollow)
    <form action="{{ route('follow.destroy', $user) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit"
            class="px-4 py-2 text-sm font-medium text-red-400 transition-colors border border-red-400 rounded-full hover:bg-red-400 hover:text-white">
            Ne plus suivre
        </button>
    </form>
@else
    <form action="{{ route('follow.store', $user) }}" method="POST">
        @csrf
        <button type="submit"
            class="px-4 py-2 text-sm font-medium text-purple-400 transition-colors border border-purple-400 rounded-full hover:bg-purple-400 hover:text-white">
            Suivre
        </button>
    </form>
@endif
