@props(['user'])

@if (Auth::user()->isFollowing($user))
    <form action="{{ route('follow.destroy', $user) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="px-4 py-2 text-sm text-white bg-purple-500 rounded-lg hover:bg-purple-600">
            Ne plus suivre
        </button>
    </form>
@else
    <form action="{{ route('follow.store', $user) }}" method="POST">
        @csrf
        <button type="submit" class="px-4 py-2 text-sm text-white bg-purple-500 rounded-lg hover:bg-purple-600">
            Suivre
        </button>
    </form>
@endif
