@extends ('layout.header')
@section("title")
Urban Ride - Admin Dashboard
@endsection

@section('sidebar')
    <div class="flex flex-col space-y-6 mt-12"> <!-- Added margin-top to avoid overlapping the logo -->
        @include('layout.filesidebar')
    </div>
@endsection
@section('Main')
<main class="flex-grow bg-white m-4 p-6 rounded-lg shadow-md overflow-y-auto">
    <div class="flex items-center gap-3 mb-4">
        <img src="icons/Folder.png" alt="Folder Icon" class="w-10 h-10">
        <span class="text-xl font-bold">Financial Management</span>
    </div>

    <div class="flex gap-3 mb-4">
        <input type="text" placeholder="Search here..." class="border p-2 rounded flex-grow">
        <select class="border p-2 rounded">
            <option>Select Date</option>
        </select>
        <button class="bg-green-500 text-white p-2 rounded" onclick="openModal()">➕ Add Bus</button>
    </div>

    <table class="w-full border-collapse mt-2">
        <thead>
            <tr class="bg-blue-900 text-white">
                <th class="p-3 border">BusID</th>
                <th class="p-3 border">Bus Type</th>
                <th class="p-3 border">Passengers</th>
                <th class="p-3 border">Date</th>
                <th class="p-3 border">Total Tickets</th>
                <th class="p-3 border">Ticket Sales</th>
                <th class="p-3 border">Action</th>
            </tr>
        </thead>
        <tbody id="busTableBody"></tbody>
    </table>
</main>
</div>

<div id="overlay" class="hidden fixed inset-0 bg-black bg-opacity-50"></div>
<div id="busModal" class="hidden fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white p-6 rounded-lg shadow-lg w-80">
<h3 class="text-lg font-bold mb-4">Add New Bus Data</h3>
<input type="text" id="busID" placeholder="Bus ID" class="w-full border p-2 rounded mb-2">
<input type="text" id="busType" placeholder="Bus Type" class="w-full border p-2 rounded mb-2">
<input type="number" id="passengers" placeholder="Passengers" class="w-full border p-2 rounded mb-2">
<input type="date" id="date" class="w-full border p-2 rounded mb-2">
<input type="number" id="totalTickets" placeholder="Total Tickets" class="w-full border p-2 rounded mb-2">
<input type="number" id="ticketSales" placeholder="Ticket Sales" class="w-full border p-2 rounded mb-4">
<div class="flex justify-between">
    <button class="bg-green-500 text-white p-2 rounded" onclick="addBus()">Add</button>
    <button class="bg-red-500 text-white p-2 rounded" onclick="closeModal()">Cancel</button>
</div>
</div>

<script>
const busData = [];

function generateTable() {
    const tableBody = document.getElementById("busTableBody");
    tableBody.innerHTML = "";
    busData.forEach((bus, index) => {
        const row = document.createElement("tr");
        row.innerHTML = `
            <td class="p-3 border">${bus.BusID}</td>
            <td class="p-3 border">${bus.BusType}</td>
            <td class="p-3 border">${bus.Passengers}</td>
            <td class="p-3 border">${bus.Date}</td>
            <td class="p-3 border">${bus.TotalTickets}</td>
            <td class="p-3 border">${bus.TicketSales}</td>
            <td class="p-3 border"><button class="bg-red-500 text-white p-2 rounded" onclick="deleteBus(${index})">Delete</button></td>
        `;
        tableBody.appendChild(row);
    });
}
function deleteBus(index) {
    busData.splice(index, 1);
    generateTable();
}

function openModal() {
    document.getElementById("busModal").classList.remove("hidden");
    document.getElementById("overlay").classList.remove("hidden");
}

function closeModal() {
    document.getElementById("busModal").classList.add("hidden");
    document.getElementById("overlay").classList.add("hidden");
}

function addBus() {
    const newBus = {
        BusID: document.getElementById("busID").value,
        BusType: document.getElementById("busType").value,
        Passengers: document.getElementById("passengers").value,
        Date: document.getElementById("date").value,
        TotalTickets: document.getElementById("totalTickets").value,
        TicketSales: document.getElementById("ticketSales").value
    };

    if (!newBus.BusID || !newBus.BusType || !newBus.Date) {
        alert("Please fill in all required fields.");
        return;
    }

    busData.push(newBus);
    generateTable();
    closeModal();
}
</script>
@endsection
