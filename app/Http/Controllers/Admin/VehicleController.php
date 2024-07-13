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

        // Keep the original image if the user doesn't want to upload a new one
        $imagePath = $vehicle->image_path;

        if ($request->hasFile('image')) {
            // Delete old image if the user uploaded a new image
            Storage::disk('public')->delete($vehicle->image_path);

            // Upload new image
            $imagePath = $request->file('image')->store('vehicle_images', 'public');
        }

        // Update vehicle details
        $vehicle->update([
            'brand' => $request->input('brand'),
            'type' => $request->input('type'),
            'manufacture_year' => $request->input('manufacture_year'),
            'image_path' => $imagePath,
        ]);

        return redirect()->route('admin.vehicle.edit', $vehicle->id)->with('success', 'Jármű adatai sikeresen frissítve.');
    }
}
