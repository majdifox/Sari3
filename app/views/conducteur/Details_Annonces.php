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
                        <tbody id="cityTableBody">
                            <!-- Selected cities will appear here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
        <main>
            <div class="max-w-sm mx-auto mt-[4rem]">
                <label for="vehicle-select" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Choisissez Votre Véhicule</label>
                <select id="vehicle-select" name="vehicle" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                    <option value=""></option>
                </select>
                <div class="mt-4">
                    <div class="mb-4">
                        <label for="date_depart" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date de Depart</label>
                        <input type="datetime-local" name="date_depart" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                    </div>
                    <div class="mb-4">
                        <label for="date_arriver" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date de Arriver</label>
                        <input type="datetime-local" name="date_arriver" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                    </div>
                </div>
                <input type="submit" value="ADD" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
            </div>
        </main>
    </form>
    <?php include_once('C:\laragon\www\Sari3\app\views\includes\NvFooter.php'); ?>
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        // Define Morocco boundaries
        const moroccoBounds = [
            [21.0, -17.0], // Southwest
            [36.0, -1.0]   // Northeast
        ];

        // Initialize the map
        const map = L.map('map', {
            center: [31.7917, -7.0926],
            zoom: 6,
            minZoom: 5,
            maxZoom: 12,
            maxBounds: moroccoBounds,
            maxBoundsViscosity: 1.0
        });

        // Add OpenStreetMap tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // Moroccan cities with coordinates
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

        // List to store selected cities
        let selectedCities = [];

        // Define green marker icon
        const greenIcon = L.icon({
            iconUrl: 'https://i.pinimg.com/originals/87/ee/a5/87eea5f5db0b138dc45dfb403570df6f.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34]
        });

        // Store markers to update their icons
        const markers = {};

        function addCityMarkers() {
            moroccanCities.forEach(city => {
                const marker = L.marker(city.coords).addTo(map);
                markers[city.name] = marker; // Store marker reference

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

            if (markers[cityName]) {
                markers[cityName].setIcon(greenIcon);
            }
        }

        function updateTable() {
            const tableBody = document.getElementById("cityTableBody");
            tableBody.innerHTML = ""; // Clear table

            selectedCities.forEach((city, index) => {
                const row = document.createElement("tr");

                const orderCell = document.createElement("td");
                orderCell.textContent = index + 1;
                orderCell.className = "border border-gray-300 p-2";

                const cityCell = document.createElement("td");
                cityCell.textContent = city;
                cityCell.className = "border border-gray-300 p-2";

                const deleteCell = document.createElement("td");
                const deleteButton = document.createElement("button");
                deleteButton.textContent = "Delete";
                deleteButton.className = "delete-btn";
                deleteButton.onclick = () => deleteCity(city);

                deleteCell.appendChild(deleteButton);
                row.appendChild(orderCell);
                row.appendChild(cityCell);
                row.appendChild(deleteCell);

                tableBody.appendChild(row);
            });
        }

        function deleteCity(cityName) {
            selectedCities = selectedCities.filter(city => city !== cityName);
            updateTable();

            // Restore original marker icon if removed
            if (markers[cityName]) {
                markers[cityName].setIcon(L.Icon.Default.prototype);
            }
        }

        function clearTable() {
            selectedCities = [];
            updateTable();

            // Reset all markers to default
            Object.values(markers).forEach(marker => marker.setIcon(L.Icon.Default.prototype));
        }

        // Add city markers to the map
        addCityMarkers();

        // Function to add selected cities to the form before submission
        function addCitiesToForm() {
            const form = document.querySelector('form');
            selectedCities.forEach((city, index) => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = `cities[${index}]`;
                input.value = city;
                form.appendChild(input);
            });
        }
    </script>
    <script>
        // Fetch vehicles data
        fetch('https://oussamaamou.github.io/Vehicules-Colliers-API/')
            .then(response => response.json())
            .then(data => {
                const selectElement = document.getElementById('vehicle-select');
                selectElement.innerHTML = '';

                data.vehicules.forEach(vehicule => {
                    const option = document.createElement('option');
                    option.value = JSON.stringify(vehicule); // Send the entire vehicle object as JSON
                    option.textContent = `${vehicule.marque} ${vehicule.modele} - ${vehicule.type_vehicule}`;
                    selectElement.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error fetching data:', error);
                const selectElement = document.getElementById('vehicle-select');
                selectElement.innerHTML = '<option value="">Failed to load vehicles</option>';
            });
    </script>
</body>
</html>