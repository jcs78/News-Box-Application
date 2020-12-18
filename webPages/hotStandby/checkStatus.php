<?php
function checkStatus(){
	$file = fopen('hotStandby/amialive.txt', 'r');
	$isAlive = fread($file,1);
	fclose($file);

	return $isAlive;
}


?>
