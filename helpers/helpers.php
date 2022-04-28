<?php

function view($name){
    $slot = file_get_contents("resources/views/{$name}.view.php");
    require "resources/views/layout.view.php";
}