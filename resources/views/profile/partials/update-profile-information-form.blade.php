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

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="overflow-hidden bg-gray-800 shadow-lg rounded-xl">
            <div class="p-6 border-b border-gray-700">
                <div class="mb-6">
                    <x-input-label for="avatar" value="Photo de profil" class="mb-4" />

                    <div class="space-y-4">
                        <div class="relative">
                            <input type="file" name="avatar" id="avatar"
                                class="w-full px-4 py-3 text-gray-300 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                accept="image/*" onchange="previewImage(this)">
                            <x-input-error :messages="$errors->get('avatar')" class="mt-2" />
                        </div>

                        <!-- Preview Section -->
                        <div id="previewContainer" class="hidden">
                            <span class="block mb-2 text-sm text-gray-400">Aperçu :</span>
                            <div class="relative w-32 h-32">
                                <div id="defaultPreviewIcon"
                                    class="flex items-center justify-center w-32 h-32 bg-gray-700 border-4 border-purple-500 rounded-full shadow-xl">
                                    <i class="text-4xl text-gray-400 fas fa-user"></i>
                                </div>
                                <img id="preview"
                                    class="absolute top-0 hidden object-cover w-32 h-32 border-4 border-purple-500 rounded-full shadow-xl">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                    <x-input-label for="name" :value="__('Pseudo')" />
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

                <div class="mb-6">
                    <x-input-label for="bio" :value="__('Biographie')" />
                    <textarea id="bio" name="bio" rows="4"
                        class="w-full px-4 py-3 text-gray-300 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">{{ old('bio', $user->bio) }}</textarea>
                    <x-input-error class="mt-2" :messages="$errors->get('bio')" />
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

<script>
    function previewImage(input) {
        const preview = document.getElementById('preview');
        const defaultIcon = document.getElementById('defaultPreviewIcon');
        const previewContainer = document.getElementById('previewContainer');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                defaultIcon.classList.add('hidden');
                previewContainer.classList.remove('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.classList.add('hidden');
            defaultIcon.classList.remove('hidden');
            previewContainer.classList.add('hidden');
        }
    }
</script>
