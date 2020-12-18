#!/usr/bin/php
<?php
echo "Test PHP BEGIN".PHP_EOL;



if(1){
	require_once('hotStandby/checkStatus.php');
}else{
	echo "no";
}

echo checkStatus();


echo "\n\n";

?>
