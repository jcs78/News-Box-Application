#!/usr/bin/php
<?php

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

$logServer = new rabbitMQServer("rabbitMQNewsApp.ini", "serverNewsApp");

echo "Now Listening for Logs...".PHP_EOL;
$server->process_requests('detectLogs');
echo "Stopped Listening for Logs.".PHP_EOL;
exit();

function detectLogs($request)
{
	
}

// $server = new rabbitMQServer("testRabbitMQ.ini","testServer");
// echo "testRabbitMQServer BEGIN".PHP_EOL;
// $server->process_requests('requestProcessor');
// echo "testRabbitMQServer END".PHP_EOL;
// exit();

?>

