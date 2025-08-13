<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="px-5 py-6">

                <!-- Existing Section -->
                <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-3 gap-4 mt-4">

                    <div>
                        <a href="{{route('upload.form')}}" class="no-underline">
                            <div class="bg-white dark:bg-gray-800 p-4 rounded shadow-sm hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                                <div>
                                    <h5 class="text-gray-900 dark:text-white font-semibold">Upload Members</h5>
                                    <p class="text-gray-600 dark:text-gray-300">Click to Upload Members</p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div>
                        <a href="{{route('all.members')}}" class="no-underline">
                            <div class="bg-white dark:bg-gray-800 p-4 rounded shadow-sm hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                                <div>
                                    <h5 class="text-gray-900 dark:text-white font-semibold">View Members</h5>
                                    <p class="text-gray-600 dark:text-gray-300">Click to See Members</p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div>
                        <a href="{{route('all.accredited.members')}}" class="no-underline">
                            <div class="bg-white dark:bg-gray-800 p-4 rounded shadow-sm hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                                <div>
                                    <h5 class="text-gray-900 dark:text-white font-semibold">View Accreditted Members</h5>
                                    <p class="text-gray-600 dark:text-gray-300">Click to See Members</p>
                                </div>
                            </div>
                        </a>
                    </div>

                    
                </div>
    </div>
</x-app-layout>