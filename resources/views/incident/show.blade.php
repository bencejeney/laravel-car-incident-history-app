<x-app-layout>
    <x-slot name="title">Incidents</x-slot>
    <div class="container">
        <h1>Incident details</h1>
        <p><strong>Location:</strong> {{ $incident->location }}</p>
        <p><strong>Timestamp:</strong> {{ $incident->datetime }}</p>
        <p><strong>Description:</strong> {{ $incident->description }}</p>

        @if ($incident->vehicles->count() > 0)
            <h2>Vehicles</h2>
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
    </div>
</x-app-layout>
