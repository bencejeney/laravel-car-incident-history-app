<x-app-layout>
    <x-slot name="title">Edit vehicle</x-slot>
    <div class="py-6 px-6 content-center">
        <h1>Edit vehicle</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="post" action="{{ route('admin.vehicle.update', $vehicle->id) }}" enctype="multipart/form-data" class="max-w-sm mx-auto">
            @csrf
            @method('put')

            <div class="form-group mb-5 py-2">
                <label for="license_plate">License plate:</label>
                <input type="text" class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="license_plate" name="license_plate" value="{{ $vehicle->license_plate }}" disabled>
            </div>

            <div class="form-group mb-5 py-2">
                <label for="brand">Brand:</label>
                <input type="text" class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="brand" name="brand" value="{{ old('brand', $vehicle->brand) }}" required>
                @error('brand')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-5 py-2">
                <label for="type">Model:</label>
                <input type="text" class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="type" name="type" value="{{ old('type', $vehicle->type) }}" required>
                @error('type')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-5 py-2">
                <label for="manufacture_year">Manufacture year:</label>
                <input type="number" class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="manufacture_year" name="manufacture_year" value="{{ old('manufacture_year', $vehicle->manufacture_year) }}" required>
                @error('manufacture_year')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">Upload image:</label>
                @if($vehicle->image_path)
                    <div>
                        <img src="{{ asset('storage/' . $vehicle->image_path) }}" alt="Vehicle Image" style="max-width: 200px; max-height: 200px;">
                    </div>
                @endif
                <input type="file" class="form-control-file bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="image" name="image">
                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <br>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded">Update Vehicle</button>
        </form>

        <div class="mt-6">
            <a href="{{ url('/') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 border border-green-700 rounded">Back to Home</a>
        </div>
    </div>
</x-app-layout>
