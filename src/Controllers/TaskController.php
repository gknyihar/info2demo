<?php

namespace GKnyihar\Info2Demo\Controllers;

class TaskController
{
    public function index()
    {
        $tasks = [
            [
                "title" => "Bevásárlás",
                "description" => "Kenyér, Tej"
            ],
            [
                "title" => "Takarítás",
                "description" => "Az egész ház"
            ],
            [
                "title" => "Főzés",
                "description" => "Vacsora készítés a családnak"
            ]
        ];

        view('tasks', compact('tasks'));
    }
}