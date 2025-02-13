<?php

$router->add('GET', 'admin', 'AdminController', 'dashboard');
$router->add('GET', 'login', 'ConducteurController', 'showItiniraire');
$router->add('GET', 'Conducteur/dashboard', 'ConducteurController', 'dashboard');
$router->add('GET', 'Conducteur/details/{id}', 'ConducteurController', 'details');
$router->add('GET', 'Expediteur/dashboard', 'ExpediteurController', 'dashboard');




