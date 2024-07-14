<x-app-layout>
    <x-slot name="title">Search History</x-slot>
    <div class="container">
        <h1>Search History</h1>

        @if($searchHistories->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>License Plate</th>
                        <th>Search Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($searchHistories as $history)
                        <tr>
                            <td>{{ $history->searched_license_plate }}</td>
                            <td>{{ $history->search_time }}</td>
                            <td>
                                <form action="{{ route('search') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="license_plate" value="{{ $history->searched_license_plate }}">
                                    <button type="submit" class="btn btn-primary btn-sm">Search Again</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $searchHistories->links() }}
        @else
            <p>No search history found.</p>
        @endif
    </div>
</x-app-layout>
