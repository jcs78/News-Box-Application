#! /usr/bin/php
<?php

require_once('path.inc');
require_once('get_host_info.inc');
require_once('databaseRabbitMQLib.php');

$client = new rabbitMQClient("testRabbitMQ.ini","testServer");

if (isset($argv[1]))
{
	$msg = $argv[1];
}

else
{
	$msg = "test message";
}

$request = array();
$request['type'] = "login";
$request['username'] = "testName1";
$request['password'] = "testPass1";
$request['message'] = $msg;
$response = $client->send_request($request);
//$response = $client->publish($request);

echo "Client received response: ".PHP_EOL;
print_r($response);
echo "\n\n";

echo $argv[0]." END".PHP_EOL;
?>

