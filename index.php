<?php
require "helpers/helpers.php";

$path = $_SERVER["REQUEST_URI"];

if ($path == "/")
    view('index');
elseif ($path == "/tasks")
    require 'tasks.php';
elseif ($path == "/users")
    require "users.php";