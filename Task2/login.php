<?php
session_start();


if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}

if (isset($_POST['login']) && isset($_POST['password'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];

    // Перевірка логіна і пароля
    if ($login === 'Admin' && $password === 'password') {
        $_SESSION['user'] = 'Admin';
    } else {
        $error = "Невірний логін або пароль!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Авторизація</title>
</head>
<body>

<?php if (isset($_SESSION['user'])): ?>
    <h2>Добрий день, <?= htmlspecialchars($_SESSION['user']) ?>!</h2>
    <a href="login.php?logout=1">Вийти</a>
<?php else: ?>
    <h2>Авторизація</h2>

    <?php if (isset($error)): ?>
        <p style="color:red"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST" action="login.php">
        <label>Логін: <input type="text" name="login" required></label><br><br>
        <label>Пароль: <input type="password" name="password" required></label><br><br>
        <input type="submit" value="Увійти">
    </form>
<?php endif; ?>

</body>
</html>
