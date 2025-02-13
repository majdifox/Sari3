<?php

$router->add('GET', 'admin', 'AdminController', 'dashboard');
$router->add('GET', 'login', 'authController', 'login');
$router->add('POST', 'login', 'authController', 'login');
$router->add('GET', 'Conducteur', 'ConducteurController', 'dashboard');
$router->add('GET', 'Expediteur', 'ExpediteurController', 'dashboard');




