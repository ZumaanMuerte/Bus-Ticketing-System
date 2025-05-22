@extends ('layout.header')
@section("title")
Urban Ride - Admin Dashboard
@endsection

@section('sidebar')
    <div class="flex flex-col space-y-6 mt-12"> <!-- Added margin-top to avoid overlapping the logo -->
        @include('layout.dashboardsidebar')
    </div>
@endsection
@section('Main')
<div class="p-6">
    <div class="bg-white shadow rounded-lg p-4">
    <div class="flex-grow bg-white rounded-md m-4 p-6 shadow-lg overflow-y-auto">
        <div class="flex justify-between items-center mb-4">
            <img src="icons/bus.png" alt="Bus Icon" class="w-10 h-10">
            <span><h2 class="text-xl font-semibold">List of Account</h2></span>
            <button onclick="openModal()" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                + Add Admin Account
            </button>
        </div>

        @if(session('success'))
            <div class="mb-4 text-green-600 font-semibold">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-4 flex gap-2">
            <input type="text" placeholder="Search here..." class="border rounded px-3 py-2 w-full" />
            <input type="date" class="border rounded px-3 py-2" />
        </div>

        <table class="w-full text-left border-t border-gray-200">
            <thead class="bg-indigo-900 text-white">
                <tr>
                    <th class="p-2">Account Id</th>
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
                        <td class="p-2">{{ $account->account_id }}</td>
                        <td class="p-2">{{ $account->role }}</td>
                        <td class="p-2">{{ $account->name }}</td>
                        <td class="p-2">{{ $account->email_address }}</td>
                        <td class="p-2">••••••••</td>
                        <td class="p-2 flex gap-2">
                            <button onclick="openEditModal({{ $account->account_id }}, '{{ $account->role }}')"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white py-1 px-2 rounded">Edit</button>
                            <form action="{{ route('account.destroy', $account->account_id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-1 px-2 rounded">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Add Admin Modal -->
<div id="accountModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg w-full max-w-lg">
        <h3 class="text-lg font-semibold mb-4">Add New Admin Account</h3>
        <form action="{{ route('account.store') }}" method="POST">
            @csrf
            <input type="hidden" name="role" value="admin">
            <input type="text" name="name" placeholder="Name" class="w-full border mb-2 px-3 py-2 rounded" required>
            <input type="email" name="email_address" placeholder="Email Address" class="w-full border mb-2 px-3 py-2 rounded" required>
            <input type="password" name="password" placeholder="Password" class="w-full border mb-2 px-3 py-2 rounded" required minlength="8">

            <div class="flex justify-end gap-2 mt-4">
                <button type="button" onclick="closeModal()" class="bg-red-500 text-white px-4 py-2 rounded">Cancel</button>
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Add Admin</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg w-full max-w-lg">
        <h3 class="text-lg font-semibold mb-4">Edit Account</h3>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <select name="role" class="w-full border mb-2 px-3 py-2 rounded" required>
                <option value="">Select Role</option>
                @foreach($role as $type)
                    <option value="{{ $type }}">{{ $type }}</option>
                @endforeach
            </select>
            <input type="password" name="password" placeholder="New Password (leave blank to keep current)" class="w-full border mb-2 px-3 py-2 rounded" minlength="8">

            <div class="flex justify-end gap-2 mt-4">
                <button type="button" onclick="closeEditModal()" class="bg-red-500 text-white px-4 py-2 rounded">Cancel</button>
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Update</button>
            </div>
        </form>
    </div>
</div>
<script>
    function openModal() {
        document.getElementById('accountModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('accountModal').classList.add('hidden');
    }

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
@endsection
