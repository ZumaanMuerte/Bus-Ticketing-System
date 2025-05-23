<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ticket Pricing') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto">
        <div class="flex justify-between mb-4">
            <button onclick="openModal('addModal')" class="bg-blue-600 text-white px-4 py-2 rounded">Add Ticket Price</button>
            <a href="{{ route('ticket.price.pdf') }}" class="bg-red-600 text-white px-4 py-2 rounded">Print PDF</a>
        </div>

        <table class="min-w-full bg-white shadow-md rounded">
            <thead>
                <tr>
                    <th class="px-4 py-2">Bus Type</th>
                    <th class="px-4 py-2">Bus Stop</th>
                    <th class="px-4 py-2">Base Fare</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ticketPrices as $price)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $price->bus_type }}</td>
                    <td class="px-4 py-2">{{ $price->bus_stop }}</td>
                    <td class="px-4 py-2">{{ $price->base_fare }}</td>
                    <td class="px-4 py-2 space-x-2">
                        <button onclick="openEditModal({{ $price }})" class="bg-yellow-500 text-white px-3 py-1 rounded">Edit</button>
                        <form action="{{ route('price.destroy', $price->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Are you sure?')" class="bg-red-600 text-white px-3 py-1 rounded">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $ticketPrices->links() }}
        </div>
    </div>

    {{-- Add Modal --}}
    <div id="addModal" class="fixed inset-0 hidden bg-black bg-opacity-50 flex justify-center items-center z-50">
        <div class="bg-white rounded p-6 w-full max-w-md">
            <h3 class="text-lg font-bold mb-4">Add Ticket Price</h3>
            <form action="{{ route('price.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block mb-1">Bus Type</label>
                    <select name="bus_type" class="w-full border rounded px-3 py-2">
                        <option value="air-condition">Air-Condition</option>
                        <option value="non-air-condition">Non-Air-Condition</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block mb-1">Bus Stop</label>
                    <select name="bus_stop" class="w-full border rounded px-3 py-2">
                        <option value="non-stop">Non-Stop</option>
                        <option value="provincial">Provincial</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block mb-1">Base Fare</label>
                    <input type="number" name="base_fare" step="0.01" class="w-full border rounded px-3 py-2">
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="closeModal('addModal')" class="mr-2 bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Save</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Edit Modal --}}
    <div id="editModal" class="fixed inset-0 hidden bg-black bg-opacity-50 flex justify-center items-center z-50">
        <div class="bg-white rounded p-6 w-full max-w-md">
            <h3 class="text-lg font-bold mb-4">Edit Ticket Price</h3>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block mb-1">Base Fare</label>
                    <input type="number" name="base_fare" id="editBaseFare" step="0.01" class="w-full border rounded px-3 py-2">
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="closeModal('editModal')" class="mr-2 bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
                    <button type="submit" class="bg-yellow-600 text-white px-4 py-2 rounded">Update</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Scripts --}}
    <script>
        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
        }

        function openEditModal(price) {
            const form = document.getElementById('editForm');
            form.action = `/ticket/price/${price.id}`;
            document.getElementById('editBaseFare').value = price.base_fare;
            openModal('editModal');
        }
    </script>
</x-app-layout>
