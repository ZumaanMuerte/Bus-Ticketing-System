<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('🚌 In-Bus Employees') }}
        </h2>
    </x-slot>

    <div class="py-6 px-4">

        {{-- Success message --}}
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        {{-- Top controls --}}
        <div class="flex justify-between items-center mb-4">
            <button onclick="openModal()" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                + Add Employee
            </button>

            <form method="GET" action="{{ route('in_bus_employees.index') }}" class="flex">
                <input type="text" name="search" placeholder="Search..." class="rounded-l px-3 py-2 border border-gray-300 focus:outline-none">
                <button type="submit" class="bg-gray-500 hover:bg-gray-600 text-white px-4 rounded-r">
                    Search
                </button>
            </form>
        </div>

        {{-- Table --}}
        <div class="bg-white overflow-x-auto shadow rounded-lg">
            <table class="w-full text-left border-t border-gray-200">
                <thead class="bg-indigo-900 text-white">
                    <tr>
                        <th class="px-6 py-3 font-semibold">License No.</th>
                        <th class="px-6 py-3 font-semibold">Name</th>
                        <th class="px-6 py-3 font-semibold">Age</th>
                        <th class="px-6 py-3 font-semibold">Contact No.</th>
                        <th class="px-6 py-3 font-semibold">Role</th>
                        <th class="px-6 py-3 font-semibold text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employee as $worker)
                        <tr class="border-b">
                            <td class="px-6 py-4">{{ $worker->license_no }}</td>
                            <td class="px-6 py-4">{{ $worker->name }}</td>
                            <td class="px-6 py-4">{{ $worker->age }}</td>
                            <td class="px-6 py-4">{{ $worker->contact_no }}</td>
                            <td class="px-6 py-4">{{ $worker->in_bus_role }}</td>
                            <td class="px-6 py-4 text-center">
                                <button onclick="openEditModal({{ $worker->id }}, '{{ $worker->license_no }}', '{{ $worker->name }}', {{ $worker->age }}, '{{ $worker->contact_no }}', '{{ $worker->role }}')"
                                    class="text-green-600 hover:underline mr-3">Edit</button>
                                <form action="{{ route('in_bus_employees.destroy', $worker->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure?')" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $employee->links() }}
        </div>
    </div>

    {{-- Add Modal --}}
    <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-lg w-full max-w-lg">
            <h2 class="text-xl font-semibold mb-4">Add Employee</h2>
            <form method="POST" action="{{ route('in_bus_employees.store') }}">
                @csrf
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label>License No.</label>
                        <input type="text" name="license_no" class="w-full border rounded px-2 py-1" required>
                    </div>
                    <div>
                        <label>Name</label>
                        <input type="text" name="name" class="w-full border rounded px-2 py-1" required>
                    </div>
                    <div>
                        <label>Age</label>
                        <input type="number" name="age" class="w-full border rounded px-2 py-1" required>
                    </div>
                    <div>
                        <label>Contact No.</label>
                        <input type="text" name="contact_no" class="w-full border rounded px-2 py-1" required>
                    </div>
                    <div class="col-span-2">
                        <label>Role</label>
                        <select name="in_bus_role" class="w-full border rounded px-2 py-1" required>
                            <option value="Driver">Driver</option>
                            <option value="Konductor">Konductor</option>
                        </select>
                    </div>
                </div>
                <div class="mt-4 flex justify-end">
                    <button type="button" onclick="closeModal()" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Cancel</button>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Save</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Edit Modal --}}
    <div id="edit-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-lg w-full max-w-lg">
            <h2 class="text-xl font-semibold mb-4">Edit Employee</h2>
            <form method="POST" action="" onsubmit="updateFormAction(this)">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit-id">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label>License No.</label>
                        <input type="text" name="license_no" id="edit-license_no" class="w-full border rounded px-2 py-1" required>
                    </div>
                    <div>
                        <label>Name</label>
                        <input type="text" name="name" id="edit-name" class="w-full border rounded px-2 py-1" required>
                    </div>
                    <div>
                        <label>Age</label>
                        <input type="number" name="age" id="edit-age" class="w-full border rounded px-2 py-1" required>
                    </div>
                    <div>
                        <label>Contact No.</label>
                        <input type="text" name="contact_no" id="edit-contact_no" class="w-full border rounded px-2 py-1" required>
                    </div>
                    <div class="col-span-2">
                        <label>Role</label>
                        <select name="in_bus_role" id="edit-role" class="w-full border rounded px-2 py-1" required>
                            <option value="Driver">Driver</option>
                            <option value="konductor">Konductor</option>
                        </select>
                    </div>
                </div>
                <div class="mt-4 flex justify-end">
                    <button type="button" onclick="closeEditModal()" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Cancel</button>
                    <button type="submit" class="bg-blue-600 text-black px-4 py-2 rounded">Update</button>
                </div>
            </form>
        </div>
    </div>

    {{-- JS Scripts --}}
    <script>
        function openModal() {
            document.getElementById('modal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('modal').classList.add('hidden');
        }

        function openEditModal(id, license_no, name, age, contact_no, in_bus_role) {
            document.getElementById('edit-modal').classList.remove('hidden');
            document.getElementById('edit-id').value = id;
            document.getElementById('edit-license_no').value = license_no;
            document.getElementById('edit-name').value = name;
            document.getElementById('edit-age').value = age;
            document.getElementById('edit-contact_no').value = contact_no;
            document.getElementById('edit-role').value = in_bus_role;

            // Update the form's action URL
            const form = document.querySelector('#edit-modal form');
            form.action = `/in_bus_employees/${id}`;
        }

        function closeEditModal() {
            document.getElementById('edit-modal').classList.add('hidden');
        }
    </script>
</x-app-layout>
