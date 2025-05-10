<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use Illuminate\Http\Request;

class BusController extends Controller
{
    public function index(Request $request)
    {
        $destinations = ['Malaybay','Gingoog', 'Butuan', 'Davao City', 'Surigao City', 'Surigao Sur'];
        $search = $request->input('search');

        $buses = Bus::when($search, function ($query, $search) {
            return $query->where('capacity', 'like', "%$search%")
                         ->orWhere('destination', 'like', "%$search%");
        })->paginate(10);

        return view('bus.index', compact('buses', 'destinations', 'search'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bus_id' => 'required|string',
            'bus_type' => 'required|string',
            'capacity' => 'required|integer',
            'destination' => 'required|string',
        ]);

        Bus::create($request->all());
        return redirect()->route('bus.index')->with('success', 'Bus added successfully');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'bus_id' => 'required|string',
            'bus_type' => 'required|string',
            'capacity' => 'required|integer',
            'destination' => 'required|string',
        ]);

        $bus = Bus::findOrFail($id);
        $bus->update($request->all());
        return redirect()->route('bus.index')->with('success', 'Bus updated successfully');
    }

    public function destroy($id)
    {
        Bus::findOrFail($id)->delete();
        return redirect()->route('bus.index')->with('success', 'Bus deleted');
    }
}
