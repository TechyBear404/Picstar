<x-app-layout>
    {{-- Conteneur principal avec padding responsive --}}
    <div class="px-4 py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
        {{-- Section en-tête du profil: photo, nom, bio et statistiques --}}
        <div class="max-w-3xl p-6 mx-auto mb-6 bg-gray-800 rounded-lg shadow-lg">
            <div class="flex items-center space-x-6">
                <x-avatar :user="$user" size="xl" border="md" />

                <div class="flex-1">
                    <div class="flex items-center justify-between">
                        <h1 class="text-2xl font-bold text-white">{{ $user->name }}</h1>
                        @if (auth()->id() !== $user->id)
                            <form action="{{ route('follow.store', $user) }}" method="POST">
                                @csrf
                                <x-post.follow-button :user="$user" />
                            </form>
                        @endif
                    </div>

                    <div class="mt-2 text-gray-400">{{ $user->bio }}</div>

                    <div class="flex mt-4 space-x-6 text-sm text-gray-400">
                        <div class="flex items-center">
                            <x-fas-camera class="w-4 h-4 mr-2" />
                            <span class="font-semibold text-white">{{ $user->posts()->count() }}</span>
                            <span class="ml-1">posts</span>
                        </div>
                        <div class="flex items-center">
                            <x-fas-users class="w-4 h-4 mr-2" />
                            <span class="font-semibold text-white">{{ $user->followers()->count() }}</span>
                            <span class="ml-1">followers</span>
                        </div>
                        <div class="flex items-center">
                            <x-fas-user-plus class="w-4 h-4 mr-2" />
                            <span class="font-semibold text-white">{{ $user->following()->count() }}</span>
                            <span class="ml-1">following</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Grille des posts de l'utilisateur avec effet hover et compteurs --}}
        <x-posts-list :posts="$posts" />

        {{-- Navigation pagination des posts --}}
        {{-- <div class="mt-6">
            {{ $posts->links() }}
        </div> --}}
    </div>
</x-app-layout>
