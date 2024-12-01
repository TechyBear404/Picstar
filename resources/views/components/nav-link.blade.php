@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'flex items-center justify-center sm:justify-start px-2 sm:px-4 py-2 text-purple-400 bg-gray-700 rounded-lg transition-colors duration-200'
            : 'flex items-center justify-center sm:justify-start px-2 sm:px-4 py-2 text-gray-200 rounded-lg transition-colors duration-200 hover:bg-gray-700 hover:text-purple-400';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
