<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver Profile - TruckTrace</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script> 
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
<body class="overflow-x-hidden">
    <!-- Navbar -->
    

    
    <!-- Driver Profile Content -->
    <div class="driver-container">
        <div class="row">
            <!-- Driver Info Card -->
            <div class="col-md-4">
                <div class="profile-card text-center">
                    <img src="data:image/jpeg;base64,<?php echo 'ggg' ?>" 
                         alt="Driver Photo" class="driver-photo">
                    <h3 class="mt-3"><?php echo "hello" ?></h3>
                    <div class="rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                        <span class="ms-2">4.5</span>
                    </div>
                    <p class="text-muted mb-4">Professional Truck Driver</p>

                    <button class="select-driver-btn mt-4 w-100" data-bs-toggle="modal" data-bs-target="#selectDriverModal">
                        Select Driver
                    </button>
                </div>
            </div>

            <!-- Route Map and History -->
            <div class="col-md-8">
                <div class="profile-card">
                    <h4 class="mb-4">Current Route</h4>
                    <div id="map" class="route-map"></div>

                    <h4 class="mb-4 mt-5">Recent Routes</h4>
                
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
                    <form action="/index.php/makeRequest" method="POST">
                        
                        <input type="hidden" name="expediteur_id" value="<?php echo $_SESSION["user"]->id; ?>">
                        <input type="hidden" name="itineraire_id" value="<?php echo $Itineraire->getId(); ?>">
                        
            
                        <div class="mb-3">
                            <label class="form-label">Nom</label>
                            <input type="text" class="form-control" name="nom" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Origin</label>
                                <select name="origin" class="form-control" required>
                                    <?php
                                    foreach ($Details as $city) {
                                           ?>

                                            <option value="<?=$city->getVille()?>"><?=$city->getVille()?></option>
                                   <?php
                                 }
                                    ?>
                                </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Destination</label>
                                <select name="destination" class="form-control" required>
                                    <?php
                                    foreach ($Details as $city) 
                                    {
                                        if($city->getOrders() != 0){

                                            ?>

                                <option value="<?=$city->getVille()?>"><?=$city->getVille()?></option>
                                    <?php
                                    }
                                    }
                                    ?>
                                </select>
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