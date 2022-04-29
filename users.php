<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=info2demo", "root", "");
} catch (PDOException $exception) {
    die($exception->getMessage());
}
$query = $pdo->prepare("select * from users;");
$query->execute();
$users = $query->fetchAll(PDO::FETCH_OBJ);

require 'views/users.view.php';