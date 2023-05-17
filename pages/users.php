<?php
$link = mysqli_connect('localhost', 'root', '', 'tasks')
or die("Kapcsolódási hiba: " . mysqli_connect_error());

$users = mysqli_query($link, "SELECT u.*, count(t.id) tasks FROM users u JOIN tasks t on u.id = t.user_id GROUP BY u.id");

$rows = mysqli_num_rows($users);

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
                <a class="nav-link" href="users">Felhasználók</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container my-4 flex-grow-1">

    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Kezdőlap</a></li>
            <li class="breadcrumb-item active" aria-current="page">Felhasználók</li>
        </ol>
    </nav>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h5 class="card-title">Felhasználók</h5>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Felhasználónév</th>
                    <th scope="col">Név</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Feladatok</th>
                </tr>
                </thead>
                <tbody class="table-group-divider">
                <?php while ($user = mysqli_fetch_object($users)): ?>
                    <tr>
                        <th scope="row"><?= $user->id; ?></th>
                        <td><?= $user->username; ?></td>
                        <td><?= $user->name; ?></td>
                        <td>
                            <i class="bi bi-envelope"></i>
                            <a href="mailto:<?= $user->email; ?>">
                                <?= $user->email; ?>
                            </a>
                        </td>
                        <td>
                            <a href="/tasks?user=<?= $user->id; ?>"><?= $user->tasks; ?> feladat</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
            <div>
                Sorok száma: <?= $rows ?>
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