<x-guest-layout>
    <x-slot name="title">Home</x-slot>
    <h1>KárVertikál</h1>
    <div class="container">
        <p>{{ $overview }}</p>
        <br>
        <form action="{{ route('search') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="license_plate">License plate:</label>
                <input type="text" name="license_plate" id="license_plate" class="form-control" required placeholder="E.g. ABC123" style="color: black;">
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
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
            <a href="{{ route('search.history.index') }}">Search history</a><br>
            @if(auth()->user()->is_admin)
                <a href="{{ route('admin.vehicle.create') }}">Add vehicle</a><br>
                <a href="{{ route('admin.incident.create') }}">Add incident</a><br>
                <a href="{{ route('admin.users.index') }}">User management</a><br><br>
            @endif
            <form class="inline-block" method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="thor-menu-item-red">Log out</button>
            </form>
        @else
            <a href="{{ route('login') }}">Log in</a>
            <br>
            <a href="{{ route('register')}}">Register</a>
        @endauth
    </div>
</x-guest-layout>
