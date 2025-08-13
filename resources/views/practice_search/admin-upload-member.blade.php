@include('includes.header')
<div class="container mx-auto px-4 py-8">
  <div class="bg-white p-8 shadow-md rounded-lg max-w-4xl mx-auto">
      <h2 class="text-3xl font-bold text-center mb-8">Upload Member Excel File</h2>

      @if(session('message'))
          <div class="bg-green-100 text-green-800 p-3 rounded mb-4 text-center">
              {{ session('message') }}
          </div>
      @endif

      <form method="POST" action="{{ route('members.upload') }}" enctype="multipart/form-data">
          @csrf
          <div class="mb-4">
              <label class="block mb-2 text-sm font-medium text-gray-700">Choose Excel File</label>
              <input type="file" name="excel" class="w-full border border-gray-300 p-2 rounded" required>
          </div>
          <div class="text-center">
              <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
                  Upload
              </button>
          </div>
      </form>
  </div>
</div>

@include('includes.footer')