<!-- resources/views/event_tag/form.blade.php -->

@include('includes.header')

<main class="container mx-auto mt-10 px-6">
    <h1 class="text-3xl font-bold text-center mb-6">Enter Your Email or Membership Number</h1>
    <p class="text-center text-gray-600 mb-6" style="color:red;">
       <em>Enter your email or practice number to search your records and upload the signed acknowledgment document</em>
    </p>

    <div class="bg-white shadow rounded-lg p-6">
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-600 rounded-lg text-center">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('acknowledgement.search') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="identifier" class="block text-lg font-medium text-gray-700">Email or Member ID:</label>
                <input type="text" id="identifier" name="identifier" required 
                    class="mt-1 block w-full p-3 border rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500">
            </div>

            <button type="submit" class="w-full py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition duration-300">
                Search Record
            </button>
        </form>

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
