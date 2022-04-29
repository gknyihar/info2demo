<?php

namespace GKnyihar\Info2Demo\Services;

use PDO;
use PDOException;

class DB
{
    private $pdo;

    public function __construct($connectionString, $username, $password)
    {
        try {
            $this->pdo = new PDO($connectionString, $username, $password);
        } catch (PDOException $exception) {
            die($exception->getMessage());
        }
    }

    public function query($query, $object = "stdClass")
    {
        $query = $this->pdo->prepare($query);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS, $object);
    }
}