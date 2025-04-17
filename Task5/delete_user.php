<?php
function deleteFolder($folderPath) {
    if (!is_dir($folderPath)) return;

    $items = scandir($folderPath);
    foreach ($items as $item) {
        if ($item != "." && $item != "..") {
            $path = $folderPath . "/" . $item;
            if (is_dir($path)) {
                deleteFolder($path);
            } else {
                unlink($path);
            }
        }
    }
    rmdir($folderPath);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $login = trim($_POST['login']);
    $password = trim($_POST['password']); 

    $userDir = "users/" . $login;

    if (is_dir($userDir)) {
        deleteFolder($userDir);
        echo "✅ Папку '$login' успішно видалено разом з усім вмістом.";
    } else {
        echo "❌ Помилка: Папка для логіна '$login' не знайдена.";
    }
}
?>
