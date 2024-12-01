@props(['tags', 'collaborators'])

{{-- Conteneur principal pour les métadonnées du post --}}
<div class="p-3 space-y-4 rounded-lg bg-gray-700/50">
    @if ($tags->count() > 0)
        {{-- Affichage des tags avec style distinctif --}}
        <div class="flex flex-wrap gap-1.5">
            @foreach ($tags as $tag)
                <span class="px-2 py-0.5 text-xs text-purple-200 bg-purple-600/70 rounded-full">
                    #{{ $tag->name }}
                </span>
            @endforeach
        </div>
    @endif

    @if ($collaborators->count() > 0)
        {{-- Liste des collaborateurs avec indicateur visuel --}}
        <div class="flex flex-wrap gap-1.5">
            @foreach ($collaborators as $colab)
                <span class="px-2 py-0.5 text-xs text-gray-200 bg-gray-600/70 rounded-full flex items-center gap-1">
                    <div class="w-2 h-2 bg-purple-400 rounded-full"></div>
                    {{ $colab->user->name }}
                </span>
            @endforeach
        </div>
    @endif
</div>
