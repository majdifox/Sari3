<?php

//Les Actions Public
$router->add('GET', 'login', 'authController', 'login');
$router->add('POST', 'login', 'authController', 'login');
$router->add('GET', 'logout', 'authController', 'logout');
$router->add('GET', 'logout', 'authController', 'logout');
$router->add('GET', 'register', 'authController', 'register');
$router->add('POST', 'register', 'authController', 'register');
//Les Actions d'Administrateurs

$router->add('GET', 'admin', 'AdminController', 'dashboard');
$router->add('GET', 'admin/users', 'AdminController', 'gestion_utilisateur');
$router->add('GET', 'admin/annonces', 'AdminController', 'gestion_annonce');
$router->add('GET', 'admin/profile', 'AdminController', 'gestion_profile');

//Les Actions du Conducteur
$router->add('GET', 'Conducteur', 'ConducteurController', 'dashboard');
$router->add('POST', 'Conducteur', 'ConducteurController', 'dashboard');
$router->add('GET', 'MesAnnonces', 'ConducteurController', 'mesannonces');
$router->add('GET', 'DetailsAnnonce', 'ConducteurController', 'details');
$router->add('POST', 'addIteneraire', 'ConducteurController', 'addIteneraire');
$router->add('GET', 'AnnonceDetails/{id}', 'ConducteurController', 'annoncedetails');
$router->add('POST', 'AnnonceDetails/{id}', 'ConducteurController', 'annoncedetails');
$router->add('POST', 'updateStatus/{id}/{id}', 'ConducteurController', 'updateDetailsItenraireStatus');
$router->add('POST', 'updateColisLivre', 'ConducteurController', 'livrerUneColis');
$router->add('POST', 'updateColisNonLivre', 'ConducteurController', 'nonLivrerUneColis');

//Les Actions d'Expediteur
$router->add('GET', 'Expediteur', 'ExpediteurController', 'dashboard');
$router->add('GET', 'DetailsAnnonceExp/{id}', 'ExpediteurController', 'detailsannonceexp');
$router->add('POST', 'makeRequest', 'ExpediteurController', 'makeRequest');
$router->add('GET', 'MesColis', 'ExpediteurController', 'mescolis');
$router->add('GET', 'PrflExpediteur', 'ExpediteurController', 'prflexpediteur');

?>



