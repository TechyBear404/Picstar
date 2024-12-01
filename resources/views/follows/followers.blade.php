<x-app-layout>
    <div class="py-6">
        <div class="container items-center justify-between px-4 mx-auto mb-6 md:flex">
            <h2 class="text-2xl font-bold text-white">Mes abonnés</h2>
            <div class="flex items-center gap-2">
                <span class="text-lg text-gray-400">{{ $followers->count() }} abonnés</span>
                <a href="{{ route('profile.following') }}" class="text-purple-400 hover:text-purple-300">
                    Voir mes abonnements
                </a>
            </div>
        </div>

        <div class="container mx-auto sm:px-4">
            @if ($followers->isEmpty())
                <div class="flex flex-col items-center justify-center p-8 mt-8 text-center bg-gray-800 rounded-lg">
                    <x-fas-users class="w-16 h-16 mb-4 text-gray-600" />
                    <h3 class="mb-2 text-xl font-medium text-gray-300">Vous n'avez pas encore d'abonnés</h3>
                </div>
            @else
                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($followers as $follow)
                        <div
                            class="p-4 overflow-hidden transition-colors bg-gray-800 rounded-lg shadow-lg hover:bg-gray-700">
                            <div
                                class="flex flex-col flex-wrap items-center justify-center gap-2 lg:flex-row lg:justify-between">
                                <a href="{{ route('profile.show', ['user' => $follow->user]) }}"
                                    class="flex items-center space-x-3">
                                    <x-avatar :user="$follow->user" size="md" border="sm" />
                                    <div>
                                        <span class="text-lg font-medium text-white">{{ $follow->user->name }}</span>
                                        <div class="flex items-center gap-4 mt-1 text-sm text-gray-400">
                                            <div class="flex gap-2 whitespace-nowrap">
                                                <span>
                                                    {{ $follow->following->posts()->count() }}
                                                </span>
                                                <span class="hidden lg:inline">
                                                    publications
                                                </span>
                                                <x-fas-inbox class="w-3 h-3 mx-1 text-gray-400 lg:hidden" />
                                            </div>
                                            <div class="flex gap-2">
                                                <span>
                                                    {{ $follow->following->followers()->count() }}
                                                </span>
                                                <span class="hidden lg:inline">
                                                    abonnés
                                                </span>
                                                <x-fas-users class="w-3 h-3 mx-1 text-gray-400 lg:hidden" />
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                @unless ($follow->user->id === Auth::id())
                                    <x-follow-button :user="$follow->user" />
                                @endunless
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
