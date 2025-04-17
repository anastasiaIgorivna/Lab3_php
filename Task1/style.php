<?php
if (isset($_GET['size'])) {
    $fontSize = $_GET['size'];
    setcookie("font_size", $fontSize, time() + (30 * 24 * 60 * 60), "/"); // cookie на весь сайт
}
// Повернення назад
header("Location: " . $_SERVER['HTTP_REFERER']);
exit();
