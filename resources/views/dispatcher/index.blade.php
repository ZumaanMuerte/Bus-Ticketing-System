<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('🗺️ Bus Dispatch Management') }}
        </h2>
    </x-slot>

    <div class="p-6">
        <div class="bg-white p-4 rounded-lg shadow">
            <h3 class="text-lg font-bold mb-4">Assign or Update Bus Location</h3>

            @if(session('success'))
                <div class="mb-4 text-green-600 font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            <table class="w-full text-left border-t border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-2">Bus Number</th>
                        <th class="p-2">Type</th>
                        <th class="p-2">Current Location</th>
                        <th class="p-2">Last Access</th>
                        <th class="p-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($buses as $bus)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="p-2">{{ $bus->bus_number }}</td>
                            <td class="p-2">{{ $bus->bus_type }}</td>
                            <td class="p-2">{{ $bus->current_location ?? '—' }}</td>
                            <td class="p-2">
                                    {{ $bus->last_accessed_at ? \Carbon\Carbon::parse($bus->last_accessed_at)->format('Y-m-d H:i') : '—' }}
                            </td>
                            <td class="p-2">
                                <button onclick="openDispatchModal({{ $bus }})"  class="bg-indigo-500 hover:bg-indigo-600 text-black py-1 px-3 rounded">
                                    Update
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Dispatch Update Modal -->
    <div id="dispatchModal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center">
        <div class="bg-white rounded-lg p-6 w-full max-w-md">
            <h3 class="text-xl font-bold mb-4">Update Bus Location</h3>
            <form method="POST" id="dispatchForm">
                @csrf
                @method('PUT')
                <select name="current_location" id="edit_current_location" class="w-full border mb-2 px-3 py-2 rounded" required>
                    <option value="">Select Location</option>
                    @foreach($locations as $city)
                        <option value="{{ $city }}">{{ $city }}</option>
                    @endforeach
                </select>

                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeDispatchModal()" class="bg-red-500 text-white px-4 py-2 rounded">
                        Cancel
                    </button>
                    <button type="submit" class="bg-green-500 text-black px-4 py-2 rounded">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        function openDispatchModal(bus) {
            const modal = document.getElementById('dispatchModal');
            modal.classList.remove('hidden');
            document.getElementById('edit_current_location').value = bus.current_location ?? '';
            document.getElementById('dispatchForm').action = `/dispatcher/${bus.id}`;
        }

        function closeDispatchModal() {
            document.getElementById('dispatchModal').classList.add('hidden');
        }
    </script>
</x-app-layout>
