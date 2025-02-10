<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Core\Router;
use Config\Routes;
use Core\Database;

$config = require __DIR__ . '/../config/config.php';


Database::connect($config);

$router = new Router();
Routes::registerRoutes($router);
$router->dispatch();
?>
