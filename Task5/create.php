<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $login = trim($_POST['login']);
    $password = trim($_POST['password']); 

    $baseDir = "users";
    $userDir = $baseDir . "/" . $login;

    if (!is_dir($baseDir)) {
        mkdir($baseDir);
    }

    if (!is_dir($userDir)) {
        mkdir($userDir);
        mkdir("$userDir/video");
        mkdir("$userDir/music");
        mkdir("$userDir/photo");

        file_put_contents("$userDir/video/sample_video.txt", "Це файл для відео");
        file_put_contents("$userDir/music/sample_music.txt", "Це файл для музики");
        file_put_contents("$userDir/photo/sample_photo.txt", "Це файл для фото");

        echo "Папку створено для користувача: $login";
    } else {
        echo "❌ Помилка: Папка для логіна '$login' вже існує.";
    }
}
?>
