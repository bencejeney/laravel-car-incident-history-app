<x-app-layout>
    <x-slot name="title">New Incident</x-slot>
    <div class="py-6 px-6 content-center">
        <h1>Add new incident</h1><br>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="post" action="{{ route('admin.incident.store') }}" class="max-w-sm mx-auto">
            @csrf

            <div class="form-group mb-5 py-2">
                <label for="location">Location:</label>
                <input type="text" class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="location" name="location" value="{{ old('location') }}" required>
                @error('location')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-5 py-2">
                <label for="datetime">Timestamp:</label>
                <input type="datetime-local" class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="datetime" name="datetime" value="{{ old('datetime') }}" required>
                @error('datetime')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-5 py-2">
                <label for="description">Description:</label>
                <textarea class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="description" name="description">{{ old('description') }}</textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-5 py-2">
                <label for="vehicles">Vehicles:</label>
                @foreach ($vehicles as $vehicle)
                    <div class="form-check items-center mb-4">
                        <input class="content-center form-check-input w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="vehicles[]" value="{{ $vehicle->id }}" id="vehicle_{{ $vehicle->id }}">
                        <label class="content-center form-check-label ms-2 font-medium text-gray-900 dark:text-gray-300" for="vehicle_{{ $vehicle->id }}">
                            {{ $vehicle->license_plate }}
                        </label>
                    </div>
                @endforeach
                @error('vehicles')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded">Add Incident</button>

            <div class="mt-6">
                <a href="{{ url('/') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 border border-green-700 rounded">Back to Home</a>
            </div>
        </form>
    </div>
</x-app-layout>
