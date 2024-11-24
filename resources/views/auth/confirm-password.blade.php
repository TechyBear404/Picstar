<x-guest-layout>
    <div class="overflow-hidden bg-gray-800 shadow-lg rounded-xl">
        <div class="p-6 border-b border-gray-700">
            <div class="mb-4 text-sm text-gray-400">
                {{ __('Il s\'agit d\'une zone sécurisée de l\'application. Veuillez confirmer votre mot de passe avant de continuer.') }}
            </div>

            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf
                <div class="mb-6">
                    <x-input-label for="password" :value="__('Mot de passe')" />

                    <x-text-input id="password" class="block w-full mt-1" type="password" name="password" required
                        autocomplete="current-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="flex justify-end mt-4">
                    <x-primary-button>
                        {{ __('Confirmer') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
