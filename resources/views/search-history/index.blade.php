<x-app-layout>
    <x-slot name="title">Search History</x-slot>
    <div class="container">
        <h1>Search History</h1>
        @if ($searchHistories->isEmpty())
            <p>Search history is empty.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>License plate</th>
                        <th>Search time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($searchHistories as $history)
                        <tr>
                            <td>{{ $history->searched_license_plate }}</td>
                            <td>{{ $history->search_time }}</td>
                            <td>
                                <a href="{{ route('search', ['license_plate' => $history->searched_license_plate]) }}" class="btn btn-primary btn-sm">Search again</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $searchHistories->links() }}
        @endif
    </div>
</x-app-layout>
