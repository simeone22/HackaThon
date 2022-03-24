<?php

include "connect.php";

$words = $_REQUEST["parole"];
$found_words = [];

OpenConnection();

foreach ($words as $word) {
    $current_word = strtolower($word);
    $found_word = PerformQuery("SELECT Parola FROM Parole WHERE Parola = '$current_word'");
    if (mysqli_num_rows($found_word) != 0) {
        $found_words[] = $word;
    }
}

CloseConnection();

echo implode(", ", $found_words);

?>