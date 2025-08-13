@include('includes.header')

<main class="container mx-auto mt-10 px-6">
    <h1 class="text-3xl font-bold text-center mb-6">
        Welcome to the NIPR 2025 Council Election Portal.
    </h1>

    <div class="text-center mb-6">
        <p class="text-red-600 font-medium mb-2">
            Please read guidelines before filling out your online nomination.
        </p>
        <a href="{{ asset('images/Electoral-Rules-and-Guideline-2025-final.pdf') }}" download class="inline-block bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
            📄 Download Electoral Guidelines
        </a>
    </div>

    <!-- Search by Practice ID -->
    <div class="bg-white shadow rounded-lg p-6 mb-6">
        <h2 class="text-xl font-semibold mb-4">Search by Practice ID to Begin</h2>
        @if ($errors->any())
            <div style="color:red">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('message'))
            <div style="color:red">
                {{ session('message') }}
            </div>
        @endif

        <form action="{{ route('search.practice') }}" method="POST" class="flex items-center">
            @csrf
            <input
                type="text"
                name="practice_id"
                placeholder="Enter Practice ID"
                class="flex-grow border border-gray-300 rounded-lg p-2 mr-4"
                required>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">
                Search
            </button>
        </form>
    </div>
</main>

@include('includes.footer')
