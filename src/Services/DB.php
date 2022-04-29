<?php


namespace GKnyihar\Info2Demo\Services;


use PDO;

class DB
{
    private $pdo;

    public function __construct($connectionString, $username, $password)
    {
        $this->pdo = new PDO($connectionString, $username, $password);
    }

    public function query($query, $object = "stdClass")
    {
        $query = $this->pdo->prepare($query);
        $query->execute();
        return $query->fetchObject($object);
    }
}