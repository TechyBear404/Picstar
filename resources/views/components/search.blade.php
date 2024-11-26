<div x-data="{
    query: '',
    type: 'posts',
    isVisible: localStorage.getItem('searchVisible') === 'true',
    handleSearch(event) {
        event.preventDefault();
        const query = this.query.trim();
        if (!query) return;

        switch (this.type) {
            case 'users':
                window.location.href = `/user/${query}/posts`;
                break;
            case 'tags':
                window.location.href = `/tags/${query.replace('#', '')}`;
                break;
            case 'posts':
                window.location.href = `/home?search=${query}`;
                break;
        }
    },
    toggleSearch() {
        this.isVisible = !this.isVisible;
        localStorage.setItem('searchVisible', this.isVisible);
    }
}" x-show="isVisible" @toggle-search.window="toggleSearch()"
    x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform -translate-y-2"
    x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 transform translate-y-0"
    x-transition:leave-end="opacity-0 transform -translate-y-2" class="mb-6">
    <form @submit.prevent="handleSearch" class="flex items-center w-full gap-2 p-4 bg-gray-800 rounded-lg shadow-lg">
        <select x-model="type"
            class="text-sm text-gray-200 bg-gray-700 border-gray-700 rounded-md shadow-sm focus:border-purple-400 focus:ring focus:ring-purple-400 focus:ring-opacity-50">
            <option value="users">Utilisateurs</option>
            <option value="posts">Posts</option>
            <option value="tags">Tags</option>
        </select>
        <div class="relative flex-1">
            <input x-model="query" type="text"
                :placeholder="type === 'users' ? '@username' : type === 'tags' ? '#tag' : 'Rechercher...'"
                class="w-full text-sm bg-gray-700 border-gray-700 rounded-md shadow-sm focus:border-purple-400 focus:ring focus:ring-purple-400 focus:ring-opacity-50">
        </div>
        <button type="submit" class="px-4 py-2 text-white bg-purple-600 rounded-md hover:bg-purple-700">
            <x-fas-search class="w-4 h-4" />
        </button>
    </form>
</div>
