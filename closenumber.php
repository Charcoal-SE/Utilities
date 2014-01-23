<?php
require('simple_html_dom.php');
include "base.php";

$html = file_get_html('http://stackoverflow.com/review/close/stats');

$closeitems  = $html->find('a.review-stats-count');
foreach($closeitems as $item)
    $closeitem = $item->plaintext;
$fp = fopen('/var/www/close.csv', 'a');
$timestamp = date("Y-m-d H:i:s");
$item = array($timestamp, $closeitem);
fputcsv($fp, $item);

$closeitem = str_replace(',', '', $closeitem);
mysql_query("INSERT INTO closequeue (`Time`, NumInQueue) VALUES ('". $timestamp ."', ". $closeitem .")");
//echo "INSERT INTO closequeue (`Time`, NumInQueue) VALUES (". $timestamp .", ". $closeitem .")";
fclose($fp);
?>
