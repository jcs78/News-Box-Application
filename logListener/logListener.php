#!/usr/bin/php
<?php

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

$logServer = new rabbitMQServer("logRabbitMQ.ini", "logServer");

echo "Now Listening for Logs...".PHP_EOL;
$logServer->process_logs('detectLogs');
echo "Stopped Listening for Logs.".PHP_EOL;
exit();

function detectLogs($request)
{
	$fp = fopen('log.txt', 'a');
	fwrite($fp, $request . "\n");
	fclose($fp);

	echo $request;
}

?>

