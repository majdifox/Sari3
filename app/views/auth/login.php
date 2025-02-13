<<<<<<< HEAD
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - TruckTrace</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --dark-blue: #1a237e;
            --yellow: #ffd700;
        }

        body {
            background-color: #f8f9fa;
        }

        .navbar {
            background-color: var(--dark-blue);
            padding: 1rem 0;
        }

        .navbar-brand {
            color: var(--yellow) !important;
            font-weight: bold;
            font-size: 1.5rem;
        }

        .nav-link {
            color: white !important;
        }

        .main-container {
            margin-top: 5rem;
            margin-bottom: 2rem;
        }

        .login-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            padding: 2rem;
            border-top: 5px solid var(--yellow);
            max-width: 400px;
            margin: 0 auto;
        }

        .btn-primary {
            background-color: var(--dark-blue);
            border-color: var(--dark-blue);
            padding: 10px 30px;
        }

        .btn-primary:hover {
            background-color: #151b60;
            border-color: #151b60;
        }

        .form-label {
            color: var(--dark-blue);
            font-weight: 500;
        }

        .form-control:focus {
            border-color: var(--dark-blue);
            box-shadow: 0 0 0 0.2rem rgba(26, 35, 126, 0.25);
        }

        .register-link {
            color: var(--dark-blue);
            text-decoration: none;
        }

        .register-link:hover {
            color: #151b60;
            text-decoration: underline;
        }

        .form-header {
            color: var(--dark-blue);
            border-bottom: 2px solid var(--yellow);
            padding-bottom: 10px;
            margin-bottom: 25px;
        }

        footer {
            background-color: var(--dark-blue);
            color: white;
            padding: 1rem 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">TruckTrace</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Login Form -->
    <div class="container main-container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="login-card">
                    <h2 class="text-center form-header">Connexion</h2>
                    <form action="http://sari3.test/index.php/login" method="POST">
                        <div class="mb-4">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Mot de passe</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="text-center mb-3">
                            <button type="submit" class="btn btn-primary w-100">Se connecter</button>
                        </div>

                        <div class="text-center">
                            <p>Pas encore de compte? <a href="index.php?action=register_form" class="register-link">S'inscrire</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center">
        <div class="container">
            <p class="mb-0">&copy; 2024 TruckTrace. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
=======
<?php

$title = "Login - YouCare";
ob_start();
?>
<div class="max-w-md mx-auto bg-white p-6 rounded shadow">
  <h2 class="text-xl font-bold mb-4 text-center">Login</h2>
  <form action="index.php?action=login" method="POST">
    <div class="mb-4">
      <label class="block text-gray-700">Email</label>
      <input type="email" name="email" class="w-full border border-gray-300 p-2 rounded" placeholder="Email" required>
    </div>
    <div class="mb-4">
      <label class="block text-gray-700">Password</label>
      <input type="password" name="password" class="w-full border border-gray-300 p-2 rounded" placeholder="Password" required>
    </div>
    <div class="mb-4">
      <button type="submit" class="w-full bg-primary text-white py-2 rounded hover:bg-secondary">Login</button>
    </div>
  </form>
  <p class="text-center text-gray-600">Don't have an account? <a href="index.php?action=register_form" class="text-primary hover:underline">Sign up</a></p>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/layout.php';
>>>>>>> mehdi
