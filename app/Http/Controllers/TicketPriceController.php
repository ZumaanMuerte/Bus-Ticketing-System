<?php

namespace App\Http\Controllers;

use App\Models\TicketPrice;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class TicketPriceController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $ticketPrices = TicketPrice::when($search, function ($query, $search) {
            return $query->where('bus_type', 'like', "%{$search}%")
                         ->orWhere('bus_stop', 'like', "%{$search}%");
        })->paginate(10);

        return view('ticket/price.index', compact('ticketPrices', 'search'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bus_type' => 'required',
            'bus_stop' => 'required',
            'base_fare' => 'required|numeric'
        ]);

        TicketPrice::create($request->all());
        return redirect()->route('ticket/price.index')->with('success', 'Added successfully.');
    }

    public function update(Request $request, TicketPrice $ticketPrice)
    {
        $request->validate([
            'bus_type' => 'required',
            'bus_stop' => 'required',
            'base_fare' => 'required|numeric'
        ]);

        $ticketPrice->update($request->all());
        return redirect()->route('ticket/price.index')->with('success', 'Updated successfully.');
    }

    public function destroy(TicketPrice $ticketPrice)
    {
        $ticketPrice->delete();
        return redirect()->route('ticket/price.index')->with('success', 'Deleted successfully.');
    }

    public function exportPDF(Request $request)
    {
        $data = TicketPrice::all();
        $pdf = PDF::loadView('ticket/price.pdf', compact('data'));
        return $pdf->download('ticket_prices.pdf');
    }
}
