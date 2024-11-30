<x-app-layout>
    <div class="py-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-white">Mes abonnements</h2>
            <div class="flex items-center gap-2">
                <span class="text-lg text-gray-400">{{ $following->count() }} abonnements</span>
                <a href="{{ route('profile.followers') }}" class="text-purple-400 hover:text-purple-300">
                    Voir mes abonnés
                </a>
            </div>
        </div>

        <div class="container px-4 mx-auto">
            @if ($following->isEmpty())
                <div class="flex flex-col items-center justify-center p-8 mt-8 text-center bg-gray-800 rounded-lg">
                    <x-fas-users class="w-16 h-16 mb-4 text-gray-600" />
                    <h3 class="mb-2 text-xl font-medium text-gray-300">Vous ne suivez personne pour le moment</h3>
                </div>
            @else
                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($following as $follow)
                        <div class="p-4 transition-colors bg-gray-800 rounded-lg shadow-lg hover:bg-gray-700">
                            <div class="flex items-center justify-between">
                                <a href="{{ route('profile.show', ['user' => $follow->following]) }}"
                                    class="flex items-center space-x-3">
                                    <x-avatar :user="$follow->following" size="md" border="sm" />
                                    <div>
                                        <span
                                            class="text-lg font-medium text-white">{{ $follow->following->name }}</span>
                                        <div class="flex items-center gap-4 mt-1 text-sm text-gray-400">
                                            <span>{{ $follow->following->posts()->count() }} publications</span>
                                            <span>{{ $follow->following->followers()->count() }} abonnés</span>
                                        </div>
                                    </div>
                                </a>
                                <x-follow-button :user="$follow->following" :showUnfollow="true" />
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
