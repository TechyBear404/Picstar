{{-- Définition des props du composant avec une valeur par défaut pour le type --}}
@props(['type' => null])

{{-- Configuration des classes CSS conditionnelles selon le type de notification --}}
@php
    $classes = match ($type ?? (session('success') ? 'success' : 'error')) {
        'success' => 'bg-green-600 text-white',
        'error' => 'bg-red-600 text-white',
        default => 'bg-gray-600 text-white',
    };
@endphp

{{-- Affichage conditionnel de la notification avec animation de disparition automatique --}}
@if (session('success') || session('error'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" @class([
        'fixed bottom-4 right-4 px-6 py-3 rounded-lg shadow-lg transform transition-all duration-500',
        $classes,
    ])>
        {{-- Conteneur flex avec icône et message --}}
        <div class="flex items-center space-x-3">
            {{-- Affichage conditionnel des icônes de succès ou d'erreur --}}
            @if (session('success'))
                <x-fas-check-circle class="w-6 h-6" />
            @else
                <x-fas-exclamation-circle class="w-6 h-6" />
            @endif
            {{-- Affichage du message de notification --}}
            <p>{{ session('success') ?? session('error') }}</p>
        </div>
    </div>
@endif
