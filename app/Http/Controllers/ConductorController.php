<?php

namespace App\Http\Controllers;

use App\Models\Conductor;
use Illuminate\Http\Request;

class ConductorController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $conductors = Conductor::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%$search%")
                         ->orWhere('surname', 'like', "%$search%")
                         ->orWhere('license_no', 'like', "%$search%");
        })->paginate(10);

        return view('conductor.index', compact('conductors', 'search'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'conductor_id' => 'required|numeric|unique:conductors,conductor_id',
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'age' => 'required|integer|min:18',
            'license_no' => 'required|string|max:255',
            'contact_no' => 'required|string|max:20',
        ]);

        Conductor::create($request->all());

        return redirect()->route('conductor.index')->with('success', 'Conductor added successfully.');
    }

    public function update(Request $request, $id)
    {
        $conductor = Conductor::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'age' => 'required|integer|min:18',
            'license_no' => 'required|string|max:255',
            'contact_no' => 'required|string|max:20',
        ]);

        $conductor->update($request->all());

        return redirect()->route('conductor.index')->with('success', 'Conductor updated successfully.');
    }

    public function destroy($id)
    {
        Conductor::findOrFail($id)->delete();

        return redirect()->route('conductor.index')->with('success', 'Conductor deleted successfully.');
    }
}
