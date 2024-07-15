<x-app-layout>
    <x-slot name="title">Search History</x-slot>
    <div class="py-6 px-6 content-center">
        <h1>Search History</h1><br>
        @if($searchHistories->count() > 0)
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="p-4">License Plate</th>
                        <th scope="col" class="px-6 py-3">Search Time</th>
                        <th scope="col" class="px-6 py-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($searchHistories as $history)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4 text-white">{{ $history->searched_license_plate }}</td>
                            <td class="px-6 py-4">{{ $history->search_time }}</td>
                            <td>
                                <form action="{{ route('search') }}" method="post" class="px-6 py-4">
                                    @csrf
                                    <input type="hidden" name="license_plate" value="{{ $history->searched_license_plate }}">
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded">View</button>
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

        <div class="mt-6">
            <a href="{{ url('/') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 border border-green-700 rounded">Back to Home</a>
        </div>
    </div>
</x-app-layout>
