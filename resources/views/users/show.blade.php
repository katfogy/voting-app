<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white dark:text-white leading-tight text-left">
            {{ __('User Details') }}
        </h2>
    </x-slot>

    <div class="px-5 py-6">
        <div class="bg-white dark:bg-gray-900 p-6 rounded shadow-md">
            <form>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <!-- Surname -->
                    <div>
                        <label class="block text-gray-700 dark:text-gray-300">Surname</label>
                        <input type="text" value="{{ $user->surname }}" class="w-full px-4 py-2 border rounded dark:bg-gray-800 dark:text-white" readonly>
                    </div>

                    <!-- First Name -->
                    <div>
                        <label class="block text-gray-700 dark:text-gray-300">First Name</label>
                        <input type="text" value="{{ $user->first_name }}" class="w-full px-4 py-2 border rounded dark:bg-gray-800 dark:text-white" readonly>
                    </div>

                    <!-- Other Names -->
                    <div>
                        <label class="block text-gray-700 dark:text-gray-300">Other Names</label>
                        <input type="text" value="{{ $user->other_names }}" class="w-full px-4 py-2 border rounded dark:bg-gray-800 dark:text-white" readonly>
                    </div>

                    <!-- Phone -->
                    <div>
                        <label class="block text-gray-700 dark:text-gray-300">Phone</label>
                        <input type="text" value="{{ $user->phone }}" class="w-full px-4 py-2 border rounded dark:bg-gray-800 dark:text-white" readonly>
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-gray-700 dark:text-gray-300">Email</label>
                        <input type="email" value="{{ $user->email }}" class="w-full px-4 py-2 border rounded dark:bg-gray-800 dark:text-white" readonly>
                    </div>

                    <!-- Date of Birth -->
                    <div>
                        <label class="block text-gray-700 dark:text-gray-300">Date of Birth</label>
                        <input type="date" value="{{ $user->dob }}" class="w-full px-4 py-2 border rounded dark:bg-gray-800 dark:text-white" readonly>
                    </div>

                    <!-- Gender -->
                    <div>
                        <label class="block text-gray-700 dark:text-gray-300">Gender</label>
                        <input type="text" value="{{ ucfirst($user->gender) }}" class="w-full px-4 py-2 border rounded dark:bg-gray-800 dark:text-white" readonly>
                    </div>

                    <!-- Nationality -->
                    <div>
                        <label class="block text-gray-700 dark:text-gray-300">Nationality</label>
                        <input type="text" value="{{ $user->nationality }}" class="w-full px-4 py-2 border rounded dark:bg-gray-800 dark:text-white" readonly>
                    </div>

                    <!-- State -->
                    <div>
                        <label class="block text-gray-700 dark:text-gray-300">State</label>
                        <input type="text" value="{{ $user->state }}" class="w-full px-4 py-2 border rounded dark:bg-gray-800 dark:text-white" readonly>
                    </div>

                    <!-- Position -->
                    <div>
                        <label class="block text-gray-700 dark:text-gray-300">Position</label>
                        <input type="text" value="{{ $user->position }}" class="w-full px-4 py-2 border rounded dark:bg-gray-800 dark:text-white" readonly>
                    </div>

                    <!-- Amount -->
                    <div>
                        <label class="block text-gray-700 dark:text-gray-300">Amount</label>
                        <input type="text" value="{{ number_format($user->amount, 2) }}" class="w-full px-4 py-2 border rounded dark:bg-gray-800 dark:text-white" readonly>
                    </div>

                    <!-- Grade -->
                    <div>
                        <label class="block text-gray-700 dark:text-gray-300">Grade</label>
                        <input type="text" value="{{ $user->grade }}" class="w-full px-4 py-2 border rounded dark:bg-gray-800 dark:text-white" readonly>
                    </div>

                    <!-- Member ID -->
                    <div>
                        <label class="block text-gray-700 dark:text-gray-300">Member ID</label>
                        <input type="text" value="{{ $user->member_id }}" class="w-full px-4 py-2 border rounded dark:bg-gray-800 dark:text-white" readonly>
                    </div>

                    <!-- Chapter -->
                    <div>
                        <label class="block text-gray-700 dark:text-gray-300">Chapter</label>
                        <input type="text" value="{{ $user->chapter }}" class="w-full px-4 py-2 border rounded dark:bg-gray-800 dark:text-white" readonly>
                    </div>

                    <!-- Year Inducted -->
                    <div>
                        <label class="block text-gray-700 dark:text-gray-300">Year Inducted</label>
                        <input type="date" value="{{ $user->year_inducted }}" class="w-full px-4 py-2 border rounded dark:bg-gray-800 dark:text-white" readonly>
                    </div>

                    <!-- Organization -->
                    <div>
                        <label class="block text-gray-700 dark:text-gray-300">Organization</label>
                        <input type="text" value="{{ $user->organization }}" class="w-full px-4 py-2 border rounded dark:bg-gray-800 dark:text-white" readonly>
                    </div>

                    <!-- Designation -->
                    <div>
                        <label class="block text-gray-700 dark:text-gray-300">Designation</label>
                        <input type="text" value="{{ $user->designation }}" class="w-full px-4 py-2 border rounded dark:bg-gray-800 dark:text-white" readonly>
                    </div>

                    <!-- Contact Address -->
                    <div class="col-span-2">
                        <label class="block text-gray-700 dark:text-gray-300">Contact Address</label>
                        <textarea class="w-full px-4 py-2 border rounded dark:bg-gray-800 dark:text-white" readonly>{{ $user->contact_address }}</textarea>
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-gray-700 dark:text-gray-300">Transaction Id </label>
                        <input type="text" value="{{ $user->transaction_id }}" class="w-full px-4 py-2 border rounded dark:bg-gray-800 dark:text-white" readonly>
                    </div>

                    <div class="col-span-2">
                        <label class="block text-gray-700 dark:text-gray-300">Program of Contestant if elected</label>
                        <textarea class="w-full px-4 py-2 border rounded dark:bg-gray-800 dark:text-white" readonly>{{ $user->program_of_contestant_if_elected }}</textarea>
                    </div>

                    <div class="col-span-2">
                        <label class="block text-gray-700 dark:text-gray-300">Profile of Contestant </label>
                        <textarea class="w-full px-4 py-2 border rounded dark:bg-gray-800 dark:text-white" readonly>{{ $user->profile_of_contestant }}</textarea>
                    </div>
                </div>

                <!-- Signreference -->
                <div class="mt-4">
                    @if ($user->signreference)
                        <a href="{{ asset('images/acknowledgments/' . $user->signreference) }}" 
                           class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                            Download Signreference
                        </a>
                    @else
                        <button disabled class="px-4 py-2 bg-gray-400 text-white rounded cursor-not-allowed">
                            No Signreference Available
                        </button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
