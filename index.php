<?php

require_once 'vendor/autoload.php';

$container = new \IngeniozIT\Edict\Container();
require_once 'config/config.php';
require_once 'config/helper.php';

// Feature flags
require_once 'config/features.php';

$request = getRequest($container);

$routes = require_once 'config/routes.php';
$router = new \IngeniozIT\Router\Router($routes, $container);
$response = $router->handle($request);

sendResponse($response);
