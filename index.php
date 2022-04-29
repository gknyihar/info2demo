<?php
require "vendor/autoload.php";

use GKnyihar\Info2Demo\Services\Router;

$path = $_SERVER["REQUEST_URI"];

$routes = require "routes/routes.php";
$router = new Router($routes);
$router->load($path);