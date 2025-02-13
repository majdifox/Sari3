<?php
// app/views/layout.php
// This layout expects a $content variable that contains the page-specific HTML.
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>sari3 - Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Optionally, add custom Tailwind configuration -->
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              primary: "#2563EB", // Blue tone for a medical feel
              secondary: "#1E40AF"
            }
          }
        }
      }
    </script>
</head>
<body class="bg-blue-50">
  <!-- Header -->
  <header class="bg-primary text-white py-4 shadow-md">
    <div class="container mx-auto px-4 flex justify-between items-center">
      <h1 class="text-2xl font-bold">sari3</h1>
      <nav>
        <ul class="flex space-x-4">
          <!-- Adjust these links to suit the user's role or dashboard -->
          <li><a href="login.php" class="hover:underline">LogIn</a></li>
          <li><a href="inscription.php" class="hover:underline">Register</a></li>
          <li><a href="logout.php" class="hover:underline">Logout</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <!-- Main Content Area -->
  <main class="container mx-auto px-4 py-6">
    <?= $content ?? '<p class="text-xl text-gray-700">Welcome to sari3!</p>' ?>
  </main>

  <!-- Footer -->
  <footer class="bg-primary text-white py-4 mt-8">
    <div class="container mx-auto px-4 text-center">
      <p>&copy; <?= date("Y") ?> sari3. All rights reserved.</p>
    </div>
  </footer>
</body>
</html>
