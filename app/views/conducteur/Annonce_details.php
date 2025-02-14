<?php




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver Profile - TruckTrace</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.css" rel="stylesheet">
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

        .driver-container {
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

        .driver-photo {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto 1rem;
            border: 3px solid var(--yellow);
        }

        .stats-card {
            text-align: center;
            padding: 1.5rem;
            background: #f8f9fa;
            border-radius: 10px;
            margin-bottom: 1rem;
        }

        .stats-number {
            font-size: 2rem;
            color: var(--dark-blue);
            font-weight: bold;
        }

        .stats-label {
            color: #666;
            font-size: 0.9rem;
        }

        .route-map {
            height: 300px;
            border-radius: 10px;
            margin-bottom: 1rem;
        }

        .route-card {
            background: white;
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 1rem;
            border-left: 4px solid var(--yellow);
        }

        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: bold;
        }

        .status-active {
            background-color: #e8f5e9;
            color: #2e7d32;
        }

        .select-driver-btn {
            background-color: var(--dark-blue);
            color: white;
            padding: 1rem 2rem;
            border-radius: 30px;
            font-weight: bold;
            border: none;
            transition: all 0.3s;
        }

        .select-driver-btn:hover {
            background-color: #151b60;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .rating {
            color: var(--yellow);
            font-size: 1.2rem;
            margin: 1rem 0;
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
                        <a class="nav-link" href="drivers.php">All Drivers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Driver Profile Content -->
    <div class="driver-container">
        <div class="row">
            <!-- Driver Info Card -->
            <div class="col-md-4">
                <div class="profile-card text-center">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode(pg_unescape_bytea($driver['photo'])); ?>" 
                         alt="Driver Photo" class="driver-photo">
                    <h3 class="mt-3"><?php echo htmlspecialchars($_SESSION['user']['prenom'] . ' ' . $_SESSION['user']['nom']); ?></h3>
                    <div class="rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                        <span class="ms-2">4.5</span>
                    </div>
                    <p class="text-muted mb-4">Professional Truck Driver</p>
                    
                   
                </div>
            </div>

            <!-- Route Map and History -->
            <div class="col-md-8">
                <div class="profile-card">
                    <h4 class="mb-4">Current Route</h4>
                    <div id="map" class="route-map"></div>

                    <h4 class="mb-4 mt-5">Recent Routes</h4>
                    <?php foreach ($Details as $ville): ?>
                        <div class="route-card">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="mb-2">Route #<?php 
                                     if($ville->getStatus()){
                                        echo 'not visited';
                                    }else {
                                       echo 'visted';
                                    } ?></h5>
                                    <p class="mb-1">
                                        <i class="fas fa-truck me-2"></i>
                                        <?php echo htmlspecialchars($ville->getVille()); ?>
                                    </p>
                                    
                                </div>
                                <div class="text-end">
                                    <span class="status-badge status-active">
                                        <?php echo htmlspecialchars($ville->getOrders()); ?>
                                    </span>
                                   
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Select Driver Modal -->
    <div class="modal fade" id="selectDriverModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Select Driver for Delivery</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="process_driver_selection.php" method="POST">
                        <input type="hidden" name="driver_id" value="<?php echo $driver_id; ?>">
                        
            
                        <div class="mb-3">
                            <label class="form-label">Nom</label>
                            <input type="text" class="form-control" name="Nom" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Origin</label>
                            <input type="text" class="form-control" name="origin" required>
                        </div>
                
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Poids (kg)</label>
                                    <input type="number" class="form-control" name="poids" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Volume (m³)</label>
                                    <input type="number" class="form-control" name="volume" required>
                                </div>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100">Confirm Selection</button>
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
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.js"></script>
    <script>
        // Initialize map
        mapboxgl.accessToken = 'YOUR_MAPBOX_ACCESS_TOKEN';
        const map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [-74.5, 40],
            zoom: 9
        });
    </script>
</body>
</html>