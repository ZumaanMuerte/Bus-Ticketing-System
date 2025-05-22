<?php

namespace App\Http\Controllers;

use App\Models\TicketSales;
use App\Models\TicketPrice;
use Illuminate\Http\Request;

class TicketSalesController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $ticketSales = TicketSales::with(['bus', 'driver', 'konductor'])
            ->when($search, function ($query, $search) {
                $query->whereHas('bus', function ($q) use ($search) {
                    $q->where('bus_id', 'like', '%' . $search . '%')
                    ->orWhere('bus_aircon', 'like', '%' . $search . '%')
                    ->orWhere('bus_stop', 'like', '%' . $search . '%')
                    ->orWhere('current_location', 'like', '%' . $search . '%');
                })->orWhereHas('driver', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                })->orWhereHas('konductor', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                })->orWhere('date', 'like', '%' . $search . '%');
            })
            ->latest()
            ->paginate(10);

        // Compute fare and daily sales
        foreach ($ticketSales as $sale) {
            $sale->fare = null;
            $sale->daily_sales = 0;

            if ($sale->bus) {
                // Get fare
                $price = \App\Models\TicketPrice::where('bus_type', $sale->bus->bus_aircon)
                    ->where('bus_stop', $sale->bus->bus_stop)
                    ->first();

                $sale->fare = $price ? $price->base_fare : null;

                // Get total sales for this bus on the same date
                $sale->daily_sales = \App\Models\TicketSales::where('bus_id', $sale->bus->id)
                    ->whereDate('date', $sale->date)
                    ->sum('sales');
            }
        }

        return view('ticket/sales.index', compact('ticketSales', 'search'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'bus_id' => 'required|exists:buses,id',
            'driver_id' => 'required|exists:in_bus_employees,id',
            'konductor_id' => 'required|exists:in_bus_employees,id',
            'date' => 'required|date',
            'total_passengers' => 'required|integer',
            'sales' => 'required|numeric',
        ]);

        TicketSales::create($request->all());

        return redirect()->route('ticket/sales.index')->with('success', 'Ticket sale added successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'bus_id' => 'required|exists:buses,id',
            'driver_id' => 'required|exists:in_bus_employees,id',
            'konductor_id' => 'required|exists:in_bus_employees,id',
            'date' => 'required|date',
            'total_passengers' => 'required|integer',
            'sales' => 'required|numeric',
        ]);

        $ticketSale = TicketSales::findOrFail($id);
        $ticketSale->update($request->all());

        return redirect()->route('ticket/sales.index')->with('success', 'Ticket sale updated successfully.');
    }

    public function destroy($id)
    {
        $ticketSale = TicketSales::findOrFail($id);
        $ticketSale->delete();

        return redirect()->route('ticket/sales.index')->with('success', 'Ticket sale deleted successfully.');
    }
}
