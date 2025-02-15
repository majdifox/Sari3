
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver Profile - TruckTrace</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.css" rel="stylesheet">
    <!-- Lien du Tailwind -->
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
<body  class="overflow-x-hidden">

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

    <?php if($colis) { 
        
        foreach ($colis as $c) {
            echo "<p>{$c->getNom()} - {$c->getDestination()}</p>";
        }
        ?>
      
    <div id="villestatut" class="fixed ml-[35rem] z-20 bg-white"> 
        <!-- This is an example component --> 
        <div class="max-w-2xl mx-auto"> 
            <div class="p-4 max-w-md bg-white rounded-lg border shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700"> 
                <div class="flex justify-between items-center mb-4"> 
                    <h3 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Latest Customers</h3> 
                    
                    <i id="xmarkcsltion" class="fa-solid fa-xmark ml-[16rem] text-2xl cursor-pointer mt-[1.2rem]" style="color: #2e2e2e;"></i> 
                </div> 
                
                
                <div class="flow-root"> 
                    <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700"> 
                         
                            
                            <?php foreach ($colis as $c) {
                                var_dump($c); ?> 
                            <li class="py-3 sm:py-4"> 
                                <div class="flex items-center space-x-4"> 

                                    <div class="flex-shrink-0"> 
                                        <img class="w-8 h-8 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-1.jpg" alt="Neil image"> 
                                    </div> 
                                    
                                    <div class="flex-1 min-w-0"> 
                                    
                                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white"> <?= htmlspecialchars($c->getNom()) ?> </p> 
                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400"> Depart : <?= htmlspecialchars($c->getOrigin()) ?> </p> 

                                    </div> <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white"> $320 </div> 
                                
                                    <button onclick="colisLivre(<?= htmlspecialchars($c->getId()) ?>)" type="button" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-2.5 py-1 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
                                        </svg>

                                    </button>

                                    <button onclick="ColisNonLivre(<?= htmlspecialchars($c->getId()) ?>)" type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-2.5 py-1 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 0 0 5.636 5.636m12.728 12.728A9 9 0 0 1 5.636 5.636m12.728 12.728L5.636 5.636" />
                                         </svg>

                                    </button>

                                </div> 
                            </li> <?php } ?> 
                            
                    </ul> 
                </div> 
            </div> 
        </div> 
    </div> 
    <?php }else{
        var_dump($colis);
    } ?>

    <form id="LivrationForm" method="POST">
        <input type="hidden" name="Livration_confirmer" id="Livration_confirmer" value="">
    </form>

    <form id="nonLivrationForm" method="POST">
        <input type="hidden" name="Livration_annuler" id="Livration_annuler" value="">
    </form>
    
    <div class="w-full flex-col justify-start items-start gap-10 flex mt-[5rem]"> 
        <div class="w-full justify-between items-start flex sm:flex-row flex-col gap-3"> 

            <h3 class="text-gray-900 text-2xl font-semibold font-manrope leading-9">Order Tracking</h3> 

        </div> 
        
        <div class="w-full py-9 rounded-xl border border-gray-200 flex-col justify-start items-start flex"> 
            <div class="w-full flex-col justify-center sm:items-center items-start gap-8 flex"> 
                <ol class="flex sm:items-center items-start w-full sm:gap-0 gap-5"> 
                    <?php $step = 1; $previousStatus = true; 
                        foreach ($Details as $info) { 
                            $class = $info->getStatus() === 'True' ? 'text-indigo-600' : 'text-gray-500'; 
                            $classligne = $info->getStatus() === 'True' ? 'after:bg-indigo-300' : 'after:bg-gray-300'; 
                            $bgClass = $info->getStatus() === 'True' ? 'bg-indigo-600' : 'bg-gray-500'; 
                            $disabled = (!$previousStatus) ? 'disabled' : ''; ?> 
                        
                            <li id="villetrajet" onclick="statutDemande(<?= $info->getId() ?>)" class="cursor-pointer flex w-full relative justify-center <?= $class ?> text-base font-semibold after:content-get'] after:w-full after:h-0.5 <?= $classligne ?> after:inline-block after:absolute lg:after:top-4 after:top-3 after:left-[10.5rem]"> 
                                <div class="block sm:whitespace-nowrap z-10 flex flex-col items-center text-center"> 
                                    <form method="POST" style="display: inline;"> 
                                        <input type="hidden" name="ville" value="<?= htmlspecialchars($info->getVille()) ?>"> 
                                        <button type="submit"> <span class="w-6 h-6 <?= $bgClass ?> text-center border-2 border-white rounded-full flex justify-center items-center mx-auto mb-1 text-base font-bold text-white lg:w-8 lg:h-8"><?= $step ?></span> 
                                            <span class="text-lg" ><?= $info->getVille() ?></span> 
                                        </button> 
                                    </form> 
                                     
                
                                    <form action="/index.php/updateStatus/<?=$info->getItineraireId()?>/<?=$info->getId()?>" id="arrivebtn" method="POST"> 

                                        <input type="hidden" name="ID_ville" id="ID_ville" value="<?= $info->getId() ?>"> 
                                        <button type="submit" class="text-white <?= $bgClass ?> hover:<?= $bgClass ?> font-medium rounded-lg text-sm px-2.5 py-1 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"> 
                                            
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                                            </svg>

                                        </button> 

                                    </form> 

                                </div> 
                            </li> 
                        
                            <?php $previousStatus = ($info->getStatus() === 'True');?> 
                        
                        <?php $step++; } ?> 
                    
                </ol> 
            </div> 
        </div> 
    </div> 


    <!-- Driver Profile Content -->
    <div class="driver-container">
        <div class="row">
            <!-- Driver Info Card -->
            <div class="col-md-4">
                <div class="profile-card text-center">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode(pg_unescape_bytea($driver['photo'])); ?>" 
                         alt="Driver Photo" class="driver-photo">
                    <h3 class="mt-3"><?php echo htmlspecialchars($_SESSION['user']['prenom'] . ' ' . $_SESSION['user']["nom"]); ?></h3>
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
                                     if($ville->getStatus() == 'False'){
                                        echo 'not visited';
                                    }else {
                                       echo 'visted';
                                    } ?></h5>
                                    <p class="mb-1">
                                        <i class="fas fa-truck me-2"></i>
                                        <?php echo $ville->getVille(); ?>
                                    </p>
                                    
                                </div>
                                <div class="text-end">
                                    <span class="status-badge status-active">
                                        <?php echo $ville->getOrders(); ?>
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
    
    <script>
        


        function statutDemande(ID_ville) {
            
            let villetat = document.querySelector('villetrajet'); 
            let buttonarrv = document.getElementById('arrivebtn'); 
            if (villetat.classList.contains('text-indigo-600')) { 
                buttonarrv.classList.add('hidden'); 
                
            } else{ 
                buttonarrv.classList.remove('hidden'); 
            
            } 
            
            document.getElementById("ID_ville").value = ID_ville; 
            
            document.getElementById("villestatut").classList.remove('hidden'); 
            
        }; 
        
        document.getElementById("xmarkcsltion").addEventListener('click', function(){ 
            document.getElementById("villestatut").classList.add('hidden'); 
        });

        function colisLivre(colis_ID) {
            document.getElementById("Livration_confirmer").value = colis_ID;
            document.getElementById("LivrationForm").submit();
        };

        function ColisNonLivre(colis_ID) {
            document.getElementById("Livration_annuler").value = colis_ID;
            document.getElementById("nonLivrationForm").submit();
        }; 

    </script>
</body>
</html>