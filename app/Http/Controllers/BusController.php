<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use Illuminate\Http\Request;

class BusController extends Controller
{

    public function index(Request $request)
    {
        // Change destinations to locations for consistency
        $locations = ['Cagayan de Oro City','Malaybalay', 'Gingoog', 'Butuan', 'Davao City', 'Surigao City', 'Surigao Sur'];
        $search = $request->input('search');

        $buses = Bus::when($search, function ($query, $search) {
            return $query->where('capacity', 'like', "%$search%")
                         ->orWhere('bus_number', 'like', "%$search%") // Add bus_number search
                         ->orWhere('current_location', 'like', "%$search%"); // Update to current_location
        })->paginate(10);

        return view('bus.index', compact('buses', 'locations', 'search')); // Update variable name
    }

    public function store(Request $request)
    {
        $request->validate([
            'bus_number' => 'required|string', // Add bus_number validation
            'bus_type' => 'required|string',
            'capacity' => 'required|integer',
            'current_location' => 'required|string', // Update to current_location
        ]);

        Bus::create([
            'bus_number' => $request->bus_number, // Store bus_number
            'bus_type' => $request->bus_type,
            'capacity' => $request->capacity,
            'current_location' => $request->current_location, // Update to current_location
        ]);

        return redirect()->route('bus.index')->with('success', 'Bus added successfully');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'bus_number' => 'required|string', // Add bus_number validation
            'bus_type' => 'required|string',
            'capacity' => 'required|integer',
            'current_location' => 'required|string', // Update to current_location
        ]);

        $bus = Bus::findOrFail($id);
        $bus->update([
            'bus_number' => $request->bus_number, // Update bus_number
            'bus_type' => $request->bus_type,
            'capacity' => $request->capacity,
            'current_location' => $request->current_location, // Update to current_location
        ]);

        return redirect()->route('bus.index')->with('success', 'Bus updated successfully');
    }
    public function destroy($id)
    {
        Bus::findOrFail($id)->delete();
        return redirect()->route('bus.index')->with('success', 'Bus deleted');
    }
}

