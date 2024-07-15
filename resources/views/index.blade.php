<x-guest-layout>
    <x-slot name="title">Home</x-slot>
    <h1>KárVertikál</h1>
    <div class="container">
        <p>{{ $overview }}</p>
        <br>
        <form action="{{ route('search') }}" method="post">
            @csrf
            <div class="form-group py-2">
                <label for="license_plate">License plate:</label>
                <input type="text" name="license_plate" id="license_plate" class="form-control" required placeholder="E.g. ABC123" style="color: black;">
            </div>
            <button type="submit" class="btn btn-primary bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded">Search</button>
        </form>

        @if (isset($vehicle))
            <h2>{{ $vehicle->brand }} {{ $vehicle->type }} ({{ $vehicle->license_plate }})</h2>
            <h3>Incidents:</h3>
            @if (count($incidents) > 0)
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
                                <td>{{ $incident->description }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No incident found for the searched vehicle.</p>
            @endif
        @endif
    </div>
    <div class="py-6">
        @auth
            <a href="{{ route('search.history.index') }}" class="block py-1 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Search history</a>
            @if(auth()->user()->is_admin)
                <ul>
                    <li>
                        <a href="{{ route('admin.vehicle.create') }}" class="block py-1 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Add vehicle</a>
                    </li>
                    <a href="{{ route('admin.incident.create') }}" class="block py-1 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Add incident</a>
                    <li>
                        <a href="{{ route('admin.users.index') }}" class="block py-1 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">User management</a>
                    </li>
                </ul>
            @endif
            <form class="inline-block py-2 px-3" method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 border border-red-700 rounded">Log out</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Log in</a>
            <br>
            <a href="{{ route('register')}}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Register</a>
        @endauth
    </div>
</x-guest-layout>
