<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-gray-800 shadow-lg rounded-xl">
                <div class="p-6 border-b border-gray-700">
                    <form method="POST" action="{{ route('posts.update', $post) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-6">
                            <x-input-label for="image" value="Image" />
                            <div class="relative">
                                <input type="file" name="image" id="image"
                                    class="w-full px-4 py-3 text-gray-300 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                    accept="image/*" onchange="previewImage(this)">
                            </div>
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                            <div class="mt-4">
                                <img id="preview" class="max-w-sm rounded-lg shadow-2xl"
                                    src="{{ $post->image ? asset('storage/' . $post->image) : '' }}">
                            </div>
                        </div>

                        <div class="mb-6">
                            <x-input-label for="description" value="Publication" />
                            <div class="relative flex items-start gap-2">
                                <x-textarea-input id="description" name="description" rows="4"
                                    required>{{ old('description', $post->content) }}</x-textarea-input>
                                <x-emoji-picker targetInput="description" position="left" />
                            </div>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div class="mb-6">
                            <x-input-label for="colabs" value="Collaborateurs" />
                            <x-text-input id="colabs" name="colabs" type="text"
                                placeholder="@utilisateur1 @utilisateur2"
                                value="{{ old('colabs', $post->colabs->pluck('user.name')->map(fn($name) => '@' . $name)->implode(' ')) }}" />
                            <x-input-error :messages="$errors->get('colabs')" class="mt-2" />
                        </div>

                        <div class="mb-6">
                            <x-input-label for="tags" value="Tags" />
                            <x-text-input id="tags" name="tags" type="text" placeholder="#photo #art"
                                value="{{ old('tags', $post->tags->pluck('name')->map(fn($name) => '#' . $name)->implode(' ')) }}" />
                            <x-input-error :messages="$errors->get('tags')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end">
                            <x-primary-button>
                                Mettre à jour
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function previewImage(input) {
        const preview = document.getElementById('preview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
            }

            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = '';
            preview.classList.add('hidden');
        }
    }
</script>
