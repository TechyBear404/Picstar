<section>
    <header>
        <h2 class="text-lg font-medium text-gray-300">
            {{ __('Modifier le mot de passe') }}
        </h2>

        <p class="mt-1 text-sm text-gray-400">
            {{ __('Assurez-vous d\'utiliser un mot de passe long et aléatoire pour garantir la sécurité de votre compte.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div class="overflow-hidden bg-gray-800 shadow-lg rounded-xl">
            <div class="p-6 border-b border-gray-700">
                <div class="mb-6">
                    <x-input-label for="update_password_current_password" :value="__('Mot de passe actuel')" />
                    <x-text-input id="update_password_current_password" name="current_password" type="password"
                        class="w-full px-4 py-3 text-gray-300 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                        autocomplete="current-password" />
                    <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                </div>

                <div class="mb-6">
                    <x-input-label for="update_password_password" :value="__('Nouveau mot de passe')" />
                    <x-text-input id="update_password_password" name="password" type="password"
                        class="w-full px-4 py-3 text-gray-300 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                        autocomplete="new-password" />
                    <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                </div>

                <div class="mb-6">
                    <x-input-label for="update_password_password_confirmation" :value="__('Confirmer le mot de passe')" />
                    <x-text-input id="update_password_password_confirmation" name="password_confirmation"
                        type="password"
                        class="w-full px-4 py-3 text-gray-300 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                        autocomplete="new-password" />
                    <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end">
                    <x-primary-button>{{ __('Enregistrer') }}</x-primary-button>

                    @if (session('status') === 'password-updated')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                            class="ml-4 text-sm text-gray-400">{{ __('Enregistré.') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </form>
</section>
