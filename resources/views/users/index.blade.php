<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white dark:text-white leading-tight text-left">
            {{ __('Manage Users') }}
        </h2>
    </x-slot>

    <div class="px-5 py-6">
        <!-- Users Table -->
        <div class="overflow-x-auto bg-white dark:bg-gray-900 p-6 rounded shadow-md">
            <table class="min-w-full border border-gray-200 dark:border-gray-700 text-left">
                <thead class="bg-gray-300 dark:bg-gray-800 text-gray-900 dark:text-white">
                    <tr>
                        <th class="px-6 py-3 border-b">#</th>
                        <th class="px-6 py-3 border-b">Full Name</th>
                        <th class="px-6 py-3 border-b">Email</th>
                        <th class="px-6 py-3 border-b">Phone</th>
                        <th class="px-6 py-3 border-b text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-900 dark:text-white">
                    @foreach ($users as $key => $user)
                        <tr class="border-t dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800">
                            <td class="px-6 py-3">{{ $key + 1 }}</td>
                            <td class="px-6 py-3">{{ $user->surname }} {{ $user->first_name }} {{ $user->other_names }}</td>
                            <td class="px-6 py-3">{{ $user->email }}</td>
                            <td class="px-6 py-3">{{ $user->phone }}</td>
                            <td class="px-6 py-3 text-center">
                                <a href="{{ route('users.show', $user->id) }}" 
                                   class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                    View Details
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
