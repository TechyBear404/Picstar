@props([
    'user',
    'size' => 'md', // sm, md, lg, xl
    'border' => 'none', // sm, md, lg, xl
])

@php
    $sizeClasses = [
        'sm' => 'w-6 h-6',
        'md' => 'w-10 h-10',
        'lg' => 'w-32 h-32',
        'xl' => 'w-40 h-40',
    ][$size];

    $borderClasses = [
        'none' => '',
        'sm' => 'border-2 border-purple-500',
        'md' => 'border-4 border-purple-500',
        'lg' => 'border-8 border-purple-500',
        'xl' => 'border-12 border-purple-500',
    ][$border];
@endphp

<div class="relative {{ $sizeClasses }}">
    @if ($user->avatar)
        <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}"
            class="object-cover rounded-full shadow-xl bg-gray-700 {{ $sizeClasses }} {{ $borderClasses }}">
    @else
        <x-fas-user class="text-gray-400 rounded-full shadow-xl bg-gray-700 {{ $sizeClasses }} {{ $borderClasses }}" />
    @endif
</div>
