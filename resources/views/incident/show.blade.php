<x-app-layout>
    <x-slot name="title">Incidents</x-slot>
    <div class="py-6 px-6 content-center">
        <h1>Incident details</h1>
        <p><strong>Location:</strong> {{ $incident->location }}</p>
        <p><strong>Timestamp:</strong> {{ $incident->datetime }}</p>
        <p><strong>Description:</strong> {{ $incident->description }}</p>
        <br>
        @if ($incident->vehicles->count() > 0)
            <h2>Vehicles</h2><br>
            @foreach ($incident->vehicles as $vehicle)
                <p><strong>License plate:</strong> {{ $vehicle->license_plate }}</p>
                <p><strong>Brand:</strong> {{ $vehicle->brand }}</p>
                <p><strong>Model:</strong> {{ $vehicle->type }}</p>
                <p><strong>Manufacture year:</strong> {{ $vehicle->manufacture_year }}</p>
                <img src="{{ $vehicle->image }}" alt="{{ $vehicle->license_plate }}" style="max-width: 300px;">
            @endforeach
        @else
            <p>No vehicles involved in the incident.</p>
        @endif

        @if(auth()->check() && auth()->user()->is_admin)
            <div class="mt-6">
                <a href="{{ route('admin.incident.edit', $incident->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded">Edit Incident</a>
                <form action="{{ route('admin.incident.destroy', $incident->id) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 border border-red-700 rounded" onclick="return confirm('Are you sure you want to delete this incident?')">Delete Incident</button>
                </form>
            </div>
        @endif

        <div class="mt-6">
            <a href="{{ url('/') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 border border-green-700 rounded">Back to Home</a>
        </div>
    </div>
</x-app-layout>
