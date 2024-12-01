{{-- Composant de sélecteur d'emojis avec positionnement dynamique --}}
@props(['targetInput', 'position' => 'bottom'])

{{-- Configuration des classes de positionnement --}}
@php
    $positionClasses = [
        'bottom' => 'bottom-full left-0',
        'top' => 'top-full left-0',
        'left' => 'right-full top-0',
        'right' => 'left-full top-0',
    ];
    $framePosition = $positionClasses[$position] ?? $positionClasses['bottom'];
@endphp

<div x-data="{ open: false }" class="relative inline-block">
    {{-- Bouton déclencheur du picker --}}
    <button type="button" @click="open = !open" class="text-gray-400 hover:text-purple-400 focus:outline-none">
        <x-fas-face-smile-beam class="w-5 h-5" />
    </button>

    {{-- Panneau de sélection des emojis avec animation --}}
    <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
        class="absolute z-50 p-3 mb-2 bg-gray-800 rounded-lg shadow-xl {{ $framePosition }} max-w-72 min-w-60">
        <div class="grid grid-cols-6 gap-2 ">
            @foreach (['😀', '😂', '🥰', '😍', '😎', '🤩', '😊', '🥳', '😇', '😌', '😋', '😆', '💪', '👍', '🎉', '✨', '💫', '💕', '🔥', '💯', '🎨', '📸', '🎭', '🎬', '🎼', '🎧', '🎤', '🎹', '🥁', '🎸', '🎻', '🎺'] as $emoji)
                <button type="button"
                    @click="document.getElementById('{{ $targetInput }}').value += '{{ $emoji }}'; open = false"
                    class="text-xl transition-colors rounded hover:bg-gray-700">
                    {{ $emoji }}
                </button>
            @endforeach
        </div>
    </div>
</div>
