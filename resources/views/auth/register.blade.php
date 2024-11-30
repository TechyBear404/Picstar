<x-guest-layout>
    <div class="overflow-hidden bg-gray-800 shadow-lg rounded-xl">
        <div class="p-6 border-b border-gray-700">
            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-6">
                    <div class="flex justify-center mb-6">
                        <div class="flex flex-col items-center space-y-3">
                            <div class="relative w-40 h-40">
                                <div id="defaultIcon"
                                    class="flex items-center justify-center w-40 h-40 bg-gray-700 border-4 border-purple-500 rounded-full shadow-2xl">
                                    <x-fas-user class="w-20 h-20 text-gray-400" />
                                </div>
                                <img id="preview"
                                    class="absolute top-0 left-0 hidden object-cover w-40 h-40 border-4 border-purple-500 rounded-full shadow-2xl">
                            </div>
                        </div>
                    </div>

                    <x-input-label for="avatar" value="Photo de profil" class="mb-2" />
                    <div class="relative">
                        <input type="file" name="avatar" id="avatar"
                            class="w-full px-4 py-3 text-gray-300 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                            accept="avatar/*" onchange="previewImage(this)">
                    </div>
                    <x-input-error :messages="$errors->get('avatar')" class="mt-2" />
                </div>

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

                <!-- Biography -->
                <div class="mt-4">
                    <x-input-label for="bio" :value="__('Biographie')" />
                    <textarea id="bio" name="bio" rows="4"
                        class="w-full px-4 py-3 text-gray-300 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">{{ old('bio') }}</textarea>
                    <x-input-error :messages="$errors->get('bio')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
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

    <script>
        function previewImage(input) {
            const preview = document.getElementById('preview');
            const defaultIcon = document.getElementById('defaultIcon');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    defaultIcon.classList.add('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.classList.add('hidden');
                defaultIcon.classList.remove('hidden');
            }
        }
    </script>
</x-guest-layout>
