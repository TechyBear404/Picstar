@props(['disabled' => false])

<textarea
    {{ $attributes->merge([
        'class' =>
            'w-full px-4 py-3 text-gray-300 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent disabled:opacity-50',
    ]) }}
    @disabled($disabled)>{{ $slot }}</textarea>
