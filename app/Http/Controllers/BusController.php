<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use Illuminate\Http\Request;

class BusController extends Controller
{
    public function index(Request $request)
    {
        // Change destinations to locations for consistency
        $locations = ['Malaybalay', 'Gingoog', 'Butuan', 'Davao City', 'Surigao City', 'Surigao Sur'];
        $search = $request->input('search');

        $buses = Bus::when($search, function ($query, $search) {
            return $query->where('capacity', 'like', "%$search%")
                         ->orWhere('current_location', 'like', "%$search%"); // Update to current_location
        })->paginate(10);

        return view('bus.index', compact('buses', 'locations', 'search')); // Update variable name
    }

    public function store(Request $request)
    {
        $request->validate([
            'bus_id' => 'required|string',
            'bus_type' => 'required|string',
            'capacity' => 'required|integer',
            'current_location' => 'required|string', // Update to current_location
            'bus_number' => 'required|string', // Add bus_number validation
        ]);

        Bus::create([
            'bus_id' => $request->bus_id,
            'bus_type' => $request->bus_type,
            'capacity' => $request->capacity,
            'current_location' => $request->current_location, // Update to current_location
            'bus_number' => $request->bus_number, // Store bus_number
        ]);

        return redirect()->route('bus.index')->with('success', 'Bus added successfully');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'bus_id' => 'required|string',
            'bus_type' => 'required|string',
            'capacity' => 'required|integer',
            'current_location' => 'required|string', // Update to current_location
            'bus_number' => 'required|string', // Add bus_number validation
        ]);

        $bus = Bus::findOrFail($id);
        $bus->update([
            'bus_id' => $request->bus_id,
            'bus_type' => $request->bus_type,
            'capacity' => $request->capacity,
            'current_location' => $request->current_location, // Update to current_location
            'bus_number' => $request->bus_number, // Update bus_number
        ]);

        return redirect()->route('bus.index')->with('success', 'Bus updated successfully');
    }

    public function destroy($id)
    {
        Bus::findOrFail($id)->delete();
        return redirect()->route('bus.index')->with('success', 'Bus deleted');
    }
}

