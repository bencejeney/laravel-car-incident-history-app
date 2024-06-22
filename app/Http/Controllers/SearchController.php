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
            return redirect()->back()->withErrors(['license_plate' => 'A keresett rendszám nem található.']);
        }

        // Keresési előzmény mentése
        if (Auth::check()) {
            SearchHistory::create([
                'searched_license_plate' => $rendszam,
                'search_time' => now(),
                'user_id' => Auth::id(),
            ]);
        }

        // A keresési eredmény megjelenítése
        return view('search_results', ['vehicle' => $vehicle]);
    }
}
?>
