<x-guest-layout>
    <div class="overflow-hidden bg-gray-800 shadow-lg rounded-xl">
        <div class="p-6 border-b border-gray-700">
            <div class="mb-6 text-sm text-gray-400">
                {{ __('Mot de passe oublié? Pas de problème. Indiquez-nous simplement votre adresse e-mail et nous vous enverrons un lien de réinitialisation du mot de passe.') }}
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="mb-6">
                    <x-input-label for="email" :value="__('Adresse e-mail')" />
                    <x-text-input id="email"
                        class="w-full px-4 py-3 text-gray-300 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                        type="email" name="email" :value="old('email')" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end">
                    <x-primary-button>
                        {{ __('Envoyer le lien') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
