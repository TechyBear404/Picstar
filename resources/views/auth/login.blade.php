<x-guest-layout>
    <div class="overflow-hidden bg-gray-800 shadow-lg rounded-xl">
        <div class="p-6 border-b border-gray-700">
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-6">
                    <x-input-label for="email" :value="__('Adresse e-mail')" />
                    <x-text-input id="email"
                        class="w-full px-4 py-3 text-gray-300 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                        type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mb-6">
                    <x-input-label for="password" :value="__('Mot de passe')" />
                    <x-text-input id="password"
                        class="w-full px-4 py-3 text-gray-300 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                        type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="block mb-6">
                    <label for="remember_me" class="inline-flex items-center text-gray-300">
                        <input id="remember_me" type="checkbox"
                            class="text-purple-500 bg-gray-700 border-gray-600 rounded focus:ring-purple-500"
                            name="remember">
                        <span class="text-sm ms-2">{{ __('Se souvenir de moi') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-end">
                    @if (Route::has('password.request'))
                        <a class="text-sm text-gray-400 rounded-md hover:text-purple-400 focus:outline-none focus:ring-2 focus:ring-purple-500"
                            href="{{ route('password.request') }}">
                            {{ __('Mot de passe oublié?') }}
                        </a>
                    @endif

                    <x-primary-button class="ms-4">
                        {{ __('Se connecter') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
