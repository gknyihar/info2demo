<?php

namespace GKnyihar\Info2Demo\Controllers;

use PDO;
use PDOException;

class UserController
{
    public function index()
    {
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=info2demo", "root", "");
        } catch (PDOException $exception) {
            die($exception->getMessage());
        }
        $query = $pdo->prepare("select * from users;");
        $query->execute();
        $users = $query->fetchAll(PDO::FETCH_OBJ);

        view('users', compact('users'));
    }
}