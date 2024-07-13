<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\SearchHistory;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $request->validate([
            'license_plate' => 'required|regex:/^[a-zA-Z]{3}-?[0-9]{3}$/'
        ]);

        $license_plate = strtoupper(str_replace('-', '', $request->input('license_plate')));

        $vehicle = Vehicle::where('license_plate', $license_plate)->first();

        if (!$vehicle) {
            return redirect()->back()->withErrors(['license_plate' => 'License plate not found.']);
        }

        // Save search result
        if (Auth::check()) {
            SearchHistory::create([
                'searched_license_plate' => $license_plate,
                'search_time' => now(),
                'user_id' => Auth::id(),
            ]);
        }

        // Show search result
        return view('search_results', ['vehicle' => $vehicle]);
    }
}
?>
