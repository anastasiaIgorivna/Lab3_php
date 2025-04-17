<?php
// Зчитуємо розмір шрифту з cookie або беремо стандартний
$fontSize = isset($_COOKIE['font_size']) ? $_COOKIE['font_size'] : '16px';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Мій сайт</title>
</head>
<body style="font-size: <?= htmlspecialchars($fontSize) ?>;">

<nav>
    <a href="index.php">Головна</a> |
    <a href="about.php">Про нас</a> |
    <a href="style.php?size=24px">Великий</a> |
    <a href="style.php?size=16px">Середній</a> |
    <a href="style.php?size=12px">Маленький</a>
</nav>
<hr>
