#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

function speak($userInputArray){

	$client = new rabbitMQClient("testRabbitMQ.ini","testServer");

	$response = $client->send_request($userInputArray);

	return $response;
}

$inputArr = array();

$inputArray['type'] = 'login';
$inputArray['username'] = 'testName1';
$inputArray['password'] = 'testPass1';


$rtnInfo = speak($inputArr);

print_r($rtnInfo);
