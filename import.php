<?php

$conn = mysql_connect('127.0.0.1', 'root', '');
if (!$conn) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db('russian');

mysql_query("SET NAMES utf8;");

$file = fopen("ru_50k.txt", "r");
$i = 0;

while (!feof($file)) {
  $i++;
  $line = fgets($file);
  $row = explode(" ", $line);
  $word = $row[0];
  $frequency = $row[1];
  $res = mysql_query("INSERT INTO words (words, frequency, rank) VALUES ('" . mysql_escape_string($word) ."', ". intval($frequency) . ", ". intval($i) .")");
}

fclose($file);
mysql_close($conn);