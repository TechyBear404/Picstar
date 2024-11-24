<section>
    <header>
        <h2 class="text-lg font-medium text-gray-300">
            {{ __('Informations du profil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-400">
            {{ __('Mettez à jour les informations de votre profil et votre adresse e-mail.') }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="overflow-hidden bg-gray-800 shadow-lg rounded-xl">
            <div class="p-6 border-b border-gray-700">
                <div class="mb-6">
                    <x-input-label for="name" :value="__('Nom')" />
                    <x-text-input id="name" name="name" type="text"
                        class="w-full px-4 py-3 text-gray-300 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                        :value="old('name', $user->name)" required autofocus autocomplete="name" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>

                <div class="mb-6">
                    <x-input-label for="email" :value="__('E-mail')" />
                    <x-text-input id="email" name="email" type="email"
                        class="w-full px-4 py-3 text-gray-300 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                        :value="old('email', $user->email)" required autocomplete="username" />
                    <x-input-error class="mt-2" :messages="$errors->get('email')" />

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                        <div>
                            <p class="mt-2 text-sm text-gray-400">
                                {{ __('Votre adresse e-mail n\'est pas vérifiée.') }}

                                <button form="send-verification"
                                    class="text-sm text-gray-400 underline rounded-md hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                                    {{ __('Cliquez ici pour renvoyer l\'e-mail de vérification.') }}
                                </button>
                            </p>

                            @if (session('status') === 'verification-link-sent')
                                <p class="mt-2 text-sm font-medium text-green-400">
                                    {{ __('Un nouveau lien de vérification a été envoyé à votre adresse e-mail.') }}
                                </p>
                            @endif
                        </div>
                    @endif
                </div>

                <div class="flex items-center justify-end">
                    <x-primary-button>{{ __('Enregistrer') }}</x-primary-button>

                    @if (session('status') === 'profile-updated')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                            class="ml-4 text-sm text-gray-400">{{ __('Enregistré.') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </form>
</section>
