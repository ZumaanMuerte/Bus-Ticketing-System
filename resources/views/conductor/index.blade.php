<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black leading-tight">
            {{ __('Conductor') }}
        </h2>
    </x-slot>

    <div class="p-6">
        <div class="bg-white shadow rounded-lg p-4">
            <div class="flex justify-between mb-4">
                <button onclick="openModal()" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded self-center">
                    + Add Conductor
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
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search conductor..." class="border rounded px-4 py-1">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-1 rounded hover:bg-blue-600">Search</button>
                </form>
            </div>

            <table class="w-full text-left border-t border-gray-200">
                <thead class="bg-indigo-900 text-white">
                    <tr>
                        <th class="p-2">Conductor's ID</th>
                        <th class="p-2">NAME</th>
                        <th class="p-2">SURNAME</th>
                        <th class="p-2">AGE</th>
                        <th class="p-2">LICENSE NO.</th>
                        <th class="p-2">CONTACT NO.</th>
                        <th class="p-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($conductors as $conductor)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="p-2">{{ $conductor->conductor_id }}</td>
                            <td class="p-2">{{ $conductor->name }}</td>
                            <td class="p-2">{{ $conductor->surname }}</td>
                            <td class="p-2">{{ $conductor->age }}</td>
                            <td class="p-2">{{ $conductor->license_no }}</td>
                            <td class="p-2">{{ $conductor->contact_no }}</td>
                            <td class="p-2 flex gap-2">
                                <form action="{{ route('conductor.update', $conductor->conductor_id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white py-1 px-2 rounded">Edit</button>
                                </form>
                                <form action="{{ route('conductor.destroy', $conductor->conductor_id) }}" method="POST">
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
                {{ $conductors->links() }}
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="conductorModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg w-full max-w-lg">
            <h3 class="text-lg font-semibold mb-4">Add New Conductor Data</h3>
            <form action="{{ route('conductor.store') }}" method="POST">
                @csrf
                <input type="number" name="conductor_id" placeholder="Conductor ID" class="w-full border mb-2 px-3 py-2 rounded" required>
                <input type="text" name="name" placeholder="NAME" class="w-full border mb-2 px-3 py-2 rounded" required>
                <input type="text" name="surname" placeholder="SURNAME" class="w-full border mb-2 px-3 py-2 rounded" required>
                <input type="number" name="age" placeholder="AGE" class="w-full border mb-2 px-3 py-2 rounded" required>
                <input type="text" name="license_no" placeholder="LICENSE NO." class="w-full border mb-2 px-3 py-2 rounded" required>
                <input type="text" name="contact_no" placeholder="CONTACT NO." class="w-full border mb-2 px-3 py-2 rounded" required>

                <div class="flex justify-end gap-2 mt-4">
                    <button type="button" onclick="closeModal()" class="bg-red-500 text-white px-4 py-2 rounded">Cancel</button>
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Add</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('conductorModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('conductorModal').classList.add('hidden');
        }
    </script>
</x-app-layout>
