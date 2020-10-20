<?php
require('path.inc');
require('get_host_info.inc');
require('rabbitMQLib.inc');

function speak($userInputArray){
	$client = new rabbitMQClient("testRabbitMQ.ini","testServer");

	$response = $client->send_request($userInputArray);
	return $response;
}


