<?php

include 'settings.php';

$file = fopen("lemma.txt", "r");
$i = 0;

while (!feof($file)) {
  $i++;
  $line = fgets($file);
  $row = explode(" ", $line);
  $rank = $row[0];
  $word = $row[2];
  $frequency = $row[1];
  $pos = $row[3];
  $res = mysql_query("INSERT INTO words (words, frequency, rank, pos) VALUES ('" . mysql_escape_string($word) ."', ". intval($frequency) . ", ". intval($rank) .",'". mysql_escape_string($pos) ."')");
}

fclose($file);
mysql_close($conn);