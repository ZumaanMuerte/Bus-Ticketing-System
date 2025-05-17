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
                        <tr>
                            <td class="p-2">{{ $bus->bus_number }}</td>
                            <td class="p-2">{{ $bus->bus_type }}</td>
                            <td class="p-2">{{ $bus->current_location }}</td>
                            <td class="p-2">{{ $bus->last_accessed_at ?? '—' }}</td>
                            <td class="p-2">
                                <!-- Modal Trigger -->
                                <button onclick="document.getElementById('modal-{{ $bus->id }}').classList.remove('hidden')" class="bg-blue-500 text-black px-3 py-1 rounded hover:bg-blue-600">Edit</button>

                                <!-- Modal -->
                                <div id="modal-{{ $bus->id }}" class="fixed inset-0 bg-black bg-opacity-30 flex items-center justify-center hidden z-50">
                                    <div class="bg-white p-6 rounded shadow max-w-md w-full relative">
                                        <h2 class="text-xl font-semibold mb-4">Update Bus Location</h2>

                                        <form action="{{ route('dispatcher.update', $bus->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <label class="block mb-2 font-medium">Current Location:</label>
                                            <select name="current_location" class="w-full border-gray-300 rounded mb-4">
                                                @foreach ($locations as $location)
                                                    <option value="{{ $location }}" {{ $location == $bus->current_location ? 'selected' : '' }}>
                                                        {{ $location }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            <div class="flex justify-end gap-2">
                                                <button type="button" onclick="document.getElementById('modal-{{ $bus->id }}').classList.add('hidden')" class="bg-gray-300 px-3 py-1 rounded">Cancel</button>
                                                <button type="submit" class="bg-green-500 text-black px-3 py-1 rounded hover:bg-green-600">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
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
</x-app-layout>
