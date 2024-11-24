<x-guest-layout>
    <div class="overflow-hidden bg-gray-800 shadow-lg rounded-xl">
        <div class="p-6 border-b border-gray-700">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-6">
                    <x-input-label for="name" :value="__('Nom')" />
                    <x-text-input id="name"
                        class="w-full px-4 py-3 text-gray-300 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                        type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Adresse e-mail')" />
                    <x-text-input id="email" class="block w-full mt-1" type="email" name="email"
                        :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Mot de passe')" />

                    <x-text-input id="password" class="block w-full mt-1" type="password" name="password" required
                        autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" />

                    <x-text-input id="password_confirmation" class="block w-full mt-1" type="password"
                        name="password_confirmation" required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end">
                    <a class="text-sm text-gray-400 rounded-md hover:text-purple-400 focus:outline-none focus:ring-2 focus:ring-purple-500"
                        href="{{ route('login') }}">
                        {{ __('Déjà inscrit?') }}
                    </a>

                    <x-primary-button class="ms-4">
                        {{ __('S\'inscrire') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
