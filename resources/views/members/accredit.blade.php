<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white dark:text-white leading-tight text-center">
            {{ __('Accredit Member: ') }} {{ $user->first_name }} {{ $user->last_name }}
        </h2>
    </x-slot>

    <div class="px-5 py-6 max-w-md mx-auto mt-5 bg-white dark:bg-gray-800 rounded shadow">
        @if(session('success'))
            <div class="mb-4 text-green-600 font-semibold text-center">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('users.accredit.save', $user->id) }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-4 text-center">
                <label class="block mb-2 font-medium text-gray-900 dark:text-white">Take a picture (optional):</label>

                <video id="video" autoplay playsinline
                    class="w-full max-w-xs rounded shadow mb-2 mx-auto"
                    style="max-height: 300px; object-fit: contain;">
                </video>

                <canvas id="canvas" class="hidden rounded shadow mx-auto"
                    style="max-width: 200px; max-height: 300px; height: auto; object-fit: contain;">
                </canvas>

                <input
                    type="file"
                    accept="image/*"
                    capture="environment"
                    name="photo"
                    id="photo"
                    class="hidden"
                />

                <div class="space-x-4 mt-2">
                    <button type="button" id="start-camera"
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Open Camera
                    </button>

                    <button type="button" id="take-photo"
                        class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500"
                        disabled>
                        Capture Photo
                    </button>
                </div>

                @error('captured_photo')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            @if ($user->passport)
                <div class="mt-4 text-center">
                    <p class="font-medium mb-2 text-gray-900 dark:text-white">Previously saved photo:</p>
                    <img src="{{ asset($user->passport) }}" alt="Accreditation Photo" class="w-32 rounded shadow mx-auto" />
                </div>
            @endif

            <div class="mb-4">
                <label for="email" class="block mb-2 font-medium text-gray-900 dark:text-white text-center">
                    Enter Email:
                </label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                    class="w-full px-4 py-2 border rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    required>
                @error('email')
                    <p class="mt-2 text-sm text-red-600 text-center">{{ $message }}</p>
                @enderror
            </div>


            <div class="mb-4">
                <label for="phone" class="block mb-2 font-medium text-gray-900 dark:text-white text-center">
                    Enter Phone:
                </label>
                <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}"
                    class="w-full px-4 py-2 border rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    required>
                @error('phone')
                    <p class="mt-2 text-sm text-red-600 text-center">{{ $message }}</p>
                @enderror
            </div>

            

            <input type="hidden" name="captured_photo" id="captured_photo" />

            <button
                type="submit"
                id="save-photo"
                class="mt-6 px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 w-full"
            >
                Save & Accredit
            </button>

            
            
        </form>
    </div>

    <script>
        const startCameraBtn = document.getElementById('start-camera');
        const takePhotoBtn = document.getElementById('take-photo');
        const savePhotoBtn = document.getElementById('save-photo');

        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const capturedPhotoInput = document.getElementById('captured_photo');

        let stream;

        startCameraBtn.addEventListener('click', async function () {
            try {
                stream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: 'environment' } });
                video.srcObject = stream;
                video.classList.remove('hidden');
                canvas.classList.add('hidden');

                takePhotoBtn.disabled = false;
            } catch (error) {
                alert('Could not open camera. Please check permissions or try a different device.');
            }
        });

        takePhotoBtn.addEventListener('click', function () {
            const context = canvas.getContext('2d');
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;

            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            canvas.classList.remove('hidden');
            video.classList.add('hidden');

            if (stream) {
                stream.getTracks().forEach(track => track.stop());
            }

            const dataUrl = canvas.toDataURL('image/png');
            capturedPhotoInput.value = dataUrl;

            takePhotoBtn.disabled = true;
        });
    </script>
</x-app-layout>
