<?php

function view($name, $params = [])
{
    extract($params);
    $slot = "resources/views/{$name}.view.php";
    require "resources/views/layout.view.php";
}

function config($key, $default = null)
{
    list($file, $array_key) = explode('.', $key);

    $fileName = "configs/{$file}.php";
    if (!file_exists($fileName)) return $default;
    $config = require $fileName;

    if (!array_key_exists($array_key, $config)) return $default;

    return $config[$array_key];
}