<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sarii3 Transport - Authentification</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-[#2E3192] to-[#00B4DB] flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md overflow-hidden">
        <!-- Logo et Titre -->
        <div class="text-center p-8 bg-gradient-to-r from-[#2E3192] to-[#00B4DB]">
            <div class="flex justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 3h18v13H3z"/>
                    <circle cx="7.5" cy="18.5" r="2.5"/>
                    <circle cx="16.5" cy="18.5" r="2.5"/>
                </svg>
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
    </div>

    <script>
        const form = document.getElementById('authForm');
        const toggleFormBtn = document.getElementById('toggleForm');
        const formTitle = document.getElementById('formTitle');
        const nameFields = document.getElementById('nameFields');
        const togglePasswordBtn = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        let isLogin = true;

        toggleFormBtn.addEventListener('click', () => {
            isLogin = !isLogin;
            nameFields.classList.toggle('hidden');
            formTitle.textContent = isLogin ? 'Connectez-vous à votre compte' : 'Créez votre compte';
            toggleFormBtn.textContent = isLogin ? "Pas encore de compte ? S'inscrire" : 'Déjà un compte ? Se connecter';
            form.querySelector('button[type="submit"]').textContent = isLogin ? 'Se connecter' : "S'inscrire";
        });

        togglePasswordBtn.addEventListener('click', () => {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            togglePasswordBtn.innerHTML = type === 'password' ? 
                '<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>' :
                '<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>';
        });

        form.addEventListener('submit', (e) => {
            e.preventDefault();
            const formData = new FormData(form);
            // Ici, vous pouvez ajouter la logique pour envoyer les données au backend PHP
            console.log(Object.fromEntries(formData));
        });
    </script>
</body>
</html>