<?php

$title = "Register - sari3";
ob_start();
?>
<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
  <h2 class="text-2xl font-bold mb-4 text-center">Register</h2>
  
  <form action="index.php?action=register" method="POST" id="registerForm" enctype="multipart/form-data">
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <label class="block text-gray-700">First Name</label>
        <input type="text" name="Prenom" class="w-full border border-gray-300 p-2 rounded" placeholder="First Name" required>
      </div>
      <div>
        <label class="block text-gray-700">Last Name</label>
        <input type="text" name="Nom" class="w-full border border-gray-300 p-2 rounded" placeholder="Last Name" required>
      </div>
    </div>

    <div class="mt-4">
      <label class="block text-gray-700">Email</label>
      <input type="email" name="Email" class="w-full border border-gray-300 p-2 rounded" placeholder="Email" required>
    </div>

    <div class="mt-4">
      <label class="block text-gray-700">Password</label>
      <input type="password" name="Mot_de_passe" class="w-full border border-gray-300 p-2 rounded" placeholder="Password" required>
    </div>

    <div class="mt-4">
      <label class="block text-gray-700">Phone</label>
      <input type="text" name="Telephone" class="w-full border border-gray-300 p-2 rounded" placeholder="Phone" required>
    </div>

    <div class="mt-4">
      <label class="block text-gray-700">Photo</label>
      <input type="file" name="Photo" class="w-full border border-gray-300 p-2 rounded" required>
    </div>

    <div class="mt-4">
      <label class="block text-gray-700">Role</label>
      <select name="Role" class="w-full border border-gray-300 p-2 rounded" required>
        <option value="">Select Role</option>
        <option value="admin">Admin</option>
        <option value="Conducteur">Conducteur</option>
        <option value="Expediteur">Expediteur</option>
      </select>
    </div>

    <div class="mt-6">
      <button type="submit" class="w-full bg-primary text-white py-2 rounded hover:bg-secondary">Register</button>
    </div>
  </form>

  <p class="text-center text-gray-600 mt-4">Already have an account? 
    <a href="index.php?action=login_form" class="text-primary hover:underline">Login</a>
  </p>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/layout.php';
?>
