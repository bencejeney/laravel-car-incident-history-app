<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicle;

class VehicleController extends Controller
{
    public function create()
    {
        return view('admin.vehicle.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'license_plate' => 'required|regex:/^[A-Za-z]{3}-[0-9]{3}$/|unique:vehicles',
            'brand' => 'required|string',
            'type' => 'required|string',
            'manufacture_year' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = $request->file('image')->store('vehicle_images', 'public');

        Vehicle::create([
            'license_plate' => strtoupper($request->input('license_plate')),
            'brand' => $request->input('brand'),
            'type' => $request->input('type'),
            'manufacture_year' => $request->input('manufacture_year'),
            'image_path' => $imagePath,
        ]);

        return redirect()->route('admin.vehicle.create')->with('success', 'Jármű sikeresen létrehozva.');
    }

    public function __construct()
    {
        $this->middleware('admin');
    }

    public function edit(Vehicle $vehicle)
    {
        return view('admin.vehicle.edit', compact('vehicle'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'brand' => 'required|string',
            'type' => 'required|string',
            'manufacture_year' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Megtartjuk az eredeti képet, hacsak a felhasználó nem tölt fel újat
        $imagePath = $vehicle->image_path;

        if ($request->hasFile('image')) {
            // Ha a felhasználó új képet töltött fel, akkor a régit töröljük
            Storage::disk('public')->delete($vehicle->image_path);

            // Feltöltjük az új képet
            $imagePath = $request->file('image')->store('vehicle_images', 'public');
        }

        // Jármű adatainak frissítése
        $vehicle->update([
            'brand' => $request->input('brand'),
            'type' => $request->input('type'),
            'manufacture_year' => $request->input('manufacture_year'),
            'image_path' => $imagePath,
        ]);

        return redirect()->route('admin.vehicle.edit', $vehicle->id)->with('success', 'Jármű adatai sikeresen frissítve.');
    }
}
