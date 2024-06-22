<x-app-layout>
    <x-slot name="title">Search History</x-slot>
    <div class="container">
        <h1>Keresési előzmények</h1>
        @if ($searchHistories->isEmpty())
            <p>Nincs keresési előzmény.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Rendszám</th>
                        <th>Keresés ideje</th>
                        <th>Akció</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($searchHistories as $history)
                        <tr>
                            <td>{{ $history->searched_license_plate }}</td>
                            <td>{{ $history->search_time }}</td>
                            <td>
                                <a href="{{ route('search', ['license_plate' => $history->searched_license_plate]) }}" class="btn btn-primary btn-sm">Keresés újra</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $searchHistories->links() }}
        @endif
    </div>
</x-app-layout>
