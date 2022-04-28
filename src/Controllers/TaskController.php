<?php

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