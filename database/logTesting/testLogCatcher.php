#!/usr/bin/php
<?php
require_once('testRabbitMQClient.php');

try{

	$rtnValue = runClient();
	echo 'Client Connection Success return values:';
	echo "\n\n";

	//var_dump($rtnValue);
	print_r($rtnValue);

}catch(Exception $e){
	echo 'Exception Caught';

	$rtnArray = array();

	$rtnArray['location'] = 'xClient';
	$rtnArray['errorMessage'] = $e->getMessage();

	var_dump($rtnArray);

}

?>
