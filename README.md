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
require 'index.view.php';
```
