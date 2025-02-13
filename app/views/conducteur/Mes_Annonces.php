<?php
session_start();
require_once 'config.php';

// Fetch all active drivers with their stats
$query = "
    SELECT 
        u.id,
        u.nom,
        u.prenom,
        u.photo,
        u.telephone,
        u.email,
        COUNT(DISTINCT i.id) as total_trips,
        COUNT(DISTINCT c.id) as total_deliveries,
        ROUND(AVG(CASE 
            WHEN i.date_arriver IS NOT NULL 
            THEN EXTRACT(EPOCH FROM (i.date_arriver - i.date_depart))/3600 
        END)) as avg_delivery_time,
        (
            SELECT statut 
            FROM itineraire 
            WHERE conducteur_id = u.id 
            ORDER BY date_depart DESC 
            LIMIT 1
        ) as current_status
    FROM utilisateurs u
    LEFT JOIN itineraire i ON u.id = i.conducteur_id
    LEFT JOIN colis c ON i.id = c.itineraire_id
    WHERE u.role = 'conducteur' AND u.etat = 'actif'
    GROUP BY u.id
    ORDER BY total_deliveries DESC";

$result = pg_query($conn, $query);
$drivers = pg_fetch_all($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Drivers - TruckTrace</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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

        .drivers-header {
            background-color: var(--dark-blue);
            color: white;
            padding: 3rem 0;
            margin-bottom: 2rem;
        }

        .search-box {
            max-width: 500px;
            margin: 1rem auto;
        }

        .driver-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            height: 100%;
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .driver-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .driver-photo-container {
            position: relative;
            padding-top: 100%;
            background-color: #f8f9fa;
            overflow: hidden;
        }

        .driver-photo {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .status-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: bold;
            background-color: #e8f5e9;
            color: #2e7d32;
        }

        .driver-info {
            padding: 1.5rem;
        }

        .driver-name {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
            color: var(--dark-blue);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 0.5rem;
            margin: 1rem 0;
        }

        .stat-item {
            text-align: center;
            padding: 0.5rem;
            background-color: #f8f9fa;
            border-radius: 8px;
        }

        .stat-number {
            font-weight: bold;
            color: var(--dark-blue);
        }

        .stat-label {
            font-size: 0.8rem;
            color: #666;
        }

        .view-profile-btn {
            background-color: var(--dark-blue);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.3s;
            border: none;
            width: 100%;
            text-align: center;
        }

        .view-profile-btn:hover {
            background-color: #151b60;
            color: white;
        }

        .rating {
            color: var(--yellow);
            margin-bottom: 1rem;
        }

        .filters {
            margin-bottom: 2rem;
        }

        footer {
            background-color: var(--dark-blue);
            color: white;
            padding: 1rem 0;
            position: absolute;
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
                        <a class="nav-link" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <div class="drivers-header">
        <div class="container text-center">
            <h1>Our Professional Drivers</h1>
            <p class="lead">Choose from our experienced and reliable drivers for your delivery needs</p>
            
            <!-- Search Box -->
            <div class="search-box">
                <input type="text" class="form-control" placeholder="Search drivers by name or location..." 
                       id="searchDriver">
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mb-5">
        <!-- Filters -->
        <div class="filters">
            <div class="row">
                <div class="col-md-3">
                    <select class="form-select" id="statusFilter">
                        <option value="">All Statuses</option>
                        <option value="available">Available Now</option>
                        <option value="en-route">En Route</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select" id="experienceFilter">
                        <option value="">Experience Level</option>
                        <option value="expert">Expert (5+ years)</option>
                        <option value="intermediate">Intermediate (2-5 years)</option>
                        <option value="beginner">Beginner (0-2 years)</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select" id="ratingFilter">
                        <option value="">Rating</option>
                        <option value="5">5 Stars</option>
                        <option value="4">4+ Stars</option>
                        <option value="3">3+ Stars</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-outline-primary w-100" onclick="resetFilters()">
                        Reset Filters
                    </button>
                </div>
            </div>
        </div>

        <!-- Drivers Grid -->
        <div class="row g-4">
            <?php foreach ($drivers as $driver): ?>
            <div class="col-md-6 col-lg-4">
                <div class="driver-card">
                    <div class="driver-photo-container">
                        <img src="data:image/jpeg;base64,<?php echo base64_encode(pg_unescape_bytea($driver['photo'])); ?>" 
                             alt="Driver Photo" class="driver-photo">
                        <span class="status-badge">
                            <?php echo htmlspecialchars($driver['current_status'] ?? 'Available'); ?>
                        </span>
                    </div>
                    <div class="driver-info">
                        <h3 class="driver-name">
                            <?php echo htmlspecialchars($driver['prenom'] . ' ' . $driver['nom']); ?>
                        </h3>
                        
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                            <span class="ms-2">4.5</span>
                        </div>

                        <div class="stats-grid">
                            <div class="stat-item">
                                <div class="stat-number"><?php echo $driver['total_trips']; ?></div>
                                <div class="stat-label">Trips</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number"><?php echo $driver['total_deliveries']; ?></div>
                                <div class="stat-label">Deliveries</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number"><?php echo $driver['avg_delivery_time']; ?>h</div>
                                <div class="stat-label">Avg Time</div>
                            </div>
                        </div>

                        <a href="driver-profile.php?id=<?php echo $driver['id']; ?>" 
                           class="view-profile-btn">
                            View Profile
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center">
        <div class="container">
            <p class="mb-0">&copy; 2024 TruckTrace. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Search functionality
        document.getElementById('searchDriver').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const driverCards = document.querySelectorAll('.driver-card');
            
            driverCards.forEach(card => {
                const driverName = card.querySelector('.driver-name').textContent.toLowerCase();
                const parent = card.closest('.col-md-6');
                
                if (driverName.includes(searchTerm)) {
                    parent.style.display = '';
                } else {
                    parent.style.display = 'none';
                }
            });
        });

        // Reset filters
        function resetFilters() {
            document.getElementById('statusFilter').value = '';
            document.getElementById('experienceFilter').value = '';
            document.getElementById('ratingFilter').value = '';
            // Reset the display of all cards
            document.querySelectorAll('.col-md-6').forEach(card => {
                card.style.display = '';
            });
        }
    </script>
</body>
</html>