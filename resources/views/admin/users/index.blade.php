<x-app-layout>
    <x-slot name="title">User management</x-slot>
    <div class="container">
        <h1>User management</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Premium</th>
                    <th scope="col">Options</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->is_premium ? 'Yes' : 'No' }}</td>
                        <td>
                            <form method="post" action="{{ route('admin.users.togglePremium', $user->id) }}" style="display: inline;">
                                @csrf
                                <button style="color: lightblue" type="submit" class="btn btn-primary btn-sm">Toggle Premium</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $users->links() }}
    </div>
</x-app-layout>
