<?php
$filename = 'comments.txt';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $comment = trim($_POST['comment']);

    if ($name && $comment) {
        $entry = $name . "|" . $comment . PHP_EOL;
        file_put_contents($filename, $entry, FILE_APPEND);
    }
}

$comments = [];
if (file_exists($filename)) {
    $file = fopen($filename, 'r');
    while (!feof($file)) {
        $line = fgets($file);
        if ($line) {
            $parts = explode("|", trim($line), 2);
            if (count($parts) == 2) {
                $comments[] = [
                    'name' => htmlspecialchars($parts[0]),
                    'comment' => htmlspecialchars($parts[1])
                ];
            }
        }
    }
    fclose($file);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Коментарі</title>
    <style>
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid gray; padding: 8px; }
    </style>
</head>
<body>

<h2>Залишити коментар</h2>
<form method="POST">
    <label>Ім’я: <input type="text" name="name" required></label><br><br>
    <label>Коментар:<br><textarea name="comment" rows="4" cols="40" required></textarea></label><br><br>
    <input type="submit" value="Надіслати">
</form>

<?php if ($comments): ?>
    <h2>Усі коментарі:</h2>
    <table>
        <tr><th>Ім’я</th><th>Коментар</th></tr>
        <?php foreach ($comments as $c): ?>
            <tr>
                <td><?= $c['name'] ?></td>
                <td><?= nl2br($c['comment']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>

</body>
</html>
