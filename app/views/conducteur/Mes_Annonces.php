<<<<<<< HEAD
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

=======
>>>>>>> SQL
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
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
=======
    <!-- Lien du Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Lien des Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 
    
    <title>Articles</title>
</head>
<body class="bg-blue-200">

    <header class="mb-[4rem]">
        <nav class="bg-white border-gray-200 px-4 lg:px-6 py-2.5 dark:bg-gray-800">
            <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
                <a class="flex items-center">
                    <img src="../Red-Blue-Modern-Logistics-Express-Logo.png" class="mr-3 mt-[-1rem] w-[7rem]" alt="Site Web Logo" />
                </a>
                <div class="flex items-center lg:order-2 mt-[-1rem]">
                    <a href="../templates/logout.php" class="text-white bg-blue-500 hover:opacity-80 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">Logout</a>
                    <button data-collapse-toggle="mobile-menu-2" type="button" class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="mobile-menu-2" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                        <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                </div>
                <div class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1 mt-[-1rem]" id="mobile-menu-2">
                    <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                        <li>
                            <a href="profile_enseignant.php" class="block py-2 pr-4 pl-3 text-stone-700 rounded bg-primary-700 lg:bg-transparent lg:text-primary-700 lg:p-0 dark:text-white" aria-current="page">Profile</a>
                        </li>
                        <li>
                            <a href="cours_enseignant.php" class="block py-2 pr-4 pl-3 text-stone-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">Mes Cours</a>
                        </li>
                        <li>
                            <a href="gestion_cours_enseignant.php" class="block py-2 pr-4 pl-3 text-stone-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">Gestion</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Annonce Form-->
    <div id="postform" class="hidden fixed left-[32rem] top-[0rem] flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:pr-4 dark:bg-gray-800 dark:border-gray-700">
            <i id="xmarkcsltion2" class="fa-solid fa-xmark ml-[26rem] text-2xl cursor-pointer mt-[1.2rem]" style="color: #2e2e2e;"></i>
            <div class="space-y-6 py-8 px-10">
                <h1 class="text-xl mt-[-2rem] font-bold leading-tight tracking-tight text-stone-700 md:text-2xl dark:text-white">
                    Publier votre Cours 
                </h1>
                <form class="space-y-1" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="conducteur_id" id="medecin_id" value="">
                    <div class="mb-5">
                        <label for="date_reservation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date de Depart</label>
                        <input type="datetime-local" id="date_reservation" name="date_reservation" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required />
                    </div>
                    <div class="mb-5">
                        <label for="date_reservation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date d'Arrivé</label>
                        <input type="datetime-local" id="date_reservation" name="date_reservation" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required />
                    </div>
                    <div class="mb-5">
                        <label for="vehicle-select" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Choisissez Votre Véhicule</label>
                        <select id="vehicle-select" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                            <option value=""></option>
                        </select>
                    </div>
                    
                    <button type="submit" class="ml-[7rem] mt-[5rem] w-[8rem] text-white bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 hover:bg-gradient-to-br font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Creer</button>
                </form>
            </div>
        </div>
    </div>


    <main>
        <!-- Boutton pour afficher le form de creation des annonces-->
        <div class="pl-[20rem] pr-[19rem]">
            <button id="ajtpost" class="w-full rounded-md bg-gradient-to-r from-blue-400 via-blue-600 to-blue-700 hover:bg-gradient-to-br py-4 px-4 font-bold text-center text-xl text-white transition-all shadow-md hover:shadow-lg active:bg-blue-700 hover:bg-blue-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none mb-[2rem]" type="button">
                Publier un Cours <span class="ml-[0.7rem]"><i class="fa-solid fa-paper-plane" style="color: #ffffff;"></i></span>
            </button>
        </div>    

        <!-- Les annonces du conducteur-->
        <div class="mt-[4rem] ml-[20rem] bg-white dark:bg-gray-800 rounded-xl shadow-2xl max-w-4xl w-full p-8 transition-all duration-300 animate-fade-in pt-[3.5rem]">
            <div class="flex flex-col md:flex-row">
                <div class="md:w-1/3 text-center mb-8 md:mb-0">

                    <h2 class="text-xl font-semibold text-blue-500 mb-4  mt-[3rem]">Vehicule</h2>
                    <p class="text-stone-700 font-semibold">Ford Transit - Camion</p>

                    <a  href=''>
                    <button class="ml-[5.7rem] mt-[5rem] flex items-center rounded-md border border-blue-300 py-2 px-4 text-center text-sm transition-all shadow-sm hover:shadow-lg text-blue-600 hover:text-white hover:bg-blue-800 hover:border-blue-800 focus:text-white focus:bg-blue-800 focus:border-blue-800 active:border-blue-800 active:text-white active:bg-blue-800 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="button">
                        Details
                        
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 ml-1.5">
                            <path fill-rule="evenodd" d="M16.28 11.47a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 0 1-1.06-1.06L14.69 12 7.72 5.03a.75.75 0 0 1 1.06-1.06l7.5 7.5Z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    </a>
                </div>

                <div class="mb-8">
                    
                    <h2 class="text-xl font-semibold text-blue-500">Date de Depart</h2>
                    <p class="text-lg font-semibold text-stone-700">15-02-2025</p>
                    
                    <h3 class="text-xl font-semibold text-blue-500">Date d'Arrivé</h2>
                    <p class="text-lg font-semibold text-stone-700">17-02-2025</p>
                </div>
            </div>

            <div class="mb-[0.5rem]">
                <hr class="h-px w-[50rem] my-4 bg-gray-200 border-0 dark:bg-gray-700">

                <svg id="morecmnt" class="w-4 h-4 text-blue-700 cursor-pointer" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 10">
                    <path d="M15.434 1.235A2 2 0 0 0 13.586 0H2.414A2 2 0 0 0 1 3.414L6.586 9a2 2 0 0 0 2.828 0L15 3.414a2 2 0 0 0 .434-2.179Z"/>
                </svg>
                <svg id="lesscmnt" class="w-4 h-4 text-blue-700 cursor-pointer hidden" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 10 16">
                    <path d="M3.414 1A2 2 0 0 0 0 2.414v11.172A2 2 0 0 0 3.414 15L9 9.414a2 2 0 0 0 0-2.828L3.414 1Z"/>
                </svg>
            </div>

        </div>

        <div class="mt-[4rem] ml-[20rem] bg-white dark:bg-gray-800 rounded-xl shadow-2xl max-w-4xl w-full p-8 transition-all duration-300 animate-fade-in pt-[3.5rem]">
            <div class="flex flex-col md:flex-row">
                <div class="md:w-1/3 text-center mb-8 md:mb-0">

                    <h2 class="text-xl font-semibold text-blue-500 mb-4  mt-[3rem]">Vehicule</h2>
                    <p class="text-stone-700 font-semibold">Ford Transit - Camion</p>

                    <a  href=''>
                    <button class="ml-[5.7rem] mt-[5rem] flex items-center rounded-md border border-blue-300 py-2 px-4 text-center text-sm transition-all shadow-sm hover:shadow-lg text-blue-600 hover:text-white hover:bg-blue-800 hover:border-blue-800 focus:text-white focus:bg-blue-800 focus:border-blue-800 active:border-blue-800 active:text-white active:bg-blue-800 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="button">
                        Details
                        
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 ml-1.5">
                            <path fill-rule="evenodd" d="M16.28 11.47a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 0 1-1.06-1.06L14.69 12 7.72 5.03a.75.75 0 0 1 1.06-1.06l7.5 7.5Z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    </a>
                </div>

                <div class="mb-8">
                    
                    <h2 class="text-xl font-semibold text-blue-500">Date de Depart</h2>
                    <p class="text-lg font-semibold text-stone-700">15-02-2025</p>
                    
                    <h3 class="text-xl font-semibold text-blue-500">Date d'Arrivé</h2>
                    <p class="text-lg font-semibold text-stone-700">17-02-2025</p>
                </div>
            </div>

            <div class="mb-[0.5rem]">
                <hr class="h-px w-[50rem] my-4 bg-gray-200 border-0 dark:bg-gray-700">

                <svg id="morecmnt" class="w-4 h-4 text-blue-700 cursor-pointer" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 10">
                    <path d="M15.434 1.235A2 2 0 0 0 13.586 0H2.414A2 2 0 0 0 1 3.414L6.586 9a2 2 0 0 0 2.828 0L15 3.414a2 2 0 0 0 .434-2.179Z"/>
                </svg>
                <svg id="lesscmnt" class="w-4 h-4 text-blue-700 cursor-pointer hidden" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 10 16">
                    <path d="M3.414 1A2 2 0 0 0 0 2.414v11.172A2 2 0 0 0 3.414 15L9 9.414a2 2 0 0 0 0-2.828L3.414 1Z"/>
                </svg>
            </div>

        </div>
        
        <div class="mt-[4rem] ml-[20rem] bg-white dark:bg-gray-800 rounded-xl shadow-2xl max-w-4xl w-full p-8 transition-all duration-300 animate-fade-in pt-[3.5rem]">
            <div class="flex flex-col md:flex-row">
                <div class="md:w-1/3 text-center mb-8 md:mb-0">

                    <h2 class="text-xl font-semibold text-blue-500 mb-4  mt-[3rem]">Vehicule</h2>
                    <p class="text-stone-700 font-semibold">Ford Transit - Camion</p>

                    <a  href=''>
                    <button class="ml-[5.7rem] mt-[5rem] flex items-center rounded-md border border-blue-300 py-2 px-4 text-center text-sm transition-all shadow-sm hover:shadow-lg text-blue-600 hover:text-white hover:bg-blue-800 hover:border-blue-800 focus:text-white focus:bg-blue-800 focus:border-blue-800 active:border-blue-800 active:text-white active:bg-blue-800 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="button">
                        Details
                        
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 ml-1.5">
                            <path fill-rule="evenodd" d="M16.28 11.47a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 0 1-1.06-1.06L14.69 12 7.72 5.03a.75.75 0 0 1 1.06-1.06l7.5 7.5Z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    </a>
                </div>

                <div class="mb-8">
                    
                    <h2 class="text-xl font-semibold text-blue-500">Date de Depart</h2>
                    <p class="text-lg font-semibold text-stone-700">15-02-2025</p>
                    
                    <h3 class="text-xl font-semibold text-blue-500">Date d'Arrivé</h2>
                    <p class="text-lg font-semibold text-stone-700">17-02-2025</p>
                </div>
            </div>

            <div class="mb-[0.5rem]">
                <hr class="h-px w-[50rem] my-4 bg-gray-200 border-0 dark:bg-gray-700">

                <svg id="morecmnt" class="w-4 h-4 text-blue-700 cursor-pointer" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 10">
                    <path d="M15.434 1.235A2 2 0 0 0 13.586 0H2.414A2 2 0 0 0 1 3.414L6.586 9a2 2 0 0 0 2.828 0L15 3.414a2 2 0 0 0 .434-2.179Z"/>
                </svg>
                <svg id="lesscmnt" class="w-4 h-4 text-blue-700 cursor-pointer hidden" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 10 16">
                    <path d="M3.414 1A2 2 0 0 0 0 2.414v11.172A2 2 0 0 0 3.414 15L9 9.414a2 2 0 0 0 0-2.828L3.414 1Z"/>
                </svg>
            </div>

        </div>
            
     

    </main>

    <div class="bg-white rounded-lg p-4 flex items-center flex-wrap mt-[2rem]">
        <nav class="mx-auto" aria-label="Page navigation">
            <ul class="inline-flex">
            <a href="">
                <li><button class="h-10 px-5 text-blue-600 transition-colors duration-150 rounded-l-lg focus:shadow-outline hover:bg-blue-100">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path></svg></button>
                </li>
            </a>

            <a href="">
                <li><button class="h-10 px-5 text-blue-600 transition-colors duration-150 bg-white rounded-r-lg focus:shadow-outline hover:bg-blue-100">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path></svg></button>
                </li>
            </a>
            </ul>
        </nav>
    </div>

    <footer class="bg-white rounded-lg shadow dark:bg-gray-900 m-4">
        <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
            <div class="sm:flex sm:items-center sm:justify-between">
                <a class="flex items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse">
                    <img src="../Red-Blue-Modern-Logistics-Express-Logo.png" class="mb-[-2rem] w-[7rem]" alt="Flowbite Logo" />
                </a>
                <ul class="flex flex-wrap items-center mb-6 text-sm font-medium text-gray-500 sm:mb-0 dark:text-gray-400">
                    <li>
                        <a href="https://oussamaamou.github.io/PortFolio-HTML-CSS-JS/" target="_blank" class="hover:underline me-4 md:me-6">About</a>
                    </li>
                    <li>
                        <a href="https://www.youcode.ma/" target="_blank" class="hover:underline me-4 md:me-6">Licensing</a>
                    </li>
                    <li>
                        <a href="https://www.linkedin.com/in/oussama-amou-b71151337/" target="_blank" class="hover:underline">Contact</a>
                    </li>
                </ul>
            </div>
            <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
            <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2024 <a href="https://flowbite.com/" class="hover:underline">YouDemy Education</a>. Tous droits réservés.</span>
        </div>
    </footer>



    <script>

        fetch('https://oussamaamou.github.io/Vehicules-Colliers-API/')
        .then(response => response.json())
        .then(data => {
            const selectElement = document.getElementById('vehicle-select');
            selectElement.innerHTML = '';

            data.vehicules.forEach(vehicule => {
                const option = document.createElement('option');
                option.value = vehicule.id; 
                option.textContent = `${vehicule.marque} ${vehicule.modele} - ${vehicule.type_vehicule}`;
                selectElement.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error fetching data:', error);
            const selectElement = document.getElementById('vehicle-select');
            selectElement.innerHTML = '<option value="">Failed to load vehicles</option>';
        });

        const ctnr2 = document.getElementById("postform");
        const xmark2 = document.getElementById("xmarkcsltion2");
        const ajtpost = document.getElementById("ajtpost");
        const dropdownbutton = document.getElementById("dropdown-button");
        const dropdown1 = document.getElementById("dropdown-1");
        
        xmark2?.addEventListener('click', function(){
            ctnr2.classList.add('hidden');
        });


        ajtpost?.addEventListener('click', function(){
            ctnr2.classList.remove('hidden');
        });

        dropdownbutton?.addEventListener('click', function(){
            dropdown1.classList.remove('hidden');
        });

        dropdownbutton?.addEventListener('dblclick', function(){
            dropdown1.classList.add('hidden');
        });

        document.addEventListener('DOMContentLoaded', function() {
            
            const morecmntButtons = document.querySelectorAll("#morecmnt");
            const lesscmntButtons = document.querySelectorAll("#lesscmnt");
            const cmntSections = document.querySelectorAll("#cmntsction");

            morecmntButtons.forEach((button, index) => {
                button.addEventListener('click', function() {
                    cmntSections[index].classList.remove('hidden');
                    button.classList.add('hidden'); 
                    lesscmntButtons[index].classList.remove('hidden');
                });
            });

            lesscmntButtons.forEach((button, index) => {
                button.addEventListener('click', function() {
                    cmntSections[index].classList.add('hidden');
                    button.classList.add('hidden'); 
                    morecmntButtons[index].classList.remove('hidden');
                });
            });
        });

>>>>>>> SQL
    </script>
</body>
</html>