<x-app-layout>
    <div class="py-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-white">Mes abonnés</h2>
            <div class="flex items-center gap-2">
                <span class="text-lg text-gray-400">{{ $followers->count() }} abonnés</span>
                <a href="{{ route('profile.following') }}" class="text-purple-400 hover:text-purple-300">
                    Voir mes abonnements
                </a>
            </div>
        </div>
        <x-follower-list :users="$followers" emptyMessage="Vous n'avez pas encore d'abonnés" />
    </div>
</x-app-layout>
