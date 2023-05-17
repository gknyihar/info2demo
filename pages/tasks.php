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
?>

<!doctype html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Feladatok</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body class="bg-body-tertiary min-vh-100 d-flex flex-column">

<nav class="navbar bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/">Feladatok</a>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="/users">Felhasználók</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container my-4 flex-grow-1">

    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Kezdőlap</a></li>
            <li class="breadcrumb-item"><a href="/users">Felhasználók</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $user->name ?></li>
        </ol>
    </nav>

    <div class="row">
        <div class="col">
            <?php while ($task = mysqli_fetch_object($tasks)): ?>
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 class="card-title">
                                <?= $task->title ?>
                            </h5>
                            <?php if ($task->status == 'new'): ?>
                                <form method="post">
                                    <input type="hidden" name="task" value="<?= $task->id ?>">
                                    <button type="submit" name="delete" class="btn btn-outline-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            <?php endif; ?>
                        </div>
                        <h6 class="card-subtitle mb-2 <?= $status[$task->status]['class'] ?>">
                            <?= $status[$task->status]['title'] ?>
                        </h6>
                        <p class="card-text">
                            <?= $task->description ?>
                        </p>
                        <?php if ($task->status != 'done'): ?>
                            <form method="post">
                                <input type="hidden" name="task" value="<?= $task->id ?>">
                                <?php if ($task->status != 'in_progress'): ?>
                                    <input type="submit" class="btn btn-outline-primary" name="in_progress"
                                           value="Folyamatban"/>
                                <?php else: ?>
                                    <input type="submit" class="btn btn-outline-primary" name="done" value="Kész"/>
                                <?php endif; ?>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
        <div class="col">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <h5 class="card-title">
                        Új feladat
                    </h5>
                    <form method="post">
                        <div class="mb-3">
                            <label for="title" class="form-label">Cím</label>
                            <input type="text" id="title" name="title" value="<?= $title ?>"
                                   class="form-control <?= isset($error['title']) ? 'is-invalid' : '' ?>">
                            <div class="invalid-feedback">
                                <?= $error['title'] ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Leírás</label>
                            <textarea id="description" name="description"
                                      class="form-control <?= isset($error['description']) ? 'is-invalid' : '' ?>"
                                      rows="10"><?= $description ?></textarea>
                            <div class="invalid-feedback">
                                <?= $error['description'] ?>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" name="save">Mentés</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>

<div class="container text-center text-secondary my-4">
    <span>Copyright © 2023</span>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
</body>
</html>
