# Info2 Demo

# Start
index.php
```php
<?php
    $name = "Info2";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Info2</title>
</head>
<body>
    <h1>Hello, <?=$name;?>!</h1>
</body>
</html>

```

## A kód és megjelenítés szétválasztása
index.view.php
```html
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Info2</title>
</head>
<body>
<h1>Hello, <?=$name;?>!</h1>
</body>
</html>
```
index.php
```php
<?php
$name = "Info2";
require 'layout.view.php';
```

## Layout létrehozása
Mappa struktúra:
* helpers
  * helpers.php
* resources
  * css
    * app.css
  * js
  * views
    * index.view.php
    * layout.view.php
* index.php

index.php:

```php
<?php
require "helpers/helpers.php";

$name = "Info2";
view("index");
```

helpers/helpers.php:
```php
<?php

function view($name){
    $slot = file_get_contents("resources/views/{$name}.view.php");
    require "resources/views/layout.view.php";
}
```
resources/css/app.css
```css
.header{
    background-color: #787878;
    padding: 15px;
    text-align: center;
}

ul{
    list-style-type: none;
    padding-left: 0;
}

li{
    border: 1px solid black;
    padding: 5px;
    border-radius: 5px;
    margin-bottom: 5px;
}

li:hover{
    background-color: #cccccc;
}
```
resources/views/index.view.php
```html
<h1>Hello, Info2!</h1>

<ul>
  <li>Bevásárlás</li>
  <li>Takarítás</li>
  <li>Főzés</li>
</ul>
```
resources/views/layout.view.php
```php
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Info2</title>
    <link rel="stylesheet" type="text/css" href="resources/css/app.css"/>
</head>
<body>
<div class="header">
    <h1>Feladatok</h1>
</div>
<div>
    <?= $slot; ?>
</div>
</body>
</html>

```

