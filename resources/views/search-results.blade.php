<x-app-layout>
    <x-slot name="title">Search Results</x-slot>
    <div class="py-6 px-6 content-center">
        <h1>Search results</h1><br>
        @if ($vehicle)
            <h2>Vehicle details</h2>
            <ul class="content-center">
                <li>
                    <p>License plate: {{ $vehicle->license_plate }}</p>
                </li>
                <li>
                    <p>Brand: {{ $vehicle->brand }}</p>
                </li>
                <li>
                    <p>Model: {{ $vehicle->type }}</p>
                </li>
                <li>
                    <p>Manufacture year: {{ $vehicle->manufacture_year }}</p>
                </li>
                <li>
                    <img src="{{ asset('storage/' . $vehicle->image) }}" alt="{{ $vehicle->license_plate }}" style="max-width: 300px;">
                </li>
            </ul>

            @if ($incidents->count() > 0)
                <h2>Incidents</h2>
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="p-4">Location</th>
                            <th scope="col" class="px-6 py-3">Timestamp</th>
                            <th scope="col" class="px-6 py-3">Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($incidents as $incident)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4">{{ $incident->location }}</td>
                                <td class="px-6 py-4">{{ $incident->datetime }}</td>
                                <td class="px-6 py-4"><a href="{{ route('incident.show', $incident->id) }}">{{ $incident->description }}</a></td>
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
            <a href="{{ route('admin.vehicle.edit', $vehicle->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded">Edit Vehicle</a>
        @endif

        <div class="mt-6">
            <a href="{{ url('/') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 border border-green-700 rounded">Back to Home</a>
        </div>
    </div>
</x-app-layout>
