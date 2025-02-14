<?php
session_start();
if (!isset($_SESSION['user']) || !isset($_SESSION['user']->prenom)) {
    header('Location: /login');
    exit();
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Dashboard Admin - Sari3</title>
</head>
<body class="flex bg-gray-100 min-h-screen">
    <aside class="hidden sm:flex sm:flex-col">
        <a href="/Admin/dashboard" class="inline-flex items-center justify-center h-20 w-20 bg-green-600 hover:bg-green-500">
            <span class="text-white font-bold text-2xl">S3</span>
        </a>
        <div class="flex-grow flex flex-col justify-between text-gray-500 bg-gray-800">
            <nav class="flex flex-col mx-4 my-6 space-y-4">
                <a href="/Admin/dashboard" class="inline-flex items-center justify-center py-3 text-green-600 bg-white rounded-lg">
                    <span class="sr-only">Dashboard</span>
                    <i class="fas fa-chart-line text-xl"></i>
                </a>

                <a href="/Admin/users" class="inline-flex items-center justify-center py-3 hover:text-gray-400 hover:bg-gray-700 focus:text-gray-400 focus:bg-gray-700 rounded-lg">
                    <span class="sr-only">Utilisateurs</span>
                    <i class="fas fa-users text-xl"></i>
                </a>

                <a href="/Admin/colis" class="inline-flex items-center justify-center py-3 hover:text-gray-400 hover:bg-gray-700 focus:text-gray-400 focus:bg-gray-700 rounded-lg">
                    <span class="sr-only">Colis</span>
                    <i class="fas fa-box text-xl"></i>
                </a>

                <a href="/Admin/statistiques" class="inline-flex items-center justify-center py-3 hover:text-gray-400 hover:bg-gray-700 focus:text-gray-400 focus:bg-gray-700 rounded-lg">
                    <span class="sr-only">Statistiques</span>
                    <i class="fas fa-chart-bar text-xl"></i>
                </a>
            </nav>
        </div>
    </aside>

    <div class="flex-grow text-gray-800">
        <header class="flex items-center h-20 px-6 sm:px-10 bg-white">
            <div class="flex flex-shrink-0 items-center ml-auto">
                <div class="flex items-center">
                    <span class="text-gray-800 text-sm mr-4">Bienvenue, <?= $_SESSION['user']->prenom ?></span>
                    <a href="/logout" class="text-gray-800 hover:text-red-500">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </div>
            </div>
        </header>

        <main class="p-6 sm:p-10 space-y-6">
            <div class="flex flex-col space-y-6 md:space-y-0 md:flex-row justify-between">
                <div class="mr-6">
                    <h1 class="text-4xl font-semibold mb-2">Dashboard</h1>
                    <h2 class="text-gray-600 ml-0.5">Vue d'ensemble de la plateforme</h2>
                </div>
            </div>

            <section class="grid md:grid-cols-2 xl:grid-cols-4 gap-6">
                <!-- Total Utilisateurs -->
                <div class="flex items-center p-8 bg-white shadow rounded-lg">
                    <div class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-blue-600 bg-blue-100 rounded-full mr-6">
                        <i class="fas fa-users text-xl"></i>
                    </div>
                    <div>
                        <span class="block text-2xl font-bold"><?= $stats['users']['total'] ?></span>
                        <span class="block text-gray-500">Utilisateurs</span>
                    </div>
                </div>

                <!-- Total Conducteurs -->
                <div class="flex items-center p-8 bg-white shadow rounded-lg">
                    <div class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-green-600 bg-green-100 rounded-full mr-6">
                        <i class="fas fa-car text-xl"></i>
                    </div>
                    <div>
                        <span class="block text-2xl font-bold"><?= $stats['users']['conducteurs'] ?></span>
                        <span class="block text-gray-500">Conducteurs</span>
                    </div>
                </div>

                <!-- Total Expéditeurs -->
                <div class="flex items-center p-8 bg-white shadow rounded-lg">
                    <div class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-purple-600 bg-purple-100 rounded-full mr-6">
                        <i class="fas fa-user text-xl"></i>
                    </div>
                    <div>
                        <span class="block text-2xl font-bold"><?= $stats['users']['expediteurs'] ?></span>
                        <span class="block text-gray-500">Expéditeurs</span>
                    </div>
                </div>

                <!-- Total Colis -->
                <div class="flex items-center p-8 bg-white shadow rounded-lg">
                    <div class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-red-600 bg-red-100 rounded-full mr-6">
                        <i class="fas fa-box text-xl"></i>
                    </div>
                    <div>
                        <span class="block text-2xl font-bold"><?= $stats['colis']['total'] ?></span>
                        <span class="block text-gray-500">Colis</span>
                    </div>
                </div>
            </section>

            <section class="grid md:grid-cols-2 xl:grid-cols-2 gap-6">
                <!-- Statistiques des Colis -->
                <div class="flex flex-col bg-white shadow rounded-lg">
                    <div class="px-6 py-5 font-semibold border-b border-gray-100">Statistiques des Colis</div>
                    <div class="p-4 flex-grow">
                        <canvas id="colisChart" height="300"></canvas>
                    </div>
                </div>

                <!-- Statistiques des Utilisateurs -->
                <div class="flex flex-col bg-white shadow rounded-lg">
                    <div class="px-6 py-5 font-semibold border-b border-gray-100">Statistiques des Utilisateurs</div>
                    <div class="p-4 flex-grow">
                        <canvas id="usersChart" height="300"></canvas>
                    </div>
                </div>
            </section>

            <section class="bg-white shadow rounded-lg">
                <div class="px-6 py-5 font-semibold border-b border-gray-100">
                    Liste des Conducteurs
                </div>
                <div class="overflow-x-auto conducteurs-list">
                </div>
            </section>

            <section class="bg-white shadow rounded-lg">
                <div class="px-6 py-5 font-semibold border-b border-gray-100">
                    Liste des Itinéraires
                </div>
                <div class="overflow-x-auto itineraire-list">
                </div>
            </section>

            <!-- Derniers Colis -->
            <section class="bg-white shadow rounded-lg">
                <div class="px-6 py-5 font-semibold border-b border-gray-100">
                    Derniers Colis
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                                <th class="px-4 py-3">Expéditeur</th>
                                <th class="px-4 py-3">Destination</th>
                                <th class="px-4 py-3">Volume</th>
                                <th class="px-4 py-3">Poids</th>
                                <th class="px-4 py-3">Statut</th>
                                <th class="px-4 py-3">Date</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y">
                            <?php foreach ($recent_colis as $colis): ?>
                            <tr class="text-gray-700">
                                <td class="px-4 py-3">
                                    <?= htmlspecialchars($colis['expediteur_nom'] . ' ' . $colis['expediteur_prenom']) ?>
                                </td>
                                <td class="px-4 py-3"><?= htmlspecialchars($colis['destination']) ?></td>
                                <td class="px-4 py-3"><?= $colis['volume'] ?> m³</td>
                                <td class="px-4 py-3"><?= $colis['poids'] ?> kg</td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 font-semibold leading-tight rounded-full 
                                        <?php
                                        switch($colis['statut']) {
                                            case 'En préparation':
                                                echo 'text-yellow-700 bg-yellow-100';
                                                break;
                                            case 'En transit':
                                                echo 'text-blue-700 bg-blue-100';
                                                break;
                                            case 'Livré':
                                                echo 'text-green-700 bg-green-100';
                                                break;
                                        }
                                        ?>">
                                        <?= htmlspecialchars($colis['statut']) ?>
                                    </span>
                                </td>
                                <td class="px-4 py-3"><?= date('d/m/Y', strtotime($colis['date_depart'])) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>

    <script>
        // Graphique des colis
        const colisCtx = document.getElementById('colisChart').getContext('2d');
        new Chart(colisCtx, {
            type: 'bar',
            data: {
                labels: <?= json_encode(array_column($colis_stats, 'statut')) ?>,
                datasets: [{
                    label: 'Nombre de colis',
                    data: <?= json_encode(array_column($colis_stats, 'total')) ?>,
                    backgroundColor: ['#FCD34D', '#60A5FA', '#34D399'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });

        // Graphique des utilisateurs
        const usersCtx = document.getElementById('usersChart').getContext('2d');
        new Chart(usersCtx, {
            type: 'pie',
            data: {
                labels: <?= json_encode(array_column($user_stats, 'role')) ?>,
                datasets: [{
                    data: <?= json_encode(array_column($user_stats, 'total')) ?>,
                    backgroundColor: ['#60A5FA', '#34D399', '#F87171'],
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Fetch Conducteurs
        fetch('/Admin/conducteurs')
            .then(response => response.json())
            .then(data => {
                const conducteursContainer = document.querySelector('.conducteurs-list');
                data.forEach(conducteur => {
                    const conducteurElement = document.createElement('div');
                    conducteurElement.textContent = conducteur.name; // Adjust to your data structure
                    conducteursContainer.appendChild(conducteurElement);
                });
            });

        // Fetch Itinéraires
        fetch('/Admin/itineraire')
            .then(response => response.json())
            .then(data => {
                const itinerairesContainer = document.querySelector('.itineraire-list');
                data.forEach(itineraire => {
                    const itineraireElement = document.createElement('div');
                    itineraireElement.textContent = itineraire.destination; // Adjust to your data structure
                    itinerairesContainer.appendChild(itineraireElement);
                });
            });
    </script>
</body>
</html>
