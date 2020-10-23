#!/usr/bin/php
<?php
require('path.inc');
require('get_host_info.inc');
require('rabbitMQLib.inc');

function speak($userInputArray){
	//Show input
	//echo "inside speak function array: \n";
	//print_r($userInputArray);
	//echo "\n";
	$client = new rabbitMQClient("testRabbitMQ.ini","testServer");

	$response = $client->send_request($userInputArray);
	return $response;
}

// Testing

$inputArray = array();

$inputArray['type'] = 'login';
$inputArray['username'] = 'testName1';
$inputArray['password'] = 'testPass1';

echo"\n";

$rtnInfo = speak($inputArray);

print_r($rtnInfo);
echo "\n\n";

?>



