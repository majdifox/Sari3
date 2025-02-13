<?php

$router->add('GET', 'Admin', 'AdminController', 'dashboard');
$router->add('GET', 'login', 'authController', 'login');
$router->add('POST', 'login', 'authController', 'login');
$router->add('GET', 'Conducteur', 'ConducteurController', 'dashboard');
$router->add('GET', 'Expediteur', 'ExpediteurController', 'dashboard');
$router->add('GET', 'Admin', 'AdminController', 'dashboard');
$router->add('GET', 'Admin/expediteurs', 'AdminController', 'ListExpediteurs');
$router->add('GET', 'Admin/users', 'AdminController', 'ListUsers');
$router->add('POST', 'Admin/validate/{id}', 'AdminController', 'ValidateUser');
$router->add('POST', 'Admin/suspend/{id}', 'AdminController', 'SuspendUser');
$router->add('DELETE', 'Admin/delete/{id}', 'AdminController', 'deleteUser');
$router->add('GET', 'Admin/announcements', 'AdminController', 'ListAnnouncements');
$router->add('POST', 'Admin/create-announcement', 'AdminController', 'CreateAnnouncement');
$router->add('POST', 'Admin/delete-announcement/{id}', 'AdminController', 'DeleteAnnouncement');
