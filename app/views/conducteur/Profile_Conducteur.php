<<<<<<< HEAD


<!-- <?php
echo 'hello';
echo '<pre>';
var_dump($user);
echo '</pre>';
?> -->

=======
<<<<<<< HEAD
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

=======
>>>>>>> SQL
>>>>>>> c05bdb69bcb65faf8cc6f5e966b740b30e2b99de
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
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
=======
    <!-- Lien du Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Lien des Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 
    
    <title><?= $user->getRole()?> - Profile</title>
</head>
<body class="bg-stone-300">

    <header>
        <nav class="bg-white border-gray-200 px-4 lg:px-6 py-2.5 dark:bg-gray-800">
            <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
                <a class="flex items-center">
                    <img src="https://export-download.canva.com/ZADgo/DAGey3ZADgo/3/0/0001-1456244851306253508.png?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAJHKNGJLC2J7OGJ6Q%2F20250212%2Fus-east-1%2Fs3%2Faws4_request&X-Amz-Date=20250212T180648Z&X-Amz-Expires=64508&X-Amz-Signature=08e79dfdbd4060b752d74edc03c491b40e21570f0fd7ee31777b4cd6e1db3cbe&X-Amz-SignedHeaders=host&response-content-disposition=attachment%3B%20filename%2A%3DUTF-8%27%27Red%2520Blue%2520Modern%2520Logistics%2520Express%2520Logo.png&response-expires=Thu%2C%2013%20Feb%202025%2012%3A01%3A56%20GMT" class="mr-3 mt-[-1rem] w-[7rem]" alt="Site Web Logo" />
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

    <main>

        <!-- Profile Form-->
        <div id="ctnrcsltion" class="hidden fixed left-[32rem] top-[0rem] flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <i id="xmarkcsltion" class="fa-solid fa-xmark ml-[26rem] text-2xl cursor-pointer mt-[1.2rem]" style="color: #2e2e2e;"></i>
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl mt-[-2rem] font-bold leading-tight tracking-tight text-stone-700 md:text-2xl dark:text-white">
                        Modifier Votre Profile
                    </h1>
                    <form class="space-y-4 md:space-y-6" method="POST" enctype="multipart/form-data">
                        <div class="grid lg:grid-cols-2 gap-6">
                            <div>
                                <label for="nom" class="block mb-2 text-sm font-medium text-stone-700 dark:text-white">Nom</label>
                                <input type="text" name="nom" id="nom" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="" >
                            </div>
                            <div>
                                <label for="prenom" class="block mb-2 text-sm font-medium text-stone-700 dark:text-white">Prenom</label>
                                <input type="text" name="prenom" id="prenom" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="" >
                            </div>
                        </div>
                        <div class="grid lg:grid-cols-2 gap-6">
                            <div>
                                <label for="telephone" class="block mb-2 text-sm font-medium text-stone-700 dark:text-white">Téléphone</label>
                                <input type="text" name="telephone" id="telephone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="" >
                            </div>
                            <div>
                                <label for="email" class="block mb-2 text-sm font-medium text-stone-700 dark:text-white">Email</label>
                                <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="" >
                            </div>
                        </div>
                        <div class="grid lg:grid-cols-2 gap-6">
                            <div>
                                <label for="password" class="block mb-2 text-sm font-medium text-stone-700 dark:text-white">Password</label>
                                <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="" >
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-stone-700 dark:text-white" for="photo">Photo de Profile</label>
                                <input name="photo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="file">
                            </div>
                        </div>
                        <button type="submit" class="ml-[7rem] w-[8rem] text-white bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 hover:bg-gradient-to-br font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Confirmer</button>
>>>>>>> SQL
                    </form>
                </div>
            </div>
        </div>
<<<<<<< HEAD
    </div>

    <!-- Footer -->
    <footer class="text-center">
        <div class="container">
            <p class="mb-0">&copy; 2024 TruckTrace. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
=======

        <section>
            <div class="mb-[4rem]">
                <div class="container mx-auto py-8">
                    <div class="grid grid-cols-4 sm:grid-cols-12 gap-6 px-4">

                        <div class="col-span-4 sm:col-span-3">
                            <div class="bg-white shadow rounded-lg p-6">
                                <div class="flex flex-col items-center">
                                    <img src='https://marketplace.canva.com/EAFHfL_zPBk/1/0/1600w/canva-yellow-inspiration-modern-instagram-profile-picture-kpZhUIzCx_w.jpg' class="w-32 h-32 bg-gray-300 rounded-full mb-4 shrink-0">

                                    </img>
                                    <h1 class="capitalize text-xl font-bold"><?php echo $user->getNom() .' ' . $user->getPrenom() ?></h1>
                                    <p class="text-lg text-stone-600 font-semibold"><?= $user->getRole();?></p>
                                </div>
                                <button id="mdfiebttn" type="button" class="ml-[6.7rem] mt-[2.5rem] text-white bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 hover:bg-gradient-to-br font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Modifier</button>
                            </div>
                        </div>

                        <div class="col-span-4 sm:col-span-9">
                            <div class="bg-white shadow rounded-lg p-6">
                                <div class="w-full my-auto py-6 flex flex-col justify-center gap-2">
                                    <div class="w-full flex sm:flex-row xs:flex-col gap-2 justify-center">
                                        <div class="w-full">
                                            <dl class="text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
                                                <div class="flex flex-col pb-3">
                                                    <dt class="mb-1 text-stone-900 font-bold text-base dark:text-gray-400">Nom</dt>
                                                    <dd class="capitalize text-lg text-stone-600 font-semibold"><?= $user->getNom();?></dd>
                                                </div>
                                                <div class="flex flex-col py-3">
                                                    <dt class="mb-1 text-stone-900 font-bold text-base dark:text-gray-400">Prenom</dt>
                                                    <dd class="capitalize text-lg text-stone-600 font-semibold"><?= $user->getPrenom();?></dd>
                                                </div>
                                            </dl>
                                        </div>

                                        <div class="w-full">
                                            <dl class="text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
                                                    <div class="flex flex-col pb-3">
                                                        <dt class="mb-1 text-stone-900 font-bold text-base dark:text-gray-400">Téléphone</dt>
                                                        <dd class="text-lg text-stone-600 font-semibold">0635487595</dd>
                                                    </div>
                                                    <div class="flex flex-col py-3">
                                                        <dt class="mb-1 text-stone-900 font-bold text-base dark:text-gray-400">Email</dt>
                                                        <dd class="text-lg text-stone-600 font-semibold"><?= $user->getEmail();?></dd>
                                                    </div>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </section>

    </main>

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
    

    <script>
        const ctnr1 = document.getElementById("ctnrcsltion");
        const xmark1 = document.getElementById("xmarkcsltion");
        const bttnmdfie = document.getElementById("mdfiebttn");
        
        xmark1?.addEventListener('click', function(){
            ctnr1.classList.add('hidden');
        });


        bttnmdfie?.addEventListener('click', function(){
            ctnr1.classList.remove('hidden');
        });
    </script>
>>>>>>> SQL
</body>
</html>