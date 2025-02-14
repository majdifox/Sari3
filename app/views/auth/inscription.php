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
            <div>
                <label class="block text-gray-700">Nom</label>
                <input type="text" name="nom" class="w-full border border-gray-300 p-2 rounded" required>
            </div>
            <div>
                <label class="block text-gray-700">Prénom</label>
                <input type="text" name="prenom" class="w-full border border-gray-300 p-2 rounded" required>
            </div>
            <div>
                <label class="block text-gray-700">Téléphone</label>
                <input type="tel" name="telephone" class="w-full border border-gray-300 p-2 rounded" required>
            </div>
        </div>

        <div class="mt-4">
            <label class="block text-gray-700">Email</label>
            <input type="email" name="email" class="w-full border border-gray-300 p-2 rounded" required>
        </div>

        <div class="mt-4">
            <label class="block text-gray-700">Mot de passe</label>
            <input type="password" name="mot_de_passe" class="w-full border border-gray-300 p-2 rounded" required>
        </div>

        <div class="mt-4">
            <label class="block text-gray-700">Photo</label>
            <input type="file" name="photo" accept="image/*" class="w-full border border-gray-300 p-2 rounded" required>
        </div>

        <div class="mt-4">
            <label class="block text-gray-700">Role</label>
            <select name="role" class="w-full border border-gray-300 p-2 rounded" required>
                <option value="">Sélectionner un role</option>
                <option value="Conducteur">Conducteur</option>
                <option value="Expediteur">Expediteur</option>
            </select>
        </div>

        <div class="mt-6">
            <button type="submit" class="w-full bg-primary text-white py-2 rounded hover:bg-secondary">S'inscrire</button>
        </div>
    </form>

    <p class="text-center text-gray-600 mt-4">Déjà inscrit? 
        <a href="/index.php/login" class="text-primary hover:underline">Se connecter</a>
    </p>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/layout.php';
?>