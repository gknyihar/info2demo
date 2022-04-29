<?php

namespace GKnyihar\Info2Demo\Controllers;

use GKnyihar\Info2Demo\Models\Task;

class TaskController
{
    public function index()
    {
        $tasks = Task::all();

        view('tasks', compact('tasks'));
    }
}