<x-app-layout>
    <x-slot name="title">Search Results</x-slot>
    <div class="container">
        <h1>Search results</h1>
        @if ($vehicle)
            <h2>Vehicle details</h2>
            <p>License plate: {{ $vehicle->license_plate }}</p>
            <p>Brand: {{ $vehicle->brand }}</p>
            <p>Model: {{ $vehicle->type }}</p>
            <p>Manufacture year: {{ $vehicle->manufacture_year }}</p>
            <img src="{{ $vehicle->image }}" alt="{{ $vehicle->license_plate }}" style="max-width: 300px;">

            @if ($incidents->count() > 0)
                <h2>Incidents</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Location</th>
                            <th>Timestamp</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($incidents as $incident)
                            <tr>
                                <td>{{ $incident->location }}</td>
                                <td>{{ $incident->datetime }}</td>
                                <td><a href="{{ route('incident.show', $incident->id) }}">{{ $incident->description }}</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No incidents found for the searched vehicle.</p>
            @endif
        @else
            <p>License plate not found.</p>
        @endif
        <br>
        @if(auth()->check() && auth()->user()->is_admin)
            <a style="color: lightblue" href="{{ route('admin.vehicle.edit', $vehicle->id) }}">Edit</a>
        @endif
    </div>
</x-app-layout>
