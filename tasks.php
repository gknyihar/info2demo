<?php
require "helpers/helpers.php";

try {
    $pdo = new PDO("mysql:host=localhost;dbname=info2demo", "root", "");
} catch (PDOException $exception) {
    die($exception->getMessage());
}
$query = $pdo->prepare("select * from tasks;");
$query->execute();
$tasks = $query->fetchAll(PDO::FETCH_OBJ);

view('tasks', compact('tasks'));