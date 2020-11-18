#!/usr/bin/php
<?php

require_once('path.inc');
require_once('get_host_info.inc');
require_once('databaseRabbitMQLib.php');

$client = new databaseClient("dbToWebLocalRabbitMQ.ini","dbServer");

if (isset($argv[1]))
{
	$msg = $argv[1];
}

else
{
	$msg = "test message";
}

$request = array();
$request['type'] = "register";
$request['username'] = "testName7";
$request['password'] = "testPass";
$request['preferences'] = '';
$response = $client->send_request($request);
//$response = $client->publish($request);

echo "Client received response: ".PHP_EOL;

echo gettype($response);
echo "\n\n";

if ($response){
	echo "New User Made";
}else{
	echo "New User Not Made";
}

echo "\n\n";

echo $argv[0]." END".PHP_EOL;
?>

