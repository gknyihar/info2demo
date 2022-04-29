<?php
    try{
        $pdo = new PDO("mysql:host=localhost;dbname=info2demo", "root", "");
    } catch (PDOException $exception){
        die($exception->getMessage());
    }
    $query = $pdo->prepare("select * from tasks;");
    $query->execute();
    $tasks = $query->fetchAll(PDO::FETCH_OBJ);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Info2</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

<div class="bg-gray-100 flex flex-col items-center min-h-screen">

    <div class="bg-white h-12 shadow flex items-center text-lg justify-center w-full mb-4 grow-0">
        <div class="max-w-5xl w-full font-sans flex justify-between px-4">
            <h1 class="font-bold">Feladatok</h1>
            <div class="flex gap-4 text-gray-400">
                <a href="/" class="hover:underline">Főoldal</a>
                <a href="/tasks.php" class="hover:underline">Feladatok</a>
                <a href="/users.php" class="hover:underline">Felhasználók</a>
            </div>
        </div>
    </div>

    <div class="max-w-5xl w-full px-4 grow">
        <div class="flex flex-col gap-4">
            <?php foreach ($tasks as $task): ?>
                <div class="bg-white p-4 shadow border-gray-200 rounded-lg">
                    <h1 class="text-xl font-bold">
                        <?= $task->title; ?>
                    </h1>
                    <p class="mt-4">
                        <?= $task->description; ?>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="max-w-5xl w-full px-4 text-center grow-0 text-gray-400 p-2">
        <span>Copyright © 2022</span>
    </div>
</div>

</body>
</html>
