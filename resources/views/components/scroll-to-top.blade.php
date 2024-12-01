{{-- Bouton de retour en haut avec animation et détection du scroll --}}
<button {{-- Logique Alpine.js pour l'affichage/masquage basé sur le scroll --}} x-data="{ show: false }" x-init="window.addEventListener('scroll', () => { show = window.scrollY > 500 })" x-show="show"
    x-transition.opacity.duration.200ms {{-- Gestion du clic pour scroll smooth vers le haut --}} @click="window.scrollTo({top: 0, behavior: 'smooth'})"
    {{-- Classes Tailwind pour le style et l'interactivité --}}
    class="fixed z-50 inline-flex items-center justify-center p-3 text-gray-300 transition-all duration-200 ease-in-out border border-gray-700 rounded-full shadow-lg opacity-70 hover:opacity-100 right-4 bottom-4 md:right-8 md:bottom-8 bg-gray-800/90 backdrop-blur-sm hover:bg-gray-700 hover:text-white hover:border-purple-500 group"
    title="Retour en haut">
    {{-- Icône de flèche avec animation au survol --}}
    <x-fas-arrow-up class="w-5 h-5 transition-transform group-hover:-translate-y-1" />
</button>
