<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white dark:text-white leading-tight text-left">
            {{ __('Manage Members') }}
        </h2>
    </x-slot>

    <div class="px-5 py-6">
        <!-- Search Input -->
        <div class="mb-4">
            <input type="text" id="search" placeholder="Search members..." 
                   class="w-full p-2 border border-gray-300 rounded"
                   autocomplete="off">
        </div>

        <!-- Users Table -->
        <div class="overflow-x-auto bg-white dark:bg-gray-900 p-6 rounded shadow-md">
            <table class="min-w-full border border-gray-200 dark:border-gray-700 text-left">
                <thead class="bg-gray-300 dark:bg-gray-800 text-gray-900 dark:text-white">
                    <tr>
                        <th class="px-6 py-3 border-b">#</th>
                        <th class="px-6 py-3 border-b">Practice No</th>
                        <th class="px-6 py-3 border-b">Last Name</th>
                        <th class="px-6 py-3 border-b">First Name</th>
                        <th class="px-6 py-3 border-b">Chapter</th>
                        <th class="px-6 py-3 border-b">Category</th>
                        <th class="px-6 py-3 border-b text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-900 dark:text-white" id="users-table-body">
                    @foreach ($users as $key => $user)
                        <tr class="border-t dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800">
                            <td class="px-6 py-3">{{ $users->firstItem() + $key }}</td>
                            <td class="px-6 py-3">{{ $user->practice_no }}</td>
                            <td class="px-6 py-3">{{ $user->last_name }}</td>
                            <td class="px-6 py-3">{{ $user->first_name }}</td>
                            <td class="px-6 py-3">{{ $user->chapter }}</td>
                            <td class="px-6 py-3">{{ $user->category }}</td>
                            <td class="px-6 py-3 text-center">
                                <a href="{{ route('users.accredit', $user->id) }}" 
                                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                    Accredit
                                 </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4 pagination">
            {{ $users->links() }}
        </div>
    </div>

    <script>
       document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('search');
    const usersTableBody = document.getElementById('users-table-body');
    const pagination = document.querySelector('.pagination');

    let debounceTimeout;

    searchInput.addEventListener('input', function () {
        const query = this.value.trim();

        clearTimeout(debounceTimeout);
        debounceTimeout = setTimeout(() => {
            if (query.length === 0) {
                // If input cleared, reload paginated list (page 1)
                fetch('/members?page=1')
                    .then(response => response.text())
                    .then(html => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');

                        const newTbody = doc.getElementById('users-table-body');
                        const newPagination = doc.querySelector('.pagination');

                        if (newTbody) usersTableBody.innerHTML = newTbody.innerHTML;
                        if (pagination && newPagination) {
                            pagination.innerHTML = newPagination.innerHTML;
                            pagination.style.display = 'block';
                        } else if (pagination) {
                            pagination.style.display = 'none';
                        }
                    });
            } else {
                // Always call search API on every input change (add or delete)
                fetch(`/members/searchunaccreditted?q=${encodeURIComponent(query)}`)
                    .then(response => response.json())
                    .then(data => {
                        if (pagination) pagination.style.display = 'none';

                        if (data.length > 0) {
                            usersTableBody.innerHTML = data.map((user, index) => `
                                <tr class="border-t dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800">
                                    <td class="px-6 py-3">${index + 1}</td>
                                    <td class="px-6 py-3">${user.practice_no}</td>
                                    <td class="px-6 py-3">${user.last_name}</td>
                                    <td class="px-6 py-3">${user.first_name}</td>
                                    <td class="px-6 py-3">${user.chapter}</td>
                                    <td class="px-6 py-3">${user.category}</td>
                                    <td class="px-6 py-3 text-center">
                                        <a href="/users/${user.id}/accredit" 
                                           class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                            Accredit
                                        </a>
                                    </td>
                                </tr>
                            `).join('');
                        } else {
                            usersTableBody.innerHTML = `<tr><td colspan="7" class="text-center py-4">No members found.</td></tr>`;
                        }
                    });
            }
        }, 300); // debounce for 300ms
    });
});
    </script>
</x-app-layout>
