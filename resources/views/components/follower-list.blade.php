@props(['users', 'emptyMessage', 'showUnfollow' => false])

<div class="container px-4 mx-auto">
    @if ($users->isEmpty())
        <div class="flex flex-col items-center justify-center p-8 mt-8 text-center bg-gray-800 rounded-lg">
            <x-fas-users class="w-16 h-16 mb-4 text-gray-600" />
            <h3 class="mb-2 text-xl font-medium text-gray-300">{{ $emptyMessage }}</h3>
        </div>
    @else
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($users as $userData)
                @php
                    $user = $showUnfollow ? $userData->following : $userData->follower;
                @endphp
                <div class="p-4 transition-colors bg-gray-800 rounded-lg shadow-lg hover:bg-gray-700">
                    <div class="flex items-center justify-between">
                        <a href="{{ route('user.posts', ['user' => $user->name]) }}" class="flex items-center space-x-3">
                            <x-avatar :user="$user" size="md" border="sm" />
                            <div>
                                <span class="text-lg font-medium text-white">{{ $user->name }}</span>
                                <div class="flex items-center gap-4 mt-1 text-sm text-gray-400">
                                    <span>{{ $user->posts->count() ?? 0 }} publications</span>
                                    <span>{{ $user->followers->count() ?? 0 }} abonnés</span>
                                </div>
                            </div>
                        </a>
                        @unless ($user->id === Auth::id())
                            <x-follow-button :user="$user" :showUnfollow="$showUnfollow" />
                        @endunless
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
