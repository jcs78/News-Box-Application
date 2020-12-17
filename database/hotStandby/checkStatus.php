<?php
function checkStatus(){
	$file = fopen('test.txt', 'r');
	$isAlive = fread($file,1);
	fclose($file);

	return $isAlive;
}


?>
