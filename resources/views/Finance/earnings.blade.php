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
    <div class="h-screen flex flex-col">
        <main class="flex-grow bg-white rounded-lg m-4 p-6 shadow-lg">
            <div class="flex items-center space-x-4 mb-6">
                <img src="icons/stars(dark).png" alt="Folder Icon" class="w-10 h-10">
                <span class="text-2xl font-bold">Earnings</span>
            </div>

            <div class="flex space-x-4 mb-6">
                <input type="text" placeholder="Search here..." class="border p-2 rounded-lg flex-grow">
                <select class="border p-2 rounded-lg">
                    <option>Select Date</option>
                </select>
                <button class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600" onclick="openModal()">➕ Add
                    Earnings</button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full border-collapse border border-gray-200">
                    <thead>
                        <tr class="bg-indigo-900 text-white">
                            <th class="py-2 px-4 border">Bus ID</th>
                            <th class="py-2 px-4 border">Date</th>
                            <th class="py-2 px-4 border">Expenses</th>
                            <th class="py-2 px-4 border">Total Earnings</th>
                        </tr>
                    </thead>
                    <tbody id="earningsTableBody"></tbody>
                </table>
            </div>
        </main>
    </div>

    <div class="fixed inset-0 bg-black bg-opacity-50 hidden" id="overlay"></div>
    <div class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white p-6 rounded-lg shadow-lg hidden"
        id="earningsModal">
        <h3 class="text-lg font-bold">Add Earnings</h3>
        <input type="text" id="busID" placeholder="Bus ID" class="w-full border p-2 rounded mb-2">
        <input type="date" id="date" class="w-full border p-2 rounded mb-2">
        <input type="number" id="expenses" placeholder="Expenses" class="w-full border p-2 rounded mb-2">
        <input type="number" id="totalEarnings" placeholder="Total Earnings" class="w-full border p-2 rounded mb-2">

        <div class="flex justify-between">
            <button class="bg-green-500 text-white px-4 py-2 rounded" onclick="addBus()">Add</button>
            <button class="bg-red-500 text-white px-4 py-2 rounded" onclick="closeModal()">Cancel</button>
        </div>
    </div>

    <script>
        let earningsData = [];

        function openModal() {
            document.getElementById("earningsModal").classList.remove("hidden");
            document.getElementById("overlay").classList.remove("hidden");
        }

        function closeModal() {
            document.getElementById("earningsModal").classList.add("hidden");
            document.getElementById("overlay").classList.add("hidden");
        }

        function addEarnings() {
            const newEarnings = {
                BusID: document.getElementById("busID").value,
                Date: document.getElementById("date").value,
                Expenses: document.getElementById("expenses").value,
                TotalEarnings: document.getElementById("totalEarnings").value
            };

            if (!newEarnings.BusID || !newEarnings.Date) {
                alert("Please fill in all required fields.");
                return;
            }

            earningsData.push(newEarnings);
            generateEarningsTable();
            closeModal();
        }

        function generateEarningsTable() {
            const tableBody = document.getElementById("earningsTableBody");
            tableBody.innerHTML = "";

            earningsData.forEach((record, index) => {
                const row = document.createElement("tr");
                row.innerHTML = `
                                            <td class="border p-2">${record.BusID}</td>
                                            <td class="border p-2">${record.Date}</td>
                                            <td class="border p-2">$${Number(record.Expenses).toFixed(2)}</td>
                                            <td class="border p-2">$${Number(record.TotalEarnings).toFixed(2)}</td>
                                        `;
                tableBody.appendChild(row);
            });
        }
    </script>
@endsection