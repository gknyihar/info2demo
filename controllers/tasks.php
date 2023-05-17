<?php

// Database connection
$link = mysqli_connect('localhost', 'root', '', 'tasks')
or die("Kapcsolódási hiba: " . mysqli_connect_error());


// Check user
if (!isset($_GET['user']) || !$_GET['user']) {
    header("Location: /users");
    die();
}

$userId = mysqli_real_escape_string($link, $_GET['user']);
$result = mysqli_query($link, sprintf("SELECT * FROM users WHERE id = %s", $userId));
$user = mysqli_fetch_object($result);

if (!$user) {
    http_response_code(404);
    die("404 - Not found");
}

// Handle task status update and delete
if (isset($_POST['task']) && $_POST['task']) {
    $task = mysqli_real_escape_string($link, $_POST['task']);

    if (isset($_POST['in_progress']))
        mysqli_query($link, sprintf("UPDATE tasks SET status = '%s' WHERE id = %s", 'in_progress', $task));

    if (isset($_POST['done']))
        mysqli_query($link, sprintf("UPDATE tasks SET status = '%s' WHERE id = %s", 'done', $task));

    if (isset($_POST['delete']))
        mysqli_query($link, sprintf("DELETE FROM tasks WHERE id = %s", $task));
}

// Handle new task create
$title = "";
$description = "";
$error = [];

if (isset($_POST['save'])) {

    if (isset($_POST['title']) && $_POST['title']) {
        $title = mysqli_real_escape_string($link, $_POST['title']);
    } else {
        $error['title'] = "A cím megadása kötelező!";
    }

    if (isset($_POST['description']) && $_POST['description']) {
        $description = mysqli_real_escape_string($link, $_POST['description']);
    } else {
        $error['description'] = "A leírás megadása kötelező!";
    }

    if (empty($error)) {
        mysqli_query($link, sprintf("INSERT tasks(title,description,user_id) VALUES('%s','%s','%s')", $title, $description, $userId));
        $title = "";
        $description = "";
    }
}

// Get tasks
$query = sprintf("SELECT * FROM tasks WHERE user_id = %s ORDER BY FIELD(status, 'new', 'in_progress', 'done'), id", $userId);
$tasks = mysqli_query($link, $query);
$rows = mysqli_num_rows($tasks);


$status = [
    'new' => ['title' => 'Új', 'class' => 'text-primary'],
    'in_progress' => ['title' => 'Folyamatban', 'class' => 'text-warning'],
    'done' => ['title' => 'Kész', 'class' => 'text-secondary']
];

mysqli_close($link);

$view = 'views/tasks.view.php';
require 'views/layout.view.php';