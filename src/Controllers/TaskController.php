<?php

namespace GKnyihar\Info2Demo\Controllers;

class TaskController
{
    public function index()
    {
        $tasks = [
            "Bevásárlás",
            "Takarítás",
            "Főzés"
        ];

        view('tasks', compact('tasks'));
    }
}