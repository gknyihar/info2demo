<?php

use GKnyihar\Info2Demo\Controllers\IndexController;
use GKnyihar\Info2Demo\Controllers\TaskController;
use GKnyihar\Info2Demo\Controllers\UserController;

return [
    "/" => [IndexController::class, 'index'],
    "/tasks" => [TaskController::class, 'index'],
    "/users" => [UserController::class, 'index'],
];