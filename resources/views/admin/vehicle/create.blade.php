<x-app-layout>
    <x-slot name="title">New Vehicle</x-slot>
    <div class="container">
        <h1>Add new vehicle</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form method="post" action="{{ route('admin.vehicle.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="license_plate">License plate</label>
                <input type="text" class="form-control" id="license_plate" name="license_plate" placeholder="E.g. ABC-123" value="{{ old('license_plate') }}" required>
                @error('license_plate')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="brand">Brand</label>
                <input type="text" class="form-control" id="brand" name="brand" placeholder="E.g. Ford" value="{{ old('brand') }}" required>
                @error('brand')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="type">Model</label>
                <input type="text" class="form-control" id="type" name="type" placeholder="E.g. Focus" value="{{ old('type') }}" required>
                @error('type')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="manufacture_year">Manufacture year</label>
                <input type="number" class="form-control" id="manufacture_year" name="manufacture_year" placeholder="E.g. 2022" value="{{ old('manufacture_year') }}" required>
                @error('manufacture_year')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">Upload image</label>
                <input type="file" class="form-control-file" id="image" name="image" required>
                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <br>
            <button style="color: lightblue" type="submit" class="btn btn-primary">Add vehicle</button>
        </form>
    </div>
</x-app-layout>
