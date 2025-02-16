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


  <!-- Main Content Area -->
  <main class="container mx-auto px-4 py-6">
    <?= $content ?? '<p class="text-xl text-gray-700">Welcome to sari3!</p>' ?>
  </main>

</body>
</html>