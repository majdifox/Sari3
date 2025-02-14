<?php
session_start();
if (!isset($_SESSION['user']) || !isset($_SESSION['user']->prenom)) {
    header('Location: /login');
    exit();
}
$user = $this->getProfile($_SESSION['user']->id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Lien du Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Lien des Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 
    
    <title>Administrateur - Profile</title>
</head>
<body class="flex bg-gray-100 min-h-screen">
    <aside class="hidden sm:flex sm:flex-col">
    <a href="/Admin/" class="flex items-center">
                    <img src="https://export-download.canva.com/ZADgo/DAGey3ZADgo/3/0/0001-1456244851306253508.png?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAJHKNGJLC2J7OGJ6Q%2F20250212%2Fus-east-1%2Fs3%2Faws4_request&X-Amz-Date=20250212T180648Z&X-Amz-Expires=64508&X-Amz-Signature=08e79dfdbd4060b752d74edc03c491b40e21570f0fd7ee31777b4cd6e1db3cbe&X-Amz-SignedHeaders=host&response-content-disposition=attachment%3B%20filename%2A%3DUTF-8%27%27Red%2520Blue%2520Modern%2520Logistics%2520Express%2520Logo.png&response-expires=Thu%2C%2013%20Feb%202025%2012%3A01%3A56%20GMT" class="mr-3 mt-[-1rem] w-[7rem]" alt="Site Web Logo" />
                </a>
        <div class="flex-grow flex flex-col justify-between text-gray-500 bg-gray-800">
        <nav class="flex flex-col mx-4 my-6 space-y-4">
            
            <a href="admin" class="inline-flex items-center justify-center py-3 hover:text-gray-400 hover:bg-gray-700 focus:text-gray-400 focus:bg-gray-700 rounded-lg">
            <span class="sr-only">Dashboard</span>
            <svg aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
            </svg>
            </a>

            <a href="admin/user" class="inline-flex items-center justify-center py-3 hover:text-gray-400 hover:bg-gray-700 focus:text-gray-400 focus:bg-gray-700 rounded-lg">
            <span class="sr-only">Utilisateur</span>
            <svg class="w-6 h-6 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                <path d="M16 0H4a2 2 0 0 0-2 2v1H1a1 1 0 0 0 0 2h1v2H1a1 1 0 0 0 0 2h1v2H1a1 1 0 0 0 0 2h1v2H1a1 1 0 0 0 0 2h1v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5.5 4.5a3 3 0 1 1 0 6 3 3 0 0 1 0-6ZM13.929 17H7.071a.5.5 0 0 1-.5-.5 3.935 3.935 0 1 1 7.858 0 .5.5 0 0 1-.5.5Z"/>
            </svg>
            </a>

            <a href="#" class="inline-flex items-center justify-center py-3 text-green-600 bg-white rounded-lg">
            <svg aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            </a>
            
        </nav>
        </div>
    </aside>
    <div class="flex-grow text-gray-800">
        <header class="flex items-center h-20 px-6 sm:px-10 bg-white">
            <div class="flex flex-shrink-0 items-center ml-auto">
                <div class="hidden md:flex md:flex-col md:items-end md:leading-tight">
                    <span class="font-semibold"><?php echo $_SESSION['user']->nom . ' ' . $_SESSION['user']->prenom; ?></span>
                    <span class="text-sm text-gray-600"><?php echo $_SESSION['user']->role; ?></span>
                </div>
                <span class="h-12 w-12 ml-2 sm:ml-3 mr-2 bg-gray-100 rounded-full overflow-hidden">
                    <img src="../assets/images/<?php echo $photo; ?>" alt="user profile photo" class="h-full w-full object-cover">
                </span>
            
                <div class="border-l pl-3 ml-3 space-x-1">
                    <button class="relative p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-600 focus:bg-gray-100 focus:text-gray-600 rounded-full">
                    <a href="../templates/logout.php">
                        <span class="sr-only">Log out</span>
                        <svg aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </a>
                    </button>
                </div>
            </div>
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
                            <button type="submit" class="ml-[7rem] w-[8rem] text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Confirmer</button>
                        </form>
                    </div>
                </div>
            </div>

            <section>
                <div class="mb-[4rem]">
                    <div class="container mx-auto py-8">
                        <div class="grid grid-cols-4 sm:grid-cols-12 gap-6 px-4">

                            <div class="col-span-4 sm:col-span-3">
                                <div class="bg-white shadow rounded-lg p-6">
                                    <div class="flex flex-col items-center">
                                        <img src='../assets/images/<?php echo $photo; ?>' class="w-32 h-32 bg-gray-300 rounded-full mb-4 shrink-0">

                                        </img>
                                        <h1 class="text-xl font-bold"><?php echo $user['nom'] . ' ' . $user['prenom']; ?></h1>
                                        <p class="text-lg text-stone-600 font-semibold"><?php echo $user['role']; ?></p>
                                    </div>
                                    <button id="mdfiebttn" type="button" class="ml-[6.7rem] mt-[2.5rem] text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Modifier</button>
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
                                                        <dd class="text-lg text-stone-600 font-semibold"><?php echo $user['nom']; ?></dd>
                                                    </div>
                                                    <div class="flex flex-col py-3">
                                                        <dt class="mb-1 text-stone-900 font-bold text-base dark:text-gray-400">Prenom</dt>
                                                        <dd class="text-lg text-stone-600 font-semibold"><?php echo $user['prenom']; ?></dd>
                                                    </div>
                                                </dl>
                                            </div>

                                            <div class="w-full">
                                                <dl class="text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
                                                        <div class="flex flex-col pb-3">
                                                            <dt class="mb-1 text-stone-900 font-bold text-base dark:text-gray-400">Téléphone</dt>
                                                            <dd class="text-lg text-stone-600 font-semibold"><?php echo $user['telephone']; ?></dd>
                                                        </div>
                                                        <div class="flex flex-col py-3">
                                                            <dt class="mb-1 text-stone-900 font-bold text-base dark:text-gray-400">Email</dt>
                                                            <dd class="text-lg text-stone-600 font-semibold"><?php echo $user['email']; ?></dd>
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

    </div>

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
    
</body>
</html>