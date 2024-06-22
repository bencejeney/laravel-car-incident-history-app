<x-app-layout>
    <x-slot name="title">Edit vehicle</x-slot>
    <div class="container">
        <h1>Edit vehicle</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="post" action="{{ route('admin.vehicle.update', $vehicle->id) }}" enctype="multipart/form-data">
            @csrf
            @method('put')

            <div class="form-group">
                <label for="license_plate">License plate</label>
                <input type="text" class="form-control" id="license_plate" name="license_plate" value="{{ $vehicle->license_plate }}" disabled>
            </div>

            <div class="form-group">
                <label for="brand">Brand</label>
                <input type="text" class="form-control" id="brand" name="brand" value="{{ old('brand', $vehicle->brand) }}" required>
                @error('brand')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="type">Model</label>
                <input type="text" class="form-control" id="type" name="type" value="{{ old('type', $vehicle->type) }}" required>
                @error('type')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="manufacture_year">Manufacture year</label>
                <input type="number" class="form-control" id="manufacture_year" name="manufacture_year" value="{{ old('manufacture_year', $vehicle->manufacture_year) }}" required>
                @error('manufacture_year')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">Upload image</label>
                <input type="file" class="form-control-file" id="image" name="image">
                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Update vehicle</button>
        </form>
    </div>
</x-app-layout>
