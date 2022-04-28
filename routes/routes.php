<?php

use GKnyihar\Info2Demo\Controllers\IndexController;
use GKnyihar\Info2Demo\Controllers\TaskController;

return [
  '/' => [IndexController::class, 'index'],
  '/tasks' => [TaskController::class, 'index'],
];