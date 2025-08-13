@include('includes.header')

<main class="container mx-auto mt-10 px-6">
    <h1 class="text-3xl font-bold text-center mb-6">Upload Your Acknowledgement Form Endorse by two Refereees</h1>
    <p class="text-center text-gray-600 mb-6">
       <em>After printing and completing the references, upload your slip for validation.</em>
    </p>

    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-xl font-semibold mb-4">User Details</h2>
        <div class="bg-gray-100 p-4 rounded-lg mb-6">
            <p><strong>Full Name:</strong> {{ $contestant->surname }} {{ $contestant->first_name }} {{ $contestant->other_names }}</p>
            <p><strong>Membership Number:</strong> {{ $contestant->member_id }}</p>
            <p><strong>Email:</strong> {{ $contestant->email }}</p>
        </div>

        <form action="{{ route('acknowledgement.upload') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="user_id" value="{{ $contestant->id }}">

    <div class="mb-4">
        <label for="acknowledgement_file" class="block text-lg font-medium text-gray-700">Upload Acknowledgement Slip (JPG/PDF):</label>
        <input type="file" id="acknowledgement_file" name="acknowledgement_file" required class="mt-1 block w-full p-3 border rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500">
    </div>

    <button type="submit" class="w-full py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition duration-300">Upload</button>
</form>

        @if (session('success'))
            <div class="mt-4 p-4 bg-green-100 text-green-600 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mt-4 p-4 bg-red-100 text-red-600 rounded-lg">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</main>

@include('includes.footer')
