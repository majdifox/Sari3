<?php

$router->add('GET', '/admin', 'AdminController', 'dashboard');
$router->add('GET', '/admin/utilisateurs/ban/{id}', 'AdminController', 'index');
$router->add('GET', '/admin/inetiare/refuse/{id}', 'AdminController', 'refuseInetieare');
$router->add('GET', '/admin/inetiare/accept/{id}', 'AdminController', 'acceptInetieare');
$router->add('GET', '/expediteur', 'expoditeurController', 'index');
$router->add('GET', '/expediteur/AccountVerification', 'expoditeurController', 'verification');
$router->add('GET', '/expediteur/IneatieareDemande/{@}', 'expoditeurController', 'sendRequest');
$router->add('GET', 'login', 'AdminController', 'login');
$router->add('GET', '/logout', 'authController', 'logout');
$router->add('GET', '/conducteur/IneatieareAnnoncement', 'conducteurController', 'annoncement');
$router->add('GET', '/conducteur/IneatieareDeletion', 'conducteurController', 'DeleteIneatieare');



