<button
    {{ $attributes->merge(['type' => 'button', 'class' => 'px-6 py-3 font-medium text-gray-300 transition-all duration-200 bg-gray-700 border border-gray-600 rounded-lg hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-gray-800']) }}>
    {{ $slot }}
</button>
