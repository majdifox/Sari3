<?php
$title = "Register - Tracking System";
ob_start();
?>
<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4 text-center">Register</h2>
    
    <form action="/index.php/register" method="POST" enctype="multipart/form-data">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-gray-700">CNI</label>
                <input type="text" name="cni" class="w-full border border-gray-300 p-2 rounded" required>
            </div>
            <h2 class="text-2xl font-bold text-white mb-2">Sarii3 Transport</h2>
            <p class="text-blue-100" id="formTitle">Connectez-vous à votre compte</p>
        </div>

        <!-- Formulaire -->
        <div class="p-8">
            <form id="authForm" action="" method="POST" class="space-y-6">
                <div id="nameFields" class="flex gap-4 hidden">
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Prénom</label>
                        <input type="text" name="firstname" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#00B4DB] focus:border-transparent transition" placeholder="John">
                    </div>
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nom</label>
                        <input type="text" name="lastname" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#00B4DB] focus:border-transparent transition" placeholder="Doe">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <div class="relative">
                        <input type="email" name="email" class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#00B4DB] focus:border-transparent transition" placeholder="exemple@email.com" required>
                        <svg class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Mot de passe</label>
                    <div class="relative">
                        <input type="password" name="password" id="password" class="w-full pl-10 pr-12 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#00B4DB] focus:border-transparent transition" placeholder="••••••••" required>
                        <svg class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        <button type="button" id="togglePassword" class="absolute right-3 top-2.5 text-gray-400 hover:text-gray-600">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <button type="submit" class="w-full py-3 px-4 bg-gradient-to-r from-[#2E3192] to-[#00B4DB] text-white rounded-lg font-medium hover:opacity-90 transform transition focus:ring-2 focus:ring-offset-2 focus:ring-[#00B4DB]">
                    Se connecter
                </button>
            </form>

            <div class="mt-6 text-center">
                <button id="toggleForm" class="text-sm text-[#00B4DB] hover:text-[#2E3192] transition">
                    Pas encore de compte ? S'inscrire
                </button>
            </div>
        </div>
    </form>

    <p class="text-center text-gray-600 mt-4">Déjà inscrit? 
        <a href="/index.php/login_form" class="text-primary hover:underline">Se connecter</a>
    </p>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/layout.php';
?>