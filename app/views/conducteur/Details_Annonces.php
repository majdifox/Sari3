<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" />
    <title>Moroccan Cities Map</title>
    <style>
        #map { height: 500px; }
        .delete-btn {
            background-color: #ef4444;
            color: white;
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
            cursor: pointer;
        }
        .delete-btn:hover {
            background-color: #dc2626;
        }
    </style>
</head>
<body class="bg-gradient-to-t from-blue-300 via-blue-200 to-blue-100">
    <?php include_once('C:\laragon\www\Sari3\app\views\includes\NvHeader.php'); ?>

    <form action="addIteneraire" method="post" onsubmit="addCitiesToForm()">
        <main class="container mx-auto p-4">
            <h1 class="text-3xl font-bold text-center mb-4">Moroccan Cities Map</h1>
            <div class="controls mb-4">
                <button type="button" onclick="clearTable()" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                    Clear List
                </button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div id="map"></div>
                <div>
                    <h2 class="text-xl font-semibold mb-2">Selected Cities</h2>
                    <table class="w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border border-gray-300 p-2">Order</th>
                                <th class="border border-gray-300 p-2">City Name</th>
                                <th class="border border-gray-300 p-2">Action</th>
                            </tr>
                        </thead>
                        <tbody id="cityTableBody"></tbody>
                    </table>
                </div>
            </div>
        </main>
        <main>
            <div class="max-w-sm mx-auto mt-[4rem]">
                <label for="vehicle-select" class="block mb-2 text-sm font-medium text-gray-900">Choisissez Votre Véhicule</label>
                <select id="vehicle-select" name="vehicle" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                    <option value="">Loading vehicles...</option>
                </select>
                
                <!-- Hidden input to store vehicle data -->
                <input type="hidden" id="vehicleData" name="vehicleData">

                <div class="mt-4">
                    <label for="date_depart" class="block mb-2 text-sm font-medium text-gray-900">Date de Depart</label>
                    <input type="datetime-local" name="date_depart" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">

                    <label for="date_arriver" class="block mb-2 text-sm font-medium text-gray-900">Date de Arriver</label>
                    <input type="datetime-local" name="date_arriver" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                </div>
                
                <input type="submit" value="ADD" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
            </div>
        </main>
    </form>

    <?php include_once('C:\laragon\www\Sari3\app\views\includes\NvFooter.php'); ?>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        let selectedCities = [];

        function addCityMarkers() {
            const moroccanCities = [
      { name: 'Casablanca', coords: [33.5731, -7.5898] },
      { name: 'Rabat', coords: [34.0209, -6.8417] },
      { name: 'Marrakech', coords: [31.6295, -7.9811] },
      { name: 'Fes', coords: [34.0181, -5.0078] },
      { name: 'Tangier', coords: [35.7595, -5.8340] },
      { name: 'Agadir', coords: [30.4278, -9.5981] },
      { name: 'Meknes', coords: [33.8945, -5.5475] },
      { name: 'Oujda', coords: [34.6816, -1.9078] },
      { name: 'Kenitra', coords: [34.2610, -6.5802] },
      { name: 'Tetouan', coords: [35.5764, -5.3684] },
      { name: 'Safi', coords: [32.2994, -9.2372] },
      { name: 'El Jadida', coords: [33.2311, -8.5002] },
      { name: 'Nador', coords: [35.1684, -2.9335] },
      { name: 'Taza', coords: [34.2133, -4.0088] },
      { name: 'Settat', coords: [33.0011, -7.6166] },
      { name: 'Mohammedia', coords: [33.6844, -7.3874] },
      { name: 'Khemisset', coords: [33.8248, -6.0661] },
      { name: 'Guelmim', coords: [28.987, -10.0574] },
      { name: 'Khouribga', coords: [32.8826, -6.9063] },
      { name: 'Beni Mellal', coords: [32.3394, -6.3608] },
      { name: 'Errachidia', coords: [31.9314, -4.4244] },
      { name: 'Tiznit', coords: [29.6974, -9.7316] },
      { name: 'Laayoune', coords: [27.1501, -13.1993] },
      { name: 'Dakhla', coords: [23.6848, -15.9570] }
    ];

            moroccanCities.forEach(city => {
                const marker = L.marker(city.coords).addTo(map);
                marker.bindPopup(`
                    <b>${city.name}</b><br>
                    <div onclick="selectCity('${city.name}')" class="bg-blue-500 text-white px-2 py-1 rounded-lg hover:bg-blue-600">
                        Select City
                    </div>
                `);
            });
        }

        function selectCity(cityName) {
            if (selectedCities.includes(cityName)) {
                alert("This city is already selected!");
                return;
            }
            selectedCities.push(cityName);
            updateTable();
        }

        function updateTable() {
            const tableBody = document.getElementById("cityTableBody");
            tableBody.innerHTML = "";
            selectedCities.forEach((city, index) => {
                const row = `<tr>
                    <td class="border border-gray-300 p-2">${index + 1}</td>
                    <td class="border border-gray-300 p-2">${city}</td>
                    <td class="border border-gray-300 p-2">
                        <button onclick="deleteCity('${city}')" class="delete-btn">Delete</button>
                    </td>
                </tr>`;
                tableBody.innerHTML += row;
            });
        }

        function deleteCity(cityName) {
            selectedCities = selectedCities.filter(city => city !== cityName);
            updateTable();
        }

        function clearTable() {
            selectedCities = [];
            updateTable();
        }

        function addCitiesToForm() {
            const form = document.querySelector('form');
            selectedCities.forEach((city, index) => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = `cities[${index}]`;
                input.value = city;
                form.appendChild(input);
            });

            const selectedVehicle = document.getElementById('vehicle-select').value;
            document.getElementById('vehicleData').value = selectedVehicle;
        }

        // Load vehicles
        fetch('https://oussamaamou.github.io/Vehicules-Colliers-API/')
            .then(response => response.json())
            .then(data => {
                const selectElement = document.getElementById('vehicle-select');
                selectElement.innerHTML = '<option value="">Select a vehicle</option>';
                data.vehicules.forEach(vehicule => {
                    const option = document.createElement('option');
                    option.value = JSON.stringify(vehicule);
                    option.textContent = `${vehicule.marque} ${vehicule.modele} - ${vehicule.type_vehicule}`;
                    selectElement.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error fetching data:', error);
                document.getElementById('vehicle-select').innerHTML = '<option value="">Failed to load vehicles</option>';
            });

        const map = L.map('map').setView([31.7917, -7.0926], 6);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
        addCityMarkers();
    </script>
</body>
</html>
