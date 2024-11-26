@props(['type' => null])

@php
    $classes = match ($type ?? (session('success') ? 'success' : 'error')) {
        'success' => 'bg-green-600 text-white',
        'error' => 'bg-red-600 text-white',
        default => 'bg-gray-600 text-white',
    };
@endphp

@if (session('success') || session('error'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" @class([
        'fixed bottom-4 right-4 px-6 py-3 rounded-lg shadow-lg transform transition-all duration-500',
        $classes,
    ])>
        <div class="flex items-center space-x-3">
            @if (session('success'))
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            @else
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            @endif
            <p>{{ session('success') ?? session('error') }}</p>
        </div>
    </div>
@endif
