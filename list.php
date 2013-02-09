<?php

require('settings.php');

header("Content-type: application/json");
$items = array();


function get_words($rank_low, $rank_high, $count) {
  $items = array();
  $sql = "
    SELECT words.words, words.frequency, words.rank FROM
    (SELECT FLOOR(". intval($rank_low)." + RAND() * ". (intval($rank_high) - intval($rank_low)) .") AS `num` FROM words LIMIT ". intval($count) .") AS numlist
    LEFT JOIN words ON numlist.num = words.rank
  ";

  $res = mysql_query($sql);
  $err = '';

  while ($row = mysql_fetch_assoc($res)) {
    $items[] = $row;
    $err .= mysql_error();
  }

  return $items;
}

$items['500'] = get_words(1, 500, 20);
$items['1000'] = get_words(1001, 2000, 20);
$items['2000'] = get_words(2001, 4000, 20);
$items['4000'] = get_words(4001, 8000, 20);
$items['16000'] = get_words(8001, 16000, 20);
$items['32000'] = get_words(16001, 32618, 20);

echo json_encode($items);

