<?php

namespace GKnyihar\Info2Demo\Controllers;

use GKnyihar\Info2Demo\Models\Task;

class TaskController
{
    public function index()
    {
        $tasks = Task::all();
//        $tasks = [
//            [
//                "title" => "Bevásárlás",
//                "description" => "Kenyér, Tej"
//            ],
//            [
//                "title" => "Takarítás",
//                "description" => "Az egész ház"
//            ],
//            [
//                "title" => "Főzés",
//                "description" => "Vacsora készítés a családnak"
//            ]
//        ];

        view('tasks', compact('tasks'));
    }
}