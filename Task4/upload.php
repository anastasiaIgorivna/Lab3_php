<?php
$uploadDir = "uploads/"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {

        $fileName = basename($_FILES["image"]["name"]);
        $targetPath = $uploadDir . $fileName;

        $allowedTypes = ["jpg", "jpeg", "png", "gif"];
        $fileType = strtolower(pathinfo($targetPath, PATHINFO_EXTENSION));

        if (in_array($fileType, $allowedTypes)) {

            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetPath)) {
                echo "<h3>Файл успішно завантажено!</h3>";
                echo "<p>Ім’я файлу: $fileName</p>";
                echo "<img src='$targetPath' alt='Зображення' width='300'>";
            } else {
                echo "❌ Помилка при збереженні файлу.";
            }

        } else {
            echo "❌ Дозволено тільки JPG, JPEG, PNG, GIF.";
        }

    } else {
        echo "❌ Помилка завантаження файлу.";
    }

} else {
    echo "Форма не була відправлена.";
}
?>
