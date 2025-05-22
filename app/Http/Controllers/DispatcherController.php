<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use Illuminate\Http\Request;

class DispatcherController extends Controller
{
    public function index()
    {
        $buses = Bus::paginate(10);
        $locations = ['Malaybalay', 'Gingoog', 'Butuan', 'Davao City', 'Surigao City', 'Surigao Sur'];

        return view('dispatcher.index', compact('buses', 'locations'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'current_location' => 'required|string'
        ]);

        $bus = Bus::findOrFail($id);
        $bus->update([
            'current_location' => $request->current_location,
            'last_accessed_at' => now()
        ]);

        return redirect()->route('dispatcher.index')->with('success', 'Bus location updated.');
    }
}
