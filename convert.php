<?php

include 'settings.php';

$file = fopen("lemma.num.txt", "r");
$i = 0;

$output = fopen("lemma.utf8.txt", "wa");

while (!feof($file) && $i < 5) {
  $i++;
  $line = fgets($file);
  echo("Mac: ". iconv('x-mac-cyrillic', 'utf-8', $line) ."\n");
  echo("Mac: ". iconv('x-mac-cyrillic', 'windows-1251', $line) ."\n");

  echo("Win: ". iconv('windows-1251', 'utf-8', $line)."\n");
  echo("Win: ". iconv('windows-1251', 'x-mac-cyrillic', $line)."\n");

  echo("Koi: ". iconv('koi8-r', 'utf-8', $line)."\n");
  echo("Iso: ". iconv('iso8859-5 ', 'utf-8', $line)."\n");
  echo("X: ". iconv('x-cp866', 'utf-8', $line)."\n");

  //fputs($output, $utf8);
}

fclose($file);
fclose($output);
mysql_close($conn);