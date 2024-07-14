<?php

namespace App\Http\Controllers\Admin;

use app\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicle;

class IncidentController extends Controller
{
    public function show(Incident $incident)
    {
        return view('incident.show', compact('incident'));
    }

    // Create incident
    public function __construct()
    {
        $this->middleware('premium')->only('show');
    }

    public function create()
    {
        $vehicles = Vehicle::all();
        return view('admin.incident.create', compact('vehicles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'location' => 'required|string',
            'datetime' => 'required|date|before:now',
            'description' => 'nullable|string',
            'vehicles' => 'required|array',
            'vehicles.*' => 'required|distinct|exists:vehicles,id',
        ]);

        $incident = Incident::create([
            'location' => $request->input('location'),
            'datetime' => $request->input('datetime'),
            'description' => $request->input('description'),
        ]);

        // Assign selected vehicles to incident
        $incident->vehicles()->attach($request->input('vehicles'));

        return redirect()->route('admin.incident.create')->with('success', 'Káresemény sikeresen létrehozva.');
    }

    // Edit incident
    public function edit(Incident $incident)
    {
        $vehicles = Vehicle::all();
        return view('admin.incident.edit', compact('incident', 'vehicles'));
    }

    public function update(Request $request, Incident $incident)
    {
        $request->validate([
            'location' => 'required|string',
            'datetime' => 'required|date|before:now',
            'description' => 'nullable|string',
            'vehicles' => 'required|array',
            'vehicles.*' => 'required|distinct|exists:vehicles,id',
        ]);

        // Update incident details
        $incident->update([
            'location' => $request->input('location'),
            'datetime' => $request->input('datetime'),
            'description' => $request->input('description'),
        ]);

        // Update vehicles assigned to the incident
        $incident->vehicles()->sync($request->input('vehicles'));

        return redirect()->route('admin.incident.edit', $incident->id)->with('success', 'Káresemény adatai sikeresen frissítve.');
    }

    // Remove incident
    public function destroy(Incident $incident)
    {
        // Remove vehicles assigned to the incident
        $incident->vehicles()->detach();

        // Remove the incident itself
        $incident->delete();

        return redirect()->route('admin.incident.index')->with('success', 'Káresemény sikeresen törölve.');
    }
}
