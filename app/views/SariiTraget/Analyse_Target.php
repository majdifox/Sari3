<?php

require_once 'Target.php';

$target = new Target();

$trackingInfo = $target->getTrackingInfo();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["ID_ville"])) {
    $id = (int) $_POST["ID_ville"];
    $target = new Target();
    $target->updateStatut($id);

    header("Location: Analyse_Target.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link to Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Link to Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Order Tracking</title>

</head>
<body class="overflow-hidden">

    <div id="villestatut" class="hidden fixed ml-[35rem] z-20 bg-white">
        <!-- This is an example component -->
        <div class="max-w-2xl mx-auto">

            <div class="p-4 max-w-md bg-white rounded-lg border shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Latest Customers</h3>
                    <i id="xmarkcsltion" class="fa-solid fa-xmark ml-[16rem] text-2xl cursor-pointer mt-[1.2rem]" style="color: #2e2e2e;"></i>
                </div>
                <div class="flow-root">
                    <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                        <li class="py-3 sm:py-4">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <img class="w-8 h-8 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-1.jpg" alt="Neil image">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                        Neil Sims
                                    </p>
                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                        email@windster.com
                                    </p>
                                </div>
                                <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                    $320
                                </div>
                                <button type="button" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Green</button>
                            </div>
                        </li>
                        <li class="py-3 sm:py-4">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <img class="w-8 h-8 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-3.jpg" alt="Bonnie image">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                        Bonnie Green
                                    </p>
                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                        email@windster.com
                                    </p>
                                </div>
                                <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                    $3467
                                </div>
                                <button type="button" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Green</button>
                            </div>
                        </li>
                        <li class="py-3 sm:py-4">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <img class="w-8 h-8 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-2.jpg" alt="Michael image">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                        Michael Gough
                                    </p>
                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                        email@windster.com
                                    </p>
                                </div>
                                <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                    $67
                                </div>
                                <button type="button" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Green</button>
                            </div>
                        </li>
                        <li class="py-3 sm:py-4">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <img class="w-8 h-8 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-4.jpg" alt="Lana image">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                        Lana Byrd
                                    </p>
                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                        email@windster.com
                                    </p>
                                </div>
                                <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                    $367
                                </div>
                                <button type="button" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Green</button>
                            </div>
                        </li>
                    </ul>
                </div>
                <form id="arrivebtn" method="POST">
                    <input type="hidden" name="ID_ville" id="ID_ville" value="">
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Arrivé
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="w-full flex-col justify-start items-start gap-10 flex mt-[5rem]">
        <div class="w-full justify-between items-start flex sm:flex-row flex-col gap-3">
            <h3 class="text-gray-900 text-2xl font-semibold font-manrope leading-9">Order Tracking</h3>
        </div>

        <div class="w-full py-9 rounded-xl border border-gray-200 flex-col justify-start items-start flex">
            <div class="w-full flex-col justify-center sm:items-center items-start gap-8 flex">
                <ol class="flex sm:items-center items-start w-full sm:gap-0 gap-5">
                    <?php
                    $step = 1;
                    $previousStatus = true;
                    foreach ($trackingInfo as $info) {
                        $class = $info['statut'] === 'True' ? 'text-indigo-600' : 'text-gray-500';
                        $classligne = $info['statut'] === 'True' ? 'after:bg-indigo-300' : 'after:bg-gray-300';
                        $bgClass = $info['statut'] === 'True' ? 'bg-indigo-600' : 'bg-gray-500';
                        $statut = $info['statut'] === 'True' ? 'Arrivé' : 'En transit';
                        $disabled = (!$previousStatus) ? 'disabled' : '';
                    ?>
                        <li onclick="statutDemande(<?= $info['id'] ?>)" class="cursor-pointer flex w-full relative justify-center <?= $class ?> text-base font-semibold after:content-[''] after:w-full after:h-0.5 <?= $classligne ?> after:inline-block after:absolute lg:after:top-4 after:top-3 after:left-[10.5rem]">
                            <div class="block sm:whitespace-nowrap z-10 flex flex-col items-center text-center">
                                <span class="w-6 h-6 <?= $bgClass ?> text-center border-2 border-white rounded-full flex justify-center items-center mx-auto mb-1 text-base font-bold text-white lg:w-8 lg:h-8"><?= $step ?></span>
                                <?= $statut ?> - <?= $info['ville'] ?>
                            </div>
                        </li>
                        <?php $previousStatus = ($info['statut'] === 'True');?>
                    <?php
                        $step++;
                    }
                    ?>
                </ol>
            </div>
        </div>
    </div>


    <script>
        function statutDemande(ID_ville) {
            let villetat = document.querySelector(`li[onclick="statutDemande(${ID_ville})"]`);
            let buttonarrv = document.getElementById('arrivebtn');
            if (villetat.classList.contains('text-indigo-600')) {
                buttonarrv.classList.add('hidden');
            }
            else{
                buttonarrv.classList.remove('hidden');
            }
            document.getElementById("ID_ville").value = ID_ville;
            document.getElementById("villestatut").classList.remove('hidden');
        };

        document.getElementById("xmarkcsltion").addEventListener('click', function(){
            document.getElementById("villestatut").classList.add('hidden');
        });
    </script>
</body>
</html>
