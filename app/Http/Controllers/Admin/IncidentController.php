<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;

class IncidentController extends Controller
{
    public function show(Incident $incident)
    {
        return view('incident.show', compact('incident'));
    }

    // Káresemény létrehozása
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

        // Hozzárendeljük a kiválasztott járműveket a káreseményhez
        $incident->vehicles()->attach($request->input('vehicles'));

        return redirect()->route('admin.incident.create')->with('success', 'Káresemény sikeresen létrehozva.');
    }

    // Káresemény szerkesztése
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

        // Frissítjük a káresemény adatait
        $incident->update([
            'location' => $request->input('location'),
            'datetime' => $request->input('datetime'),
            'description' => $request->input('description'),
        ]);

        // Káreseményhez hozzárendelt járművek frissítése
        $incident->vehicles()->sync($request->input('vehicles'));

        return redirect()->route('admin.incident.edit', $incident->id)->with('success', 'Káresemény adatai sikeresen frissítve.');
    }

    // Káresemény törlése
    public function destroy(Incident $incident)
    {
        // Törlés előtt a hozzárendelt járműveket is eltávolítjuk
        $incident->vehicles()->detach();

        // Töröljük magát a káreseményt
        $incident->delete();

        return redirect()->route('admin.incident.index')->with('success', 'Káresemény sikeresen törölve.');
    }
}
