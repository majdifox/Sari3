<?php

$router->add('GET', 'admin', 'AdminController', 'dashboard');
$router->add('GET', 'login', 'ConducteurController', 'showItiniraire');
$router->add('GET', 'Conducteur/dashboard', 'ConducteurController', 'dashboard');
$router->add('GET', 'Expediteur/dashboard', 'ExpediteurController', 'dashboard');
$router->add('GET', 'admin', 'AdminController', 'dashboard');
$router->add('GET', 'admin/expediteurs', 'AdminController', 'ListExpediteurs');
$router->add('GET', 'admin/users', 'AdminController', 'ListUsers');
$router->add('POST', 'admin/validate/{id}', 'AdminController', 'ValidateUser');
$router->add('POST', 'admin/suspend/{id}', 'AdminController', 'SuspendUser');
$router->add('DELETE', 'admin/delete/{id}', 'AdminController', 'deleteUser');
$router->add('GET', 'admin/announcements', 'AdminController', 'ListAnnouncements');
$router->add('POST', 'admin/create-announcement', 'AdminController', 'CreateAnnouncement');
$router->add('POST', 'admin/delete-announcement/{id}', 'AdminController', 'DeleteAnnouncement');
