<?php

use GKnyihar\Info2Demo\Services\Router;

require "vendor/autoload.php";

$path = preg_replace("|^/demo/|","/",$_SERVER['REQUEST_URI']);

$routes = require "routes/routes.php";
$router = new Router($routes);
$router->load($path);
