<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sarii3 Transport</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <header class="bg-gradient-to-r from-[#2E3192] to-[#00B4DB] text-white">
        <nav class="container mx-auto px-4">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <a href="index.php" class="flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 3h18v13H3z"/>
                        <circle cx="7.5" cy="18.5" r="2.5"/>
                        <circle cx="16.5" cy="18.5" r="2.5"/>
                    </svg>
                    <span class="font-bold text-xl">Sarii3 Transport</span>
                </a>

                <!-- Menu principal -->
                <div class="hidden md:flex space-x-6">
                    <a href="index.php" class="hover:text-blue-200">Accueil</a>
                    <a href="annonces.php" class="hover:text-blue-200">Annonces</a>
                    <a href="recherche.php" class="hover:text-blue-200">Rechercher</a>
                    <a href="contact.php" class="hover:text-blue-200">Contact</a>
                </div>

                <!-- Boutons Connexion/Menu mobile -->
                <div class="flex items-center">
                    <div class="hidden md:flex space-x-4">
                        <a href="login.php" class="py-2 px-4 rounded hover:bg-blue-600 transition">Connexion</a>
                        <a href="register.php" class="bg-white text-[#2E3192] py-2 px-4 rounded hover:bg-gray-100 transition">Inscription</a>
                    </div>
                    
                    <!-- Menu mobile -->
                    <button id="menuBtn" class="md:hidden">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Menu mobile dropdown -->
            <div id="mobileMenu" class="hidden md:hidden pb-4">
                <a href="index.php" class="block py-2 hover:text-blue-200">Accueil</a>
                <a href="annonces.php" class="block py-2 hover:text-blue-200">Annonces</a>
                <a href="recherche.php" class="block py-2 hover:text-blue-200">Rechercher</a>
                <a href="contact.php" class="block py-2 hover:text-blue-200">Contact</a>
                <div class="pt-4 space-y-2">
                    <a href="login.php" class="block py-2 text-center rounded hover:bg-blue-600 transition">Connexion</a>
                    <a href="register.php" class="block py-2 text-center bg-white text-[#2E3192] rounded hover:bg-gray-100 transition">Inscription</a>
                </div>
            </div>
        </nav>
    </header>

    <script>
        const menuBtn = document.getElementById('menuBtn');
        const mobileMenu = document.getElementById('mobileMenu');

        menuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>
