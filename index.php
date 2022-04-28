<?php
require "helpers/helpers.php";
require "src/Controllers/TaskController.php";

$controller = new TaskController();
$controller->index();

