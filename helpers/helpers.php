<?php

function view($view, $params = [])
{
    extract($params);
    $slot = "views/{$view}.view.php";
    require "views/layout.view.php";
}