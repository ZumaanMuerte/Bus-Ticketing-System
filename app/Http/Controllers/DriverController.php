<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $drivers = Driver::when($search, function ($query, $search) {
            return $query->where('NAME', 'like', "%$search%")
                         ->orWhere('SURNAME', 'like', "%$search%")
                         ->orWhere('LICENSE_NO', 'like', "%$search%");
        })->paginate(10);

        return view('driver.index', compact('drivers', 'search'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'DRIVER_ID' => 'required|integer|unique:drivers,DRIVER_ID',
            'NAME' => 'required|string|max:255',
            'SURNAME' => 'required|string|max:255',
            'AGE' => 'required|integer|min:18',
            'LICENSE_NO' => 'required|string|max:255',
            'CONTACT_NO' => 'required|string|max:20',
        ]);

        Driver::create($validated);

        return redirect()->route('driver.index')->with('success', 'Driver added successfully.');
    }

    public function update(Request $request, $id)
    {
        $driver = Driver::findOrFail($id);

        $validated = $request->validate([
            'NAME' => 'required|string|max:255',
            'SURNAME' => 'required|string|max:255',
            'AGE' => 'required|integer|min:18',
            'LICENSE_NO' => 'required|string|max:255',
            'CONTACT_NO' => 'required|string|max:20',
        ]);

        $driver->update($validated);

        return redirect()->route('driver.index')->with('success', 'Driver updated successfully.');
    }

    public function destroy($id)
    {
        Driver::findOrFail($id)->delete();
        return redirect()->route('driver.index')->with('success', 'Driver deleted successfully.');
    }
}
