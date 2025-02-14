<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Lien du Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Lien des Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 
    
    <title>Les Cours</title>
</head>
<body class="bg-gradient-to-t from-blue-400 via-blue-300 to-blue-200">
<?php
require_once('C:\laragon\www\Sari3\app\views\includes\NvHeader.php');
echo '<pre>';

var_dump($user);
echo '</pre>';
?>
<h1>
    Welcome
</h1>
<div><?=$user->getNom()?></div>
    <!-- Filtrage les Resultats-->
    <form method="POST" class="flex rounded-md border-2 border-blue-400 mt-[2rem] overflow-hidden max-w-md mx-auto">
        <input type="text" name="search" placeholder="Rechercher quelque chose..."
        class="w-full outline-none bg-white text-gray-600 text-sm px-4 py-3" />
        <button type='submit' class="flex items-center justify-center bg-blue-400  px-5">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192.904 192.904" width="16px" class="fill-white">
            <path
            d="m190.707 180.101-47.078-47.077c11.702-14.072 18.752-32.142 18.752-51.831C162.381 36.423 125.959 0 81.191 0 36.422 0 0 36.423 0 81.193c0 44.767 36.422 81.187 81.191 81.187 19.688 0 37.759-7.049 51.831-18.751l47.079 47.078a7.474 7.474 0 0 0 5.303 2.197 7.498 7.498 0 0 0 5.303-12.803zM15 81.193C15 44.694 44.693 15 81.191 15c36.497 0 66.189 29.694 66.189 66.193 0 36.496-29.692 66.187-66.189 66.187C44.693 147.38 15 117.689 15 81.193z">
            </path>
        </svg>
        </button>
    </form>

    <div class="grid grid-cols-2">

        <form method="POST" class="flex rounded-md border-2 border-blue-400 mt-[2rem] overflow-hidden max-w-md mx-auto">
            <button type='submit' class="flex items-center justify-center bg-blue-400 px-5">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192.904 192.904" width="16px" class="fill-white">
                    <path d="m190.707 180.101-47.078-47.077c11.702-14.072 18.752-32.142 18.752-51.831C162.381 36.423 125.959 0 81.191 0 36.422 0 0 36.423 0 81.193c0 44.767 36.422 81.187 81.191 81.187 19.688 0 37.759-7.049 51.831-18.751l47.079 47.078a7.474 7.474 0 0 0 5.303 2.197 7.498 7.498 0 0 0 5.303-12.803zM15 81.193C15 44.694 44.693 15 81.191 15c36.497 0 66.189 29.694 66.189 66.193 0 36.496-29.692 66.187-66.189 66.187C44.693 147.38 15 117.689 15 81.193z"></path>
                </svg>
            </button>
        </form>
    </div>
    <main class="overflow-hidden">  
        <div class="grid grid-cols-2 gap-4">
    
            <div class="scale-[0.9] mt-[4rem] bg-white dark:bg-gray-800 rounded-xl shadow-2xl max-w-4xl w-full p-4 transition-all duration-300 animate-fade-in pt-[3.5rem]">
                <div class="flex flex-row">
                    <div class="w-1/3 text-center mb-0">
                        <img src="" alt="Profile Picture" class="rounded-full w-48 h-48 mx-auto mb-4 border-4 border-blue-500 transition-transform duration-300 hover:scale-105">
                        <h1 class="text-2xl font-bold text-blue-500 dark:text-white mb-2"></h1>
                        <p class="text-stone-700 font-semibold">Resultats</p>
                        

                        <h2 class="text-xl font-semibold text-blue-500 mb-4  mt-[3rem]">Catégorie</h2>
                        <p class="text-stone-700 font-semibold">Resultats</p>
                        
                        <a  href=''>
                            <button class="ml-[5.7rem] mt-[5rem] flex items-center rounded-md border border-blue-300 py-2 px-4 text-center text-sm transition-all shadow-sm hover:shadow-lg text-blue-600 hover:text-white hover:bg-blue-800 hover:border-blue-800 focus:text-white focus:bg-blue-800 focus:border-blue-800 active:border-blue-800 active:text-white active:bg-blue-800 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="button">
                                Details
                                
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 ml-1.5">
                                    <path fill-rule="evenodd" d="M16.28 11.47a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 0 1-1.06-1.06L14.69 12 7.72 5.03a.75.75 0 0 1 1.06-1.06l7.5 7.5Z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </a>
                    </div>
                    <div class="w-2/3 pl-8">
                        <p class="text-gray-700 font-semibold text-2xl dark:text-gray-300 mb-6"> Resultats</p>
                        <div class="grid min-h-[140px] w-full place-items-center overflow-x-scroll rounded-lg lg:overflow-visible">
                        <img class="h-[25rem]"
                            src="">
                        </div>
                        <p class="text-gray-700 dark:text-gray-300 mb-6 mt-6">
                        Resultats
                        </p>
                    </div>
                </div>

                <div class="mb-[0.5rem] overflow-hidden">
                    <hr class="h-px w-[50rem] my-4 bg-gray-200 border-0 dark:bg-gray-700">

                    <svg id="morecmnt" class="w-4 h-4 text-blue-700 cursor-pointer" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 10">
                        <path d="M15.434 1.235A2 2 0 0 0 13.586 0H2.414A2 2 0 0 0 1 3.414L6.586 9a2 2 0 0 0 2.828 0L15 3.414a2 2 0 0 0 .434-2.179Z"/>
                    </svg>
                    <svg id="lesscmnt" class="w-4 h-4 text-blue-700 cursor-pointer hidden" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 10 16">
                        <path d="M3.414 1A2 2 0 0 0 0 2.414v11.172A2 2 0 0 0 3.414 15L9 9.414a2 2 0 0 0 0-2.828L3.414 1Z"/>
                    </svg>
                </div>

            </div>
            <div class="scale-[0.9] mt-[4rem] bg-white dark:bg-gray-800 rounded-xl shadow-2xl max-w-4xl w-full p-4 transition-all duration-300 animate-fade-in pt-[3.5rem]">
                <div class="flex flex-row">
                    <div class="w-1/3 text-center mb-0">
                        <img src="" alt="Profile Picture" class="rounded-full w-48 h-48 mx-auto mb-4 border-4 border-blue-500 transition-transform duration-300 hover:scale-105">
                        <h1 class="text-2xl font-bold text-blue-500 dark:text-white mb-2"></h1>
                        <p class="text-stone-700 font-semibold">Resultats</p>
                        

                        <h2 class="text-xl font-semibold text-blue-500 mb-4  mt-[3rem]">Catégorie</h2>
                        <p class="text-stone-700 font-semibold">Resultats</p>
                        
                        <a  href=''>
                            <button class="ml-[5.7rem] mt-[5rem] flex items-center rounded-md border border-blue-300 py-2 px-4 text-center text-sm transition-all shadow-sm hover:shadow-lg text-blue-600 hover:text-white hover:bg-blue-800 hover:border-blue-800 focus:text-white focus:bg-blue-800 focus:border-blue-800 active:border-blue-800 active:text-white active:bg-blue-800 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="button">
                                Details
                                
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 ml-1.5">
                                    <path fill-rule="evenodd" d="M16.28 11.47a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 0 1-1.06-1.06L14.69 12 7.72 5.03a.75.75 0 0 1 1.06-1.06l7.5 7.5Z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </a>
                    </div>
                    <div class="w-2/3 pl-8">
                        <p class="text-gray-700 font-semibold text-2xl dark:text-gray-300 mb-6"> Resultats</p>
                        <div class="grid min-h-[140px] w-full place-items-center overflow-x-scroll rounded-lg lg:overflow-visible">
                        <img class="h-[25rem]"
                            src="">
                        </div>
                        <p class="text-gray-700 dark:text-gray-300 mb-6 mt-6">
                        Resultats
                        </p>
                    </div>
                </div>

                <div class="mb-[0.5rem] overflow-hidden">
                    <hr class="h-px w-[50rem] my-4 bg-gray-200 border-0 dark:bg-gray-700">

                    <svg id="morecmnt" class="w-4 h-4 text-blue-700 cursor-pointer" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 10">
                        <path d="M15.434 1.235A2 2 0 0 0 13.586 0H2.414A2 2 0 0 0 1 3.414L6.586 9a2 2 0 0 0 2.828 0L15 3.414a2 2 0 0 0 .434-2.179Z"/>
                    </svg>
                    <svg id="lesscmnt" class="w-4 h-4 text-blue-700 cursor-pointer hidden" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 10 16">
                        <path d="M3.414 1A2 2 0 0 0 0 2.414v11.172A2 2 0 0 0 3.414 15L9 9.414a2 2 0 0 0 0-2.828L3.414 1Z"/>
                    </svg>
                </div>

            </div>
        </div>
     

    </main>

    <div class="bg-white rounded-lg p-4 flex items-center flex-wrap">
        <nav aria-label="Page navigation">
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

 <?php
require_once('C:\laragon\www\Sari3\app\views\includes\NvFooter.php');
 ?>



    <script>
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

    </script>
</body>
</html>