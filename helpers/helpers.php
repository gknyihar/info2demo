<?php

function view($name, $params = []){
    extract($params);
    $slot = "resources/views/{$name}.view.php";
    require "resources/views/layout.view.php";
}