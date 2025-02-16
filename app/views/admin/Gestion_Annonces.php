<?php
if (!isset($_SESSION['user']) || !isset($_SESSION['user']->prenom)) {
    header('Location: /login');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Lien du Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Lien des Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 
    
    <title>Administrateur - Profile</title>
</head>
<body class="flex bg-gray-100 min-h-screen">
    <aside class="hidden sm:flex sm:flex-col">
    <a href="admin/" class="flex items-center">
                    <img src="https://export-download.canva.com/ZADgo/DAGey3ZADgo/3/0/0001-1456244851306253508.png?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAJHKNGJLC2J7OGJ6Q%2F20250212%2Fus-east-1%2Fs3%2Faws4_request&X-Amz-Date=20250212T180648Z&X-Amz-Expires=64508&X-Amz-Signature=08e79dfdbd4060b752d74edc03c491b40e21570f0fd7ee31777b4cd6e1db3cbe&X-Amz-SignedHeaders=host&response-content-disposition=attachment%3B%20filename%2A%3DUTF-8%27%27Red%2520Blue%2520Modern%2520Logistics%2520Express%2520Logo.png&response-expires=Thu%2C%2013%20Feb%202025%2012%3A01%3A56%20GMT" class="mr-3 mt-[-1rem] w-[7rem]" alt="Site Web Logo" />
                </a>
        <div class="flex-grow flex flex-col justify-between text-gray-500 bg-gray-800">
        <nav class="flex flex-col mx-4 my-6 space-y-4">
            
            <a href="/index.php/admin" class="inline-flex items-center justify-center py-3 hover:text-gray-400 hover:bg-gray-700 focus:text-gray-400 focus:bg-gray-700 rounded-lg">
            <span class="sr-only">Dashboard</span>
            <svg aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
            </svg>
            </a>
            <a href="admin/users" class="inline-flex items-center justify-center py-3 hover:text-gray-400 hover:bg-gray-700 focus:text-gray-400 focus:bg-gray-700 rounded-lg">
            <span class="sr-only">Utilisateur</span>
            <svg class="w-6 h-6 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                <path d="M16 0H4a2 2 0 0 0-2 2v1H1a1 1 0 0 0 0 2h1v2H1a1 1 0 0 0 0 2h1v2H1a1 1 0 0 0 0 2h1v2H1a1 1 0 0 0 0 2h1v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5.5 4.5a3 3 0 1 1 0 6 3 3 0 0 1 0-6ZM13.929 17H7.071a.5.5 0 0 1-.5-.5 3.935 3.935 0 1 1 7.858 0 .5.5 0 0 1-.5.5Z"/>
            </svg>
            </a>

            <a href="admin/annonces"  class="inline-flex items-center justify-center py-3 text-green-600 bg-white rounded-lg">
            <span class="sr-only">Tous les Annonces</span>
            <svg class="w-6 h-6 text-green-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                <path d="M15 1.943v12.114a1 1 0 0 1-1.581.814L8 11V5l5.419-3.871A1 1 0 0 1 15 1.943ZM7 4H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2v5a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2V4ZM4 17v-5h1v5H4ZM16 5.183v5.634a2.984 2.984 0 0 0 0-5.634Z"/>
            </svg>
            </a>

            <a href="profile_administrateur.php" class="inline-flex items-center justify-center py-3 hover:text-gray-400 hover:bg-gray-700 focus:text-gray-400 focus:bg-gray-700 rounded-lg">
            <svg aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            </a>
            
        </nav>
        </div>
    </aside>
    <div class="flex-grow text-gray-800">
        <header class="flex items-center h-20 px-6 sm:px-10 bg-white">
            <div class="flex flex-shrink-0 items-center ml-auto">
                <div class="hidden md:flex md:flex-col md:items-end md:leading-tight">
                    <span class="font-semibold"><?php echo $_SESSION['user']->nom . ' ' . $_SESSION['user']->prenom; ?></span>
                    <span class="text-sm text-gray-600"><?php echo $_SESSION['user']->role; ?></span>
                </div>
                <span class="h-12 w-12 ml-2 sm:ml-3 mr-2 bg-gray-100 rounded-full overflow-hidden">
                    <img src="../assets/images/<?php echo $photo; ?>" alt="user profile photo" class="h-full w-full object-cover">
                </span>
            
                <div class="border-l pl-3 ml-3 space-x-1">
                    <button class="relative p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-600 focus:bg-gray-100 focus:text-gray-600 rounded-full">
                    <a href="../templates/logout.php">
                        <span class="sr-only">Log out</span>
                        <svg aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </a>
                    </button>
                </div>
            </div>
        </header>

        <main>
    <h1 class='text-3xl font-semibold mb-4'>Gestion des Annonces</h1>
    
    <!-- Formulaire de création d'annonce -->
    <form action='/Admin/create-announcement' method='POST' class='mb-8 bg-white p-6 rounded-lg shadow-md'>
        <div class="space-y-4">
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Titre de l'annonce</label>
                <input type='text' id="title" name='title' placeholder='Titre de l annonce' required 
                    class='mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500'/>
            </div>
            <div>
                <label for="content" class="block text-sm font-medium text-gray-700">Contenu de l'annonce</label>
                <textarea name='content' id="content" placeholder='Contenu de l annonce' required 
                    class='mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 h-32'></textarea>
            </div>
            <button type='submit' 
                class='w-full bg-green-500 text-white p-2 rounded-md hover:bg-green-600 transition duration-200'>
                Créer Annonce
            </button>
        </div>
    </form>

    <!-- Liste des annonces -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($itineraires as $itineraire): ?>
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <!-- En-tête de la card -->
                    <div class="bg-green-500 text-white px-4 py-2">
                        <h2 class="text-xl font-semibold">
                            <?= htmlspecialchars($itineraire['ville_depart']) ?> → <?= htmlspecialchars($itineraire['ville_destination']) ?>
                        </h2>
                    </div>
                    
                    <!-- Corps de la card -->
                    <div class="p-4">
                        <!-- Informations du trajet -->
                        <div class="mb-4">
                            <div class="flex items-center mb-2">
                                <svg class="w-5 h-5 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="text-gray-700"><?= date('d/m/Y', strtotime($itineraire['date_depart'])) ?> à <?= $itineraire['heure_depart'] ?></span>
                            </div>
                            <div class="flex items-center mb-2">
                                <svg class="w-5 h-5 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2z" />
                                </svg>
                                <span class="text-gray-700"><?= $itineraire['prix'] ?> DH</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                <span class="text-gray-700"><?= $itineraire['nombre_place'] ?> places disponibles</span>
                            </div>
                        </div>

                        <!-- Informations du conducteur -->
                        <div class="border-t pt-4">
                            <h3 class="font-semibold text-gray-700 mb-2">Conducteur</h3>
                            <div class="flex items-center mb-2">
                                <img src="/assets/images/default-avatar.png" alt="Avatar" class="w-10 h-10 rounded-full mr-3">
                                <div>
                                    <p class="font-medium"><?= htmlspecialchars($itineraire['conducteur_nom']) ?> <?= htmlspecialchars($itineraire['conducteur_prenom']) ?></p>
                                    <p class="text-sm text-gray-500"><?= htmlspecialchars($itineraire['conducteur_email']) ?></p>
                                </div>
                            </div>
                        </div>


                        <!-- Boutons d'action -->
                        <div class="mt-4 flex justify-end space-x-2">
                            <a href="/admin/itineraire/<?= $itineraire['id'] ?>" 
                               class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 transition duration-200">
                                Voir détails
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
</main>

    </div>

    <script>
    </script>
    
</body>
</html>