<x-app-layout>
    <x-slot name="header" class='flex'>
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('🚌 Route & Schedule Management') }}
        </h2>
    </x-slot>

    <div class="p-6">
        <div class="bg-white shadow rounded-lg p-4">

            <div class="flex items-center mb-4">
                <button onclick="openModal()"
                    class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                    + Add Bus
                </button>
            </div>

            @if(session('success'))
                <div class="mb-4 text-green-600 font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 text-red-600">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="text-sm">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mb-4">
                <form method="GET" action="" class="flex gap-2">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search bus..."
                        class="border rounded px-4 py-1">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-black px-4 py-1 rounded">Search</button>
                </form>
            </div>

            <table class="w-full text-left border-t border-gray-200">
                <thead class="bg-indigo-900 text-white">
                    <tr>
                        <th class="p-2">Bus Number</th> <!-- NEW -->
                        <th class="p-2">Bus Type</th>
                        <th class="p-2">Capacity</th>
                        <th class="p-2">Current Location</th> <!-- UPDATED -->
                        <th class="p-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($buses as $bus)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="p-2">{{ $bus->bus_number }}</td> <!-- NEW -->
                            <td class="p-2">{{ $bus->bus_type }}</td>
                            <td class="p-2">{{ $bus->capacity }}</td>
                            <td class="p-2">{{ $bus->current_location }}</td> <!-- UPDATED -->
                            <td class="p-2 flex gap-2">
                                <button type="button" onclick='openEditModal(@json($bus))'
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white py-1 px-2 rounded">Edit</button>
                                <form action="{{ route('bus.destroy', $bus->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-600 text-white py-1 px-2 rounded">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $buses->links() }}
            </div>
        </div>
    </div>

    <!-- Add Modal -->
    <div id="busModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg w-full max-w-lg">
            <h3 class="text-lg font-semibold mb-4">Add New Bus Data</h3>
            <form action="{{ route('bus.store') }}" method="POST">
                @csrf
                <input type="text" name="bus_number" placeholder="Bus Number (e.g. 034F)"
                    class="w-full border mb-2 px-3 py-2 rounded" required>
                <input type="text" name="bus_type" placeholder="Bus Type" class="w-full border mb-2 px-3 py-2 rounded"
                    required>
                <input type="number" name="capacity" placeholder="Capacity" class="w-full border mb-2 px-3 py-2 rounded"
                    required>

                <select name="current_location" class="w-full border mb-2 px-3 py-2 rounded" required>
                    <option value="">Select Location</option>
                    @foreach($locations as $city)
                        <option value="{{ $city }}">{{ $city }}</option>
                    @endforeach
                </select>

                <div class="flex justify-end gap-2 mt-4">
                    <button type="button" onclick="closeModal()"
                        class="bg-red-500 text-white px-4 py-2 rounded">Cancel</button>
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Add</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editBusModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg w-full max-w-lg">
            <h3 class="text-lg font-semibold mb-4">Edit Bus</h3>
            <form id="editBusForm" method="POST" action="">
                @csrf
                @method('PUT')

                <input type="text" name="bus_number" id="edit_bus_number" placeholder="Bus Number"
                    class="w-full border mb-2 px-3 py-2 rounded" required>

                <input type="text" name="bus_type" id="edit_bus_type" placeholder="Bus Type"
                    class="w-full border mb-2 px-3 py-2 rounded" required>

                <input type="number" name="capacity" id="edit_capacity" placeholder="Capacity"
                    class="w-full border mb-2 px-3 py-2 rounded" required>

                <select name="current_location" id="edit_current_location" class="w-full border mb-2 px-3 py-2 rounded"
                    required>
                    <option value="">Select Location</option>
                    @foreach($locations as $city)
                        <option value="{{ $city }}">{{ $city }}</option>
                    @endforeach
                </select>

                <div class="flex justify-end gap-2 mt-4">
                    <button type="button" onclick="closeEditModal()"
                        class="bg-red-500 text-white px-4 py-2 rounded">Cancel</button>
                    <button type="submit" class="bg-green-500 text-black px-4 py-2 rounded">Update</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const updateRouteTemplate = "{{ url(path: 'bus') }}/";

        // Add Modal open/close
        function openModal() {
            document.getElementById('busModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('busModal').classList.add('hidden');
        }

        // Edit Modal open/close + populate
        function openEditModal(bus) {
            const modal = document.getElementById('editBusModal');
            modal.classList.remove('hidden');

            document.getElementById('edit_bus_number').value = bus.bus_number;
            document.getElementById('edit_bus_type').value = bus.bus_type;
            document.getElementById('edit_capacity').value = bus.capacity;
            document.getElementById('edit_current_location').value = bus.current_location ?? '';

            const form = document.getElementById('editBusForm');
            form.action = updateRouteTemplate + bus.id;
        }

        function closeEditModal() {
            document.getElementById('editBusModal').classList.add('hidden');
        }
    </script>

</x-app-layout>
