<x-app-layout>
    <x-slot name="title">New Incident</x-slot>
    <div class="container">
        <h1>Add new incident</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="post" action="{{ route('admin.incident.store') }}">
            @csrf

            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" class="form-control" id="location" name="location" value="{{ old('location') }}" required>
                @error('location')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="datetime">Timestamp</label>
                <input type="datetime-local" class="form-control" id="datetime" name="datetime" value="{{ old('datetime') }}" required>
                @error('datetime')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="vehicles">Vehicles</label>
                @foreach ($vehicles as $vehicle)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="vehicles[]" value="{{ $vehicle->id }}" id="vehicle_{{ $vehicle->id }}">
                        <label class="form-check-label" for="vehicle_{{ $vehicle->id }}">
                            {{ $vehicle->license_plate }}
                        </label>
                    </div>
                @endforeach
                @error('vehicles')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Add incident</button>
        </form>
    </div>
</x-app-layout>
