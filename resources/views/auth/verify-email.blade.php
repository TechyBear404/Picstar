<x-guest-layout>
    <div class="overflow-hidden bg-gray-800 shadow-lg rounded-xl">
        <div class="p-6 border-b border-gray-700">
            <div class="mb-4 text-sm text-gray-400">
                {{ __('Merci pour votre inscription! Avant de commencer, pourriez-vous vérifier votre adresse e-mail en cliquant sur le lien que nous venons de vous envoyer? Si vous n\'avez pas reçu l\'e-mail, nous vous en enverrons volontiers un autre.') }}
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 text-sm font-medium text-green-500">
                    {{ __('Un nouveau lien de vérification a été envoyé à l\'adresse e-mail que vous avez fournie lors de votre inscription.') }}
                </div>
            @endif

            <div class="flex items-center justify-between mt-4">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <x-primary-button>
                        {{ __('Renvoyer l\'email de vérification') }}
                    </x-primary-button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm text-gray-400 underline rounded-md hover:text-gray-100">
                        {{ __('Se déconnecter') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
