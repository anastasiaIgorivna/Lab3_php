<?php

$generatedFiles = ['only_in_first.txt', 'in_both.txt', 'more_than_two.txt'];


$file1 = 'file1.txt';
$file2 = 'file2.txt';

if (file_exists($file1) && file_exists($file2)) {
    $words1 = preg_split('/\s+/', trim(file_get_contents($file1)));
    $words2 = preg_split('/\s+/', trim(file_get_contents($file2)));

    
    $onlyInFirst = array_diff($words1, $words2);

    
    $inBoth = array_intersect($words1, $words2);

    $count1 = array_count_values($words1);
    $count2 = array_count_values($words2);

    $moreThanTwo = [];

    foreach ($count1 as $word => $count) {
        if ($count > 2 && isset($count2[$word]) && $count2[$word] > 2) {
            $moreThanTwo[] = $word;
        }
    }

    file_put_contents("only_in_first.txt", implode(" ", $onlyInFirst));
    file_put_contents("in_both.txt", implode(" ", $inBoth));
    file_put_contents("more_than_two.txt", implode(" ", $moreThanTwo));
}

$deletionMessage = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['file_to_delete'])) {
    $filename = $_POST['file_to_delete'];

    if (in_array($filename, $generatedFiles) && file_exists($filename)) {
        unlink($filename);
        $deletionMessage = "✅ Файл <b>$filename</b> успішно видалено.";
    } else {
        $deletionMessage = "❌ Неможливо видалити файл: або його не існує, або він не в списку дозволених.";
    }
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Обробка слів та видалення файлів</title>
</head>
<body>
    <h2>🟢 Створення файлів завершено</h2>
    <p>Створено файли: <code><?= implode(", ", $generatedFiles) ?></code></p>

    <hr>

    <h2>🗑️ Видалити один із створених файлів</h2>
    <form method="POST">
        <label for="file_to_delete">Оберіть файл:</label><br>
        <select name="file_to_delete" id="file_to_delete" required>
            <?php foreach ($generatedFiles as $file): ?>
                <?php if (file_exists($file)): ?>
                    <option value="<?= $file ?>"><?= $file ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select><br><br>
        <input type="submit" value="Видалити файл">
    </form>

    <?php if ($deletionMessage): ?>
        <p><strong><?= $deletionMessage ?></strong></p>
    <?php endif; ?>
</body>
</html>
