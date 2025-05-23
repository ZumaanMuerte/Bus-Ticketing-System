<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-white">
            {{ __('User Page') }}
        </h2>
    </x-slot>

    <style>
        /* Override Tom Select input to match Tailwind styles */
        .ts-control {
            width: 100% !important;
            min-width: 24rem !important; /* w-96 */
            max-width: 24rem !important;
            background-color: white !important;
            border-radius: 0.5rem !important; /* rounded-lg */
            border: 1px solid #d1d5db !important; /* Tailwind gray-300 */
            padding-left: 1rem !important; /* px-4 */
            padding-right: 1rem !important;
            padding-top: 0.75rem !important; /* py-3 */
            padding-bottom: 0.75rem !important;
            font-size: 1rem !important; /* text-base */
            color: #374151 !important; /* Tailwind gray-700 text */
            box-shadow: none !important;
            transition: box-shadow 0.2s ease-in-out;
        }

        .ts-control.ts-focus {
            outline: none !important;
            border-color: #60a5fa !important; /* Tailwind blue-400 ring color */
            box-shadow: 0 0 0 2px rgba(96, 165, 250, 0.5) !important; /* focus ring */
        }

        /* Placeholder color */
        .ts-placeholder {
            color: #9ca3af !important; /* Tailwind gray-400 */
        }

        /* Fix dropdown background to white */
        .ts-dropdown,
        .ts-dropdown-content {
            background-color: white !important;
            border: 1px solid #d1d5db !important; /* Tailwind gray-300 */
            border-radius: 0.5rem !important; /* rounded-lg */
            color: #374151 !important; /* text-gray-700 */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1) !important; /* subtle shadow */
        }

        /* Smooth fade for background image changes */
        .transition-bg {
            transition: background-image 1s ease-in-out;
        }

        /* === New: Background hover overlay on second frame === */
        #ticket-form {
            position: relative;
            cursor: pointer; /* optional */
        }

        #ticket-form::before {
            content: "";
            position: absolute;
            inset: 0;
            background-color: transparent;
            transition: background-color 0.3s ease-in-out;
            z-index: 0;
            pointer-events: none; /* allow clicks through overlay */
            border-radius: inherit; /* if you want rounded corners effect */
        }

        #ticket-form:hover::before {
            background-color: rgba(0, 0, 0, 0.3); /* semi-transparent black overlay */
        }
    </style>

    <!-- First Frame: Welcome + Buy Ticket with auto-switch background -->
    <div id="background-container" class="h-screen bg-center bg-no-repeat bg-cover flex flex-col justify-center items-center transition-bg"
         style="background-image: url('/images/bus3.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center;">
        <div x-data="{ show: true }"
             x-init="setTimeout(() => show = false, 4000)"
             x-show="show"
             x-transition:leave="transition ease-in duration-500"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="max-w-4xl w-full sm:px-6 lg:px-8">
            <div class="bg-white text-black shadow sm:rounded-lg p-6 text-center">
                Welcome, {{ Auth::user()->name }}! You're logged in as a {{ Auth::user()->role }}.
            </div>
        </div>

        <a href="#ticket-form"
           class="mt-12 bg-blue-500 hover:bg-blue-600 text-white text-2xl font-bold w-80 h-20 flex items-center justify-center rounded-2xl shadow-2xl transition">
            Buy Ticket
        </a>
    </div>

    <!-- Second Frame: Ticket Form with hover overlay -->
    <div id="ticket-form"
         class="h-screen bg-center bg-no-repeat bg-cover flex flex-col items-center justify-center scroll-mt-24"
         style="background-image: url('/images/bus5.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center;">

        <h2 class="text-3xl font-semibold text-white mb-6 relative z-10">Ticket Information</h2>

        <form class="flex flex-col space-y-6 w-auto p-6 bg-white rounded-lg shadow-lg relative z-10">
            <input type="text" placeholder="Enter Location"
                   class="w-96 px-4 py-3 text-base rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400" />

            <select id="destination" placeholder="Select Destination..."
                    class="w-96 px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400">
                <option value="" disabled selected>Select Destination</option>
                <option value="Cagayan de Oro City">Cagayan de Oro City</option>
                <option value="Gingoog City">Gingoog City</option>
                <option value="Butuan">Butuan</option>
                <option value="Surigao City">Surigao City</option>
                <option value="Surigao del Sur">Surigao del Sur</option>
                <option value="Malaybalay, Bukidnon">Malaybalay, Bukidnon</option>
                <option value="Davao City">Davao City</option>
                <option value="Tagoloan">Tagoloan</option>
                <option value="Villanueva">Villanueva</option>
                <option value="Claveria">Claveria</option>
                <option value="Balingasag">Balingasag</option>
                <option value="Lagonglong">Lagonglong</option>
                <option value="Salay">Salay</option>
                <option value="Talisayan">Talisayan</option>
                <option value="Medina">Medina</option>
                <option value="Magsaysay">Magsaysay</option>
                <option value="Nasipit">Nasipit</option>
                <option value="Cabadbaran">Cabadbaran</option>
                <option value="Kitcharao">Kitcharao</option>
                <option value="Tubod">Tubod</option>
                <option value="Tagum City">Tagum City</option>
            </select>

            <select id="bus-type" onchange="toggleStopOptions()"
                    class="w-96 px-4 py-3 text-base rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400">
                <option disabled selected>Select Bus Type</option>
                <option value="aircon">Air-Conditioned</option>
                <option value="non-aircon">Non-Air-Conditioned</option>
            </select>

            <select id="stop-type"
                    class="hidden w-96 px-4 py-3 text-base rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400">
                <!-- Options added via JS -->
            </select>

            <input type="date"
                   class="w-96 px-4 py-3 text-base rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400" />

            <button type="submit"
                    class="mt-4 bg-red-500 hover:bg-red-700 text-white text-lg font-bold py-3 px-12 rounded-2xl shadow-xl transition w-96">
                Submit
            </button>
        </form>
    </div>

    <script>
        function toggleStopOptions() {
            const busType = document.getElementById('bus-type').value;
            const stopType = document.getElementById('stop-type');

            if (busType === 'aircon') {
                stopType.classList.remove('hidden');
                stopType.innerHTML = `
                    <option disabled selected>Select Stop Type</option>
                    <option value="nonstop">Nonstop</option>
                    <option value="provincial">Provincial</option>
                `;
            } else if (busType === 'non-aircon') {
                stopType.classList.remove('hidden');
                stopType.innerHTML = `<option value="provincial">Provincial</option>`;
            } else {
                stopType.classList.add('hidden');
            }
        }
    </script>

    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.bootstrap5.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
    <script>
        new TomSelect("#destination", {
            create: false,
            sortField: {
                field: "text",
                direction: "asc"
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const images = [
                '/images/buslala.jpg',
                '/images/bus3.jpg',
                '/images/bus4.jpg',
                '/images/bus5.jpg',
                '/images/bus6.jpg',
                '/images/bus7.jpg',
            ];

            const bgContainer = document.getElementById('background-container');
            let currentIndex = 0;
            let intervalId = null;

            function changeBackground() {
                currentIndex = (currentIndex + 1) % images.length;
                bgContainer.style.backgroundImage = `url('${images[currentIndex]}')`;
            }

            function startBackgroundSwitch() {
                intervalId = setInterval(changeBackground, 4000);
            }

            function stopBackgroundSwitch() {
                clearInterval(intervalId);
            }

            // Start auto-switching
            startBackgroundSwitch();

            // Pause on hover
            bgContainer.addEventListener('mouseenter', stopBackgroundSwitch);
            bgContainer.addEventListener('mouseleave', startBackgroundSwitch);
        });
    </script>
</x-app-layout>
