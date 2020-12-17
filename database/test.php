#!/usr/bin/php
<?php
echo "Test PHP BEGIN".PHP_EOL;


$hashed1 = hash('sha512', 'abc');

$hashed2 = hash('sha512', 'abc');

if ($hashed1 == $hashed2){
	echo "yes";
}

echo "\n\n";

?>
