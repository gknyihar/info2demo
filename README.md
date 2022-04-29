# Info2 Demo

A feladat, hogy a kiinduló szkriptet refaktoráljuk, hogy egy fenntarthatóbb és átláthatóbb kódot kapjunk.

## PHP kód és a nézet szeparálása

* views
  * index.view.php
  * tasks.view.php
  * users.view.php
* index.php
* tasks.php
* users.php

index.view.php:
```html
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
        <div class="bg-white p-4 shadow border-gray-200 rounded-lg">
            <h1 class="text-xl font-bold">
                Hello, Info2!
            </h1>
            <p class="mt-4">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce imperdiet tellus felis, ut gravida enim
                tempus sed. Donec efficitur faucibus ipsum et ornare. Maecenas convallis in risus et vulputate. Nullam
                sit amet elementum urna, ac malesuada tellus. Duis urna odio, pretium ac nulla vitae, interdum
                pellentesque justo. Nulla sed accumsan dolor. Pellentesque et auctor justo. Ut sit amet libero vel
                libero commodo blandit eget at velit.
            </p>
        </div>
    </div>

    <div class="max-w-5xl w-full px-4 text-center grow-0 text-gray-400 p-2">
        <span>Copyright © 2022</span>
    </div>
</div>

</body>
</html>
```
tasks.view.php
```html
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
```
users.view.php
```html
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
            <div class="bg-white p-4 shadow border-gray-200 rounded-lg">
                <h1 class="text-xl font-bold">
                    Felhasználók
                </h1>
                <table class="mt-4">
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td class="border p-2"><?= $user->id; ?></td>
                            <td class="border p-2"><?= $user->username; ?></td>
                            <td class="border p-2"><?= $user->name; ?></td>
                            <td class="border p-2"><?= $user->email; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <p class="mt-4">
                </p>
            </div>
        </div>
    </div>

    <div class="max-w-5xl w-full px-4 text-center grow-0 text-gray-400 p-2">
        <span>Copyright © 2022</span>
    </div>
</div>

</body>
</html>
```
index.php
```php
<?php

require 'views/index.view.php';
```
tasks.php
```php
<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=info2demo", "root", "");
} catch (PDOException $exception) {
    die($exception->getMessage());
}
$query = $pdo->prepare("select * from tasks;");
$query->execute();
$tasks = $query->fetchAll(PDO::FETCH_OBJ);

require 'views/tasks.view.php';
```
users.php
```php
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
```
## Layout készítés

layout.view.php
```html
    <!--- html --->
    <div class="max-w-5xl w-full px-4 grow">
        <?php require $slot; ?>
    </div>
    <!--- html --->
```
helpers/helpers.php
```php
<?php

function view($view, $params = [])
{
    extract($params);
    $slot = "views/{$view}.view.php";
    require "views/layout.view.php";
}
```
index.php
```php
<?php
require "helpers/helpers.php";

view('index');
```
tasks.php
```php
<?php
require "helpers/helpers.php";
// ...
view('tasks', compact('tasks'));
```
users.php
```php
<?php
require "helpers/helpers.php";
// ...
view('users', compact('users'));;
```
## Routolás
```php
<?php
require "helpers/helpers.php";

$path = $_SERVER["REQUEST_URI"];

if ($path == "/")
    view('index');
elseif ($path == "/tasks")
    require 'tasks.php';
elseif ($path == "/users")
    require "users.php";
```
Törölni kell a `require` sorokat a `tasks.php` és a `users.php`-ból.

## Autoload
```bash
composer init
```
composer.json
```json
{
    "name": "gknyihar/info2demo",
    "type": "project",
    "license": "MIT",
    "autoload": {
        "psr-4": {
            "GKnyihar\\Info2Demo\\": "src/"
        }
    },
    "authors": [
        {
            "name": "Knyihár Gábor",
            "email": "gabor.knyihar@aut.bme.hu"
        }
    ],
    "require": {}
}
```
index.php
```php
<?php
require "vendor/autoload.php";
//...
```