
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
            --yellow:rgb(29, 175, 243);
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
            color:rgb(49, 46, 125);
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
    <header>
        <nav class="bg-white border-gray-200 px-4 lg:px-6 py-2.5 dark:bg-gray-800">
            <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
                <a class="flex items-center">
                    <img src="https://export-download.canva.com/ZADgo/DAGey3ZADgo/3/0/0001-1456244851306253508.png?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAJHKNGJLC2J7OGJ6Q%2F20250212%2Fus-east-1%2Fs3%2Faws4_request&X-Amz-Date=20250212T180648Z&X-Amz-Expires=64508&X-Amz-Signature=08e79dfdbd4060b752d74edc03c491b40e21570f0fd7ee31777b4cd6e1db3cbe&X-Amz-SignedHeaders=host&response-content-disposition=attachment%3B%20filename%2A%3DUTF-8%27%27Red%2520Blue%2520Modern%2520Logistics%2520Express%2520Logo.png&response-expires=Thu%2C%2013%20Feb%202025%2012%3A01%3A56%20GMT" class="mr-3 mt-[-1rem] w-[7rem]" alt="Site Web Logo" />
                </a>
                <div class="flex items-center lg:order-2 mt-[-1rem]">
                    <a href="/index.php/logout" class="text-white bg-blue-500 hover:opacity-80 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">Logout</a>
                    <button data-collapse-toggle="mobile-menu-2" type="button" class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="mobile-menu-2" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                        <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                </div>
                <div class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1 mt-[-1rem]" id="mobile-menu-2">
                    <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                        <li>
                            <a href="MesAnnonces" class="block py-2 pr-4 pl-3 text-stone-700 rounded bg-primary-700 lg:bg-transparent lg:text-primary-700 lg:p-0 dark:text-white" aria-current="page">Home</a>
                        </li>
                        <li>
                            <a href="Conducteur" class="block py-2 pr-4 pl-3 text-stone-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">Profile</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <?php if(!empty($colis)) { 
        
        
        ?>
      
      
        <!-- This is an example component --> 
        <div id="villestatut" class="fixed ml-[35rem] z-20 bg-white">
        <div class="max-w-2xl mx-auto"> 
            <div class="p-4 max-w-md bg-white rounded-lg border shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700"> 
                <div class="flex justify-between items-center mb-4"> 
                    <h3 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Latest Customers</h3> 
                    
                    <i id="xmarkcsltion" class="fa-solid fa-xmark ml-[16rem] text-2xl cursor-pointer mt-[1.2rem]" style="color: #2e2e2e;"></i> 
                </div> 
                
                <div class="flow-root"> 
                    <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700"> 
                         
                            
                            <?php foreach ($colis as $c) {
                                 ?> 
                            <li class="py-3 sm:py-4"> 
                                <div class="flex items-center space-x-4"> 

                                    <div class="flex-shrink-0"> 
                                        <img class="w-8 h-8 rounded-full" src="https://keycontainercorp.com/wp-content/uploads/2021/07/1cardboard-boxes-Quantum-Industrial-Supply-Flint-MI-1000px-1.jpg" alt="Neil image"> 
                                    </div> 
                                    
                                    <div class="flex-1 min-w-0"> 
                                    
                                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white"> <?= htmlspecialchars($c->getNom()) ?> </p> 
                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400"> Depart : <?= htmlspecialchars($c->getOrigin()) ?> </p> 

                                    </div> <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white"> $320 </div> 
                                
                                    <button onclick="colisLivre(<?= htmlspecialchars($c->getId()) ?>)" type="button" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 font-medium rounded-lg text-sm px-2.5 py-1 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
                                        </svg>

                                    </button>

                                    <button onclick="ColisNonLivre(<?= htmlspecialchars($c->getId()) ?>)" type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 font-medium rounded-lg text-sm px-2.5 py-1 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700">
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
        // var_dump($colis);
    } ?>

    <form action="/index.php/updateColisLivre" id="LivrationForm" method="POST">
        <input type="hidden" name="Livration_confirmer" id="Livration_confirmer" value="">
    </form>

    <form action="/index.php/updateColisNonLivre" id="nonLivrationForm" method="POST">
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
                                    <form action="/index.php/AnnonceDetails/<?=$info->getItineraireId()?>" method="POST" style="display: inline;"> 
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
                    <img src="https://profilemagazine.com/wp-content/uploads/2020/04/Ajmere-Dale-Square-thumbnail.jpg" 
                         alt="Driver Photo" class="driver-photo">
                    <h3 class="mt-3"><?php echo htmlspecialchars($_SESSION['user']->prenom . ' ' . $_SESSION['user']->nom); ?></h3>
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

                    <h4 class="mb-4 mt-5">Position Actuelle</h4>
                    <?php foreach ($Details as $ville): ?>
                        <div class="route-card">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="mb-2 capitalize">Route <?php 
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
    <footer class="bg-white rounded-lg shadow dark:bg-gray-900 m-4">
        <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
            <div class="sm:flex sm:items-center sm:justify-between">
                <a class="flex items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse">
                    <img src="https://export-download.canva.com/ZADgo/DAGey3ZADgo/3/0/0001-1456244851306253508.png?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAJHKNGJLC2J7OGJ6Q%2F20250212%2Fus-east-1%2Fs3%2Faws4_request&X-Amz-Date=20250212T180648Z&X-Amz-Expires=64508&X-Amz-Signature=08e79dfdbd4060b752d74edc03c491b40e21570f0fd7ee31777b4cd6e1db3cbe&X-Amz-SignedHeaders=host&response-content-disposition=attachment%3B%20filename%2A%3DUTF-8%27%27Red%2520Blue%2520Modern%2520Logistics%2520Express%2520Logo.png&response-expires=Thu%2C%2013%20Feb%202025%2012%3A01%3A56%20GMT" class="mb-[-2rem] w-[7rem]" alt="Flowbite Logo" />
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