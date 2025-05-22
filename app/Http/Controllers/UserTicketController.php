<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\Location;
use App\Models\UserTicket;
use Illuminate\Http\Request;
use App\Helpers\FareCalculator;
use Illuminate\Support\Str;

class UserTicketController extends Controller
{
    public function create()
    {
        $locations = Location::all();
        return view('tickets.create', compact('locations'));
    }

    public function searchBuses(Request $request)
    {
        $request->validate([
            'location' => 'required|exists:locations,id',
            'destination' => 'required|exists:locations,id',
            'bus_type' => 'required|string',
            'bus_stop' => 'required|string',
        ]);

        $buses = Bus::where('current_location', $request->location)
            ->where('bus_aircon', $request->bus_type)
            ->where('bus_stop', $request->bus_stop)
            ->get();

        $baseFare = FareCalculator::calculate($request->location, $request->destination);

        $results = $buses->map(function ($bus) use ($baseFare, $request) {
            $finalFare = match ($request->discount) {
                'student', 'pwd', 'senior' => $baseFare * 0.8,
                default => $baseFare,
            };

            return [
                'bus' => $bus,
                'base_fare' => $baseFare,
                'final_fare' => $finalFare,
            ];
        });

        return view('tickets.select', [
            'results' => $results,
            'request' => $request,
        ]);
    }

    public function bookTicket(Request $request)
    {
        $request->validate([
            'bus_id' => 'required|exists:buses,id',
            'location' => 'required|exists:locations,id',
            'destination' => 'required|exists:locations,id',
            'discount' => 'nullable|in:student,pwd,senior,none',
        ]);

        $fare = FareCalculator::calculate($request->location, $request->destination);

        $finalFare = match ($request->discount) {
            'student', 'pwd', 'senior' => $fare * 0.8,
            default => $fare,
        };

        $ticket = UserTicket::create([
            'ticket_number' => 'TIX-' . strtoupper(Str::random(8)),
            'user_id' => auth()->id(),
            'bus_id' => $request->bus_id,
            'date' => now(),
            'location_id' => $request->location,
            'destination_id' => $request->destination,
            'discount' => $request->discount ?? 'none',
            'final_fare' => $finalFare,
        ]);

        return redirect()->route('tickets.show', $ticket->id)->with('success', 'Ticket booked successfully!');
    }

    public function show($id)
    {
        $ticket = UserTicket::with(['bus', 'location', 'destination'])->findOrFail($id);
        return view('tickets.show', compact('ticket'));
    }
}
