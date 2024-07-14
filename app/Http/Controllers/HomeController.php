<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incident;
use App\Models\Vehicle;

class HomeController extends Controller
{
    public function index()
    {
        $overview = "Welcome to KárVertikál car incident history system! Here you can find vehicle's incidents.";

        return view('index', compact('overview'));
    }

    public function search(Request $request)
    {
        // Check if the user is logged in

        if (!auth()->check()) {
            return redirect()->route('login')->with('warning', 'Log in first!');
        }

        // Validate search field
        $request->validate([
            'license_plate' => 'required|regex:/^[A-Za-z]{3}[0-9]{3}$/',
        ]);

        // Search between incidents
        $licensePlate = strtoupper($request->input('license_plate'));
        $vehicle = Vehicle::where('license_plate', $licensePlate)->first();

        if (!$vehicle) {
            return redirect()->back()->with('error', 'License plate not found.');
        }

        // Save search history
        auth()->user()->searchHistories()->create([
            'searched_license_plate' => $licensePlate,
            'search_time' => now(),
        ]);

        $incidents = $vehicle->incidents()->orderBy('datetime', 'desc')->get();

        return view('search-results', compact('vehicle', 'incidents'));
    }
}
