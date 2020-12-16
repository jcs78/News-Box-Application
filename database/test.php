#!/usr/bin/php
<?php
echo "Test PHP BEGIN".PHP_EOL;

$a = array();

$b = array(1,2,3);
$c = array(4,5,6);

array_push($a,$b);
array_push($a,$c);

print_r($a);


echo "\n\n";

?>
