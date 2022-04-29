<?php

namespace GKnyihar\Info2Demo\Controllers;

use GKnyihar\Info2Demo\Models\User;

class UserController
{
    public function index()
    {
        $users = User::all();

        view('users', compact('users'));
    }
}