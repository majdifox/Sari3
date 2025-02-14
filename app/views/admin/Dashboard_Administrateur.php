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
                <a href="/Admin/" class="flex items-center">
                    <img src="https://export-download.canva.com/ZADgo/DAGey3ZADgo/3/0/0001-1456244851306253508.png?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAJHKNGJLC2J7OGJ6Q%2F20250212%2Fus-east-1%2Fs3%2Faws4_request&X-Amz-Date=20250212T180648Z&X-Amz-Expires=64508&X-Amz-Signature=08e79dfdbd4060b752d74edc03c491b40e21570f0fd7ee31777b4cd6e1db3cbe&X-Amz-SignedHeaders=host&response-content-disposition=attachment%3B%20filename%2A%3DUTF-8%27%27Red%2520Blue%2520Modern%2520Logistics%2520Express%2520Logo.png&response-expires=Thu%2C%2013%20Feb%202025%2012%3A01%3A56%20GMT" class="mr-3 mt-[-1rem] w-[7rem]" alt="Site Web Logo" />
                </a>
        <div class="flex-grow flex flex-col justify-between text-gray-500 bg-gray-800">
            <nav class="flex flex-col mx-4 my-6 space-y-4">
                <a href="/Admin" class="inline-flex items-center justify-center py-3 text-green-600 bg-white rounded-lg">
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

            <!-- Liste des Conducteurs -->
                <section class="bg-white shadow rounded-lg">

                    <div class="px-6 py-5 font-semibold border-b border-gray-100">
                        Liste des Conducteurs
                    </div>

                    <?php if (empty($conducteurs)): ?>
                        <tr>
                            <td colspan="3" class="px-4 py-3 text-center text-gray-500">
                                Aucun conducteur disponible
                            </td>
                        </tr>
                    <?php endif; ?>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                                    <th class="px-4 py-3">Nom</th>
                                    <th class="px-4 py-3">Email</th>
                                    <th class="px-4 py-3">Téléphone</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y">
                                <?php foreach ($conducteurs as $conducteur): ?>
                                <tr class="text-gray-700">
                                    <td class="px-4 py-3">
                                        <?= htmlspecialchars($conducteur['nom'] . ' ' . $conducteur['prenom']) ?>
                                    </td>
                                    <td class="px-4 py-3"><?= htmlspecialchars($conducteur['email']) ?></td>
                                    <td class="px-4 py-3"><?= htmlspecialchars($conducteur['telephone']) ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </section>

            <!-- Liste des Itinéraires -->
            <section class="bg-white shadow rounded-lg">
                <div class="px-6 py-5 font-semibold border-b border-gray-100">
                    Liste des Itinéraires
                </div>
                <div class="overflow-x-auto">
                <?php if (!empty($itineraires)): ?>
                        <table class="w-full">
                        <thead>
                            <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                                <th class="px-4 py-3">Conducteur</th>
                                <th class="px-4 py-3">Date</th>
                                <th class="px-4 py-3">Statut</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y">
                            <?php foreach ($itineraires as $itineraire): ?>
                            <tr class="text-gray-700">
                                <td class="px-4 py-3">
                                    <?= htmlspecialchars($itineraire['conducteur_nom'] . ' ' . $itineraire['conducteur_prenom']) ?>
                                </td>
                                <td class="px-4 py-3"><?= date('d/m/Y', strtotime($itineraire['date_depart'])) ?></td>
                                <td class="px-4 py-3"><?= htmlspecialchars($itineraire['statut']) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                <?php else: ?>
                    <tr>
                        <td colspan="4" class="px-4 py-3 text-center text-gray-500">
                            Aucun itinéraire disponible
                        </td>
                    </tr>
                <?php endif; ?>
                    
                </div>
            </section>
            <!-- Derniers Colis -->
            <section id="last-colis" class="bg-white shadow rounded-lg">
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
      const colisStats = <?= json_encode($stats['colis']); ?>;

        const colisChart = new Chart(document.getElementById('colisChart'), {
            type: 'pie', // Type de graphique (ex: bar, pie, line, etc.)
            data: {
                labels: ['En attente', 'En cours', 'Livrés'], // Légendes des données
                datasets: [{
                    label: 'Statistiques des colis',
                    data: [colisStats.en_attente, colisStats.en_cours, colisStats.livres], // Données statistiques
                    backgroundColor: ['#FF6384', '#36A2EB', '#4BC0C0'], // Couleurs pour les segments
                }]
            }
        });

        const usersStats = <?= json_encode($stats['users']); ?>;

            const usersChart = new Chart(document.getElementById('usersChart'), {
                type: 'bar',
                data: {
                    labels: ['Conducteurs', 'Expéditeurs', 'Admins'], // Légendes
                    datasets: [{
                        label: 'Nombre d\'utilisateurs par rôle',
                        data: [usersStats.conducteurs, usersStats.expediteurs, usersStats.admins], // Données
                        backgroundColor: ['#FF9F40', '#FFCD56', '#4BC0C0'], // Couleurs
                    }]
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
