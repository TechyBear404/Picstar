<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'px-6 py-3 font-medium text-white transition-all duration-200 bg-purple-600 rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-gray-800']) }}>
    {{ $slot }}
</button>
