<?php

function view($view, $params = [])
{
    extract($params);
    $slot = "views/{$view}.view.php";
    require "views/layout.view.php";
}

function config($key, $default = null)
{
    list($file, $array_key) = explode('.', $key);

    $fileName = "config/{$file}.php";
    if (!file_exists($fileName)) return $default;
    $config = require $fileName;

    if (!array_key_exists($array_key, $config)) return $default;

    return $config[$array_key];
}