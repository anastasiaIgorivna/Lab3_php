<?php
$inputFile = "words.txt";
$outputFile = "sorted_words.txt";


if (file_exists($inputFile)) {
    
    $content = file_get_contents($inputFile);
    
    $words = explode(" ", trim($content));

    sort($words, SORT_LOCALE_STRING); 
    
    $sortedWords = implode(" ", $words);

    file_put_contents($outputFile, $sortedWords);

    echo "<h3>Слова успішно впорядковано!</h3>";
    echo "<p><strong>Результат:</strong> $sortedWords</p>";
    echo "<p>Збережено у файл: $outputFile</p>";
} else {
    echo "Файл $inputFile не знайдено.";
}
?>
