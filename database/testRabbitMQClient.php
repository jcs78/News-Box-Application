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
$request['type'] = "getArticles";
$request['username'] = "testName";
$request['password'] = "testPass";

$request['userID'] = 1;

$request['preferences'] = '';
$response = $client->send_request($request);
//$response = $client->publish($request);

echo "Client received response: ".PHP_EOL;

echo gettype($response);
echo "\n\n";

print_r($response);

echo "\n\n";

echo $argv[0]." END".PHP_EOL;
?>

