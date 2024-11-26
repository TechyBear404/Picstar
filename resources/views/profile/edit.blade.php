<x-app-layout>
    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <!-- Avatar Section -->
            <div class="flex justify-center">
                <div class="flex flex-col items-center space-y-3">
                    <x-avatar :user="$user" size="xl" border="md" />
                    <h2 class="text-2xl font-bold text-gray-200">{{ $user->name }}</h2>
                    <p class="text-gray-400">{{ $user->email }}</p>
                </div>
            </div>

            <div>
                @include('profile.partials.update-profile-information-form')
            </div>

            <div>
                @include('profile.partials.update-password-form')
            </div>

            <div>
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
