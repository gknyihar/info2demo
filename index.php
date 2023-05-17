<?php

// Define routes
$routes = [
    '/' => './controllers/index.php',
    '/users' => './controllers/users.php',
    '/tasks' => './controllers/tasks.php'
];

// Determine current root
//      $_SERVER["REQUEST_URI"] contains the requested uri, eg.: /tasks?user=1
//      strtok(...) removes the query string
//      trim(....) removes the '/' characters from the beginning and in the end
$path = '/' . trim(strtok($_SERVER["REQUEST_URI"],'?'), '/');

// Check if route exists
// If not exists, then return with "404 - Not found" error message
if(!array_key_exists($path, $routes)){
    http_response_code(404);
    die("404 - Not found");
}

// Return with the requested page
require $routes[$path];
