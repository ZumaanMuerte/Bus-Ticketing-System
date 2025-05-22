<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-white leading-tight">
            {{ __('Ticket Sales') }}
        </h2>
    </x-slot>

    <div class="py-4 px-6">
        <!-- Search Form -->
        <form method="GET" action="{{ route('sales.index') }}" class="mb-4">
            <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}"
                   class="rounded px-4 py-2 border border-gray-300 w-1/3" />
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded ml-2">
                Search
            </button>
        </form>

        <!-- Success Message -->
        @if (session('success'))
            <div class="mb-4 text-green-600 font-medium">
                {{ session('success') }}
            </div>
        @endif

        <!-- Table Display -->
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="px-4 py-2 text-left">Date</th>
                        <th class="px-4 py-2 text-left">Bus ID</th>
                        <th class="px-4 py-2 text-left">Driver</th>
                        <th class="px-4 py-2 text-left">Konductor</th>
                        <th class="px-4 py-2 text-left">Passengers</th>
                        <th class="px-4 py-2 text-left">Fare (₱)</th>
                        <th class="px-4 py-2 text-left">Total Daily Sales (₱)</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($ticketSales as $sale)
                        <tr>
                            <td class="px-4 py-2">{{ $sale->date }}</td>
                            <td class="px-4 py-2">{{ $sale->bus ? $sale->bus->bus_id : 'N/A' }}</td>
                            <td class="px-4 py-2">{{ $sale->driver ? $sale->driver->name : 'N/A' }}</td>
                            <td class="px-4 py-2">{{ $sale->konductor ? $sale->konductor->name : 'N/A' }}</td>
                            <td class="px-4 py-2">{{ $sale->total_passengers }}</td>
                            <td class="px-4 py-2">
                                {{ $sale->fare !== null ? number_format($sale->fare, 2) : 'No Price' }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $sale->daily_sales !== null ? number_format($sale->daily_sales, 2) : '0.00' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center px-4 py-4 text-gray-500">
                                No ticket sales found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $ticketSales->appends(request()->input())->links() }}
        </div>
    </div>
</x-app-layout>
