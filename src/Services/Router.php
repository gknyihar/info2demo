<?php

namespace GKnyihar\Info2Demo\Services;

class Router
{
    protected $routes;

    public function __construct($routes)
    {
        $this->routes = $routes;
    }

    public function load($path)
    {
        if (array_key_exists($path, $this->routes)) {
            $target = $this->routes[$path];
            $class_name = $target[0];
            $class = new $class_name();
            $method = $target[1];
            $class->$method();
        }
    }
}