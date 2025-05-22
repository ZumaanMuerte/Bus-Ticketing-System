<?php

// app/Http/Controllers/InBusEmployeeController.php
namespace App\Http\Controllers;

use App\Models\InBusEmployee;
use Illuminate\Http\Request;

class InBusEmployeeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $employee = InBusEmployee::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                         ->orWhere('license_no', 'like', "%{$search}%")
                         ->orWhere('in_bus_role', 'like', "%{$search}%");
        })->paginate(10);

        return view('in_bus_employees.index', compact('employee', 'search'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'license_no' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'age' => 'required|integer',
            'contact_no' => 'required|string|max:20',
            'in_bus_role' => 'required|in:Driver,Conductor',
        ]);

        InBusEmployee::create($validated);

        return redirect()->route('in_bus_employees.index')->with('success', 'Employee added successfully.');
    }
    public function create()
    {
        return view('in_bus_employees.index');
    }
    public function edit(Request $request, $id)
    {
        $validated = $request->validate([
            'license_no' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'age' => 'required|integer',
            'contact_no' => 'required|string|max:20',
            'in_bus_role' => 'required|in:Driver,Konductor',
        ]);

        $employee = InBusEmployee::findOrFail($id);
        $employee->update($validated);

        return redirect()->route('in_bus_employees.index')->with('success', 'Employee updated successfully.');
    }
    public function show(InBusEmployee $in_bus_employee)
    {
        return view('in_bus_employees.index', compact('in_bus_employee'));
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'license_no' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'age' => 'required|integer',
            'contact_no' => 'required|string|max:20',
            'in_bus_role' => 'required|in:Driver,Konductor',
        ]);

        $employee = InBusEmployee::findOrFail($id);
        $employee->update($validated);

        return redirect()->route('in_bus_employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy(InBusEmployee $in_bus_employee)
    {
        $in_bus_employee->delete();
        return redirect()->route('in_bus_employees.index')->with('success', 'Employee deleted.');
    }
}

