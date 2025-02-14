<?php

//Les Actions Public
$router->add('GET', 'login', 'authController', 'login');
$router->add('POST', 'login', 'authController', 'login');
$router->add('GET', 'logout', 'authController', 'logout');

//Les Actions d'Administrateurs
$router->add('GET', 'Admin', 'AdminController', 'dashboard');
$router->add('GET', 'Admin/users', 'AdminController', 'gestion_utilisateur');
$router->add('GET', 'Admin/annonce', 'AdminController', 'gestion_annonce');
$router->add('GET', 'Admin/profile', 'AdminController', 'gestion_profile');
//Les Actions du Conducteur
$router->add('GET', 'Conducteur', 'ConducteurController', 'dashboard');
$router->add('GET', 'MesAnnonces', 'ConducteurController', 'mesannonces');
$router->add('GET', 'DetailsAnnonce', 'ConducteurController', 'detailsannonce');
$router->add('POST', 'addIteneraire', 'ConducteurController', 'addIteneraire');


//Les Actions d'Expediteur
$router->add('GET', 'Expediteur', 'ExpediteurController', 'dashboard');
$router->add('GET', 'DetailsAnnonceExp', 'ExpediteurController', 'detailsannonceexp');
$router->add('GET', 'MesColis', 'ExpediteurController', 'mescolis');
$router->add('GET', 'PrflExpediteur', 'ExpediteurController', 'prflexpediteur');





