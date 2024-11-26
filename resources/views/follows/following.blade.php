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
        <x-follower-list :users="$following" emptyMessage="Vous ne suivez personne pour le moment" :showUnfollow="true" />
    </div>
</x-app-layout>
