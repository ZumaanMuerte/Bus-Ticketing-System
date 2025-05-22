<x-app-layout>
    <x-slot name="header" class='flex'>
        <h2 class="font-semibold text-xl text-black leading-tight">
            {{ __('👨‍✈️ Driver Management') }}
        </h2>
    </x-slot>

    <div class="p-6">
        <div class="bg-white shadow rounded-lg p-4">
            <div class="flex justify-between mb-4">
                <button onclick="openModal()" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded self-center">
                    + Add Driver
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
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search driver..." class="border rounded px-4 py-1">
                    <button type="submit" class="bg-blue-500 text-black px-4 py-1 rounded hover:bg-blue-600">Search</button>
                </form>
            </div>

            <table class="w-full text-left border-t border-gray-200">
                <thead class="bg-indigo-900 text-white">
                    <tr>
                        <th class="p-2">Driver ID</th>
                        <th class="p-2">Name</th>
                        <th class="p-2">Surname</th>
                        <th class="p-2">Age</th>
                        <th class="p-2">License No.</th>
                        <th class="p-2">Contact No.</th>
                        <th class="p-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($drivers as $driver)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="p-2">{{ $driver->DRIVER_ID }}</td>
                            <td class="p-2">{{ $driver->NAME }}</td>
                            <td class="p-2">{{ $driver->SURNAME }}</td>
                            <td class="p-2">{{ $driver->AGE }}</td>
                            <td class="p-2">{{ $driver->LICENSE_NO }}</td>
                            <td class="p-2">{{ $driver->CONTACT_NO }}</td>
                            <td class="p-2 flex gap-2">
                                <button onclick="openEditModal({{ json_encode($driver) }})" class="bg-yellow-500 hover:bg-yellow-600 text-white py-1 px-2 rounded">Edit</button>
                                <form action="{{ route('driver.destroy', $driver->DRIVER_ID) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-1 px-2 rounded">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $drivers->links() }}
            </div>
        </div>
    </div>

    <!-- Add Modal -->
    <div id="driverModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg w-full max-w-lg">
            <h3 class="text-lg font-semibold mb-4">Add New Driver</h3>
            <form action="{{ route('driver.store') }}" method="POST">
                @csrf
                <input type="number" name="DRIVER_ID" placeholder="Driver ID" class="w-full border mb-2 px-3 py-2 rounded" required>
                <input type="text" name="NAME" placeholder="Name" class="w-full border mb-2 px-3 py-2 rounded" required>
                <input type="text" name="SURNAME" placeholder="Surname" class="w-full border mb-2 px-3 py-2 rounded" required>
                <input type="number" name="AGE" placeholder="Age" class="w-full border mb-2 px-3 py-2 rounded" required>
                <input type="text" name="LICENSE_NO" placeholder="License No." class="w-full border mb-2 px-3 py-2 rounded" required>
                <input type="text" name="CONTACT_NO" placeholder="Contact No." class="w-full border mb-2 px-3 py-2 rounded" required>

                <div class="flex justify-end gap-2 mt-4">
                    <button type="button" onclick="closeModal()" class="bg-red-500 text-white px-4 py-2 rounded">Cancel</button>
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Add</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editDriverModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg w-full max-w-lg">
            <h3 class="text-lg font-semibold mb-4">Edit Driver</h3>
            <form id="editDriverForm" method="POST">
                @csrf
                @method('PUT')
                <input type="number" name="DRIVER_ID" id="edit_DRIVER_ID" placeholder="Driver ID" class="w-full border mb-2 px-3 py-2 rounded" readonly>
                <input type="text" name="NAME" id="edit_NAME" placeholder="Name" class="w-full border mb-2 px-3 py-2 rounded" required>
                <input type="text" name="SURNAME" id="edit_SURNAME" placeholder="Surname" class="w-full border mb-2 px-3 py-2 rounded" required>
                <input type="number" name="AGE" id="edit_AGE" placeholder="Age" class="w-full border mb-2 px-3 py-2 rounded" required>
                <input type="text" name="LICENSE_NO" id="edit_LICENSE_NO" placeholder="License No." class="w-full border mb-2 px-3 py-2 rounded" required>
                <input type="text" name="CONTACT_NO" id="edit_CONTACT_NO" placeholder="Contact No." class="w-full border mb-2 px-3 py-2 rounded" required>

                <div class="flex justify-end gap-2 mt-4">
                    <button type="button" onclick="closeEditModal()" class="bg-red-500 text-white px-4 py-2 rounded">Cancel</button>
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Update</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('driverModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('driverModal').classList.add('hidden');
        }

        function openEditModal(driver) {
            document.getElementById('editDriverModal').classList.remove('hidden');

            document.getElementById('edit_DRIVER_ID').value = driver.DRIVER_ID;
            document.getElementById('edit_NAME').value = driver.NAME;
            document.getElementById('edit_SURNAME').value = driver.SURNAME;
            document.getElementById('edit_AGE').value = driver.AGE;
            document.getElementById('edit_LICENSE_NO').value = driver.LICENSE_NO;
            document.getElementById('edit_CONTACT_NO').value = driver.CONTACT_NO;

            document.getElementById('editDriverForm').action = `/driver/${driver.DRIVER_ID}`;
        }

        function closeEditModal() {
            document.getElementById('editDriverModal').classList.add('hidden');
        }
    </script>
</x-app-layout>
