<?php
session_start();
require_once 'config.php'; // Include your database connection

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Fetch user data
$user_id = $_SESSION['user_id'];
$query = "SELECT nom, prenom, telephone, email, photo FROM utilisateurs WHERE id = $1";
$result = pg_query_params($conn, $query, array($user_id));
$user = pg_fetch_assoc($result);

// Handle profile update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
    
    // Handle photo upload if provided
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === 0) {
        $photo = pg_escape_bytea(file_get_contents($_FILES['photo']['tmp_name']));
        $update_query = "UPDATE utilisateurs SET nom = $1, prenom = $2, telephone = $3, email = $4, photo = $5 WHERE id = $6";
        $params = array($nom, $prenom, $telephone, $email, $photo, $user_id);
    } else {
        $update_query = "UPDATE utilisateurs SET nom = $1, prenom = $2, telephone = $3, email = $4 WHERE id = $5";
        $params = array($nom, $prenom, $telephone, $email, $user_id);
    }
    
    $update_result = pg_query_params($conn, $update_query, $params);
    
    if ($update_result) {
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - TruckTrace</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --dark-blue: #1a237e;
            --yellow: #ffd700;
        }

        body {
            background-color: #f8f9fa;
            min-height: 100vh;
            position: relative;
            padding-bottom: 60px;
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

        .profile-container {
            margin: 2rem auto;
            max-width: 1200px;
        }

        .profile-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            padding: 2rem;
            border-top: 5px solid var(--yellow);
            margin-bottom: 2rem;
        }

        .profile-photo {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto 1rem;
            border: 3px solid var(--yellow);
        }

        .btn-primary {
            background-color: var(--dark-blue);
            border-color: var(--dark-blue);
        }

        .btn-primary:hover {
            background-color: #151b60;
            border-color: #151b60;
        }

        .profile-header {
            color: var(--dark-blue);
            border-bottom: 2px solid var(--yellow);
            padding-bottom: 10px;
            margin-bottom: 25px;
        }

        .profile-info {
            margin-bottom: 1.5rem;
        }

        .info-label {
            color: var(--dark-blue);
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .info-value {
            font-size: 1.1rem;
            color: #666;
        }

        footer {
            background-color: var(--dark-blue);
            color: white;
            padding: 1rem 0;
            position: absolute;
            bottom: 0;
            width: 100%;
        }

        .modal-content {
            border-top: 5px solid var(--yellow);
        }

        .modal-header {
            border-bottom: 2px solid var(--yellow);
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
                        <a class="nav-link" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="deliveries.php">Deliveries</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Profile Content -->
    <div class="profile-container">
        <div class="row">
            <!-- Profile Summary Card -->
            <div class="col-md-4">
                <div class="profile-card text-center">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode(pg_unescape_bytea($user['photo'])); ?>" 
                         alt="Profile Photo" class="profile-photo">
                    <h3 class="mt-3"><?php echo htmlspecialchars($user['prenom'] . ' ' . $user['nom']); ?></h3>
                    <p class="text-muted">Truck Driver</p>
                    <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                        Edit Profile
                    </button>
                </div>
            </div>

            <!-- Profile Details Card -->
            <div class="col-md-8">
                <div class="profile-card">
                    <h4 class="profile-header">Profile Information</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="profile-info">
                                <div class="info-label">First Name</div>
                                <div class="info-value"><?php echo htmlspecialchars($user['prenom']); ?></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="profile-info">
                                <div class="info-label">Last Name</div>
                                <div class="info-value"><?php echo htmlspecialchars($user['nom']); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="profile-info">
                                <div class="info-label">Phone</div>
                                <div class="info-value"><?php echo htmlspecialchars($user['telephone']); ?></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="profile-info">
                                <div class="info-label">Email</div>
                                <div class="info-value"><?php echo htmlspecialchars($user['email']); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Profile Modal -->
    <div class="modal fade" id="editProfileModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label">First Name</label>
                            <input type="text" class="form-control" name="prenom" 
                                   value="<?php echo htmlspecialchars($user['prenom']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Last Name</label>
                            <input type="text" class="form-control" name="nom" 
                                   value="<?php echo htmlspecialchars($user['nom']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="tel" class="form-control" name="telephone" 
                                   value="<?php echo htmlspecialchars($user['telephone']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" 
                                   value="<?php echo htmlspecialchars($user['email']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Profile Photo</label>
                            <input type="file" class="form-control" name="photo" accept="image/*">
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
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