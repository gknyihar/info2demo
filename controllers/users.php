<?php
$link = mysqli_connect('localhost', 'root', '', 'tasks')
or die("Kapcsolódási hiba: " . mysqli_connect_error());

$users = mysqli_query($link, "SELECT u.*, count(t.id) tasks FROM users u JOIN tasks t on u.id = t.user_id GROUP BY u.id");

$rows = mysqli_num_rows($users);

mysqli_close($link);

$view = 'views/users.view.php';
require 'views/layout.view.php';