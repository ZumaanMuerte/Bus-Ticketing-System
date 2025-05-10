<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Account List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="bg-white shadow rounded-lg p-4">
            <div class="flex-grow bg-white rounded-md m-4 p-6 shadow-lg overflow-y-auto">

                <div class="mb-4 flex gap-2">
                    <form method="GET" action="" class="mb-4">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search account..." class="border rounded px-4 py-1 w-50%">
                        <button type="submit" class="bg-blue-500 text-black px-4 py-1 rounded hover:bg-blue-600">Search</button>
                    </form>
                </div>


                <table class="w-full text-left border-t border-gray-200">
                    <thead class="bg-indigo-900 text-wh     ite">
                        <tr>
                            <th class="p-2">Account ID</th>
                            <th class="p-2">Role</th>
                            <th class="p-2">Name</th>
                            <th class="p-2">Email Address</th>
                            <th class="p-2">Password</th>
                            <th class="p-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($accounts as $account)
                            <tr class="border-b hover:bg-gray-100">
                                <td class="p-2">{{ $account->id }}</td>
                                <td class="p-2">{{ $account->role }}</td>
                                <td class="p-2">{{ $account->name }}</td>
                                <td class="p-2">{{ $account->email }}</td>
                                <td class="p-2">••••••••</td>
                                <td class="p-2 flex gap-2">
                                    <button onclick="openEditModal({{ $account->id }}, '{{ $account->role }}')"
                                            class="bg-yellow-500 hover:bg-yellow-600 text-white py-1 px-2 rounded">Edit</button>
                                    <form action="{{ route('account.destroy', $account->id) }}" method="POST">
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
                    {{$accounts->links() }}
                </div>

            </div>
        </div>

        <!-- Edit Modal -->
        <div id="editModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white p-6 rounded-lg w-full max-w-lg">
                <h3 class="text-lg font-semibold mb-4">Edit Account</h3>
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <select name="role" class="w-full border mb-2 px-3 py-2 rounded" required>
                                <option value="">Select Role</option>
                                @foreach($role as $type)
                                    <option value="{{ $type }}">{{ ucfirst($type) }}</option>
                                @endforeach
                            </select>
                        @else
                            <input type="hidden" name="role" value="client">
                        @endif
                    @endauth

                    <div class="flex justify-end gap-2 mt-4">
                        <button type="button" onclick="closeEditModal()" class="bg-red-500 text-white px-4 py-2 rounded">Cancel</button>
                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openEditModal(id, currentRole) {
            const form = document.getElementById('editForm');
            form.action = `/account/${id}`;
            form.querySelector('[name="role"]').value = currentRole;
            document.getElementById('editModal').classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }
    </script>
</x-app-layout>
