#!/usr/bin/php
<?php

//  For a detailed explaination of the log listener, please see logListener.php inside the logTestingGrounds directory.

require_once('../RabbitMQFiles/path.inc');
require_once('../RabbitMQFiles/get_host_info.inc');
require_once('../RabbitMQFiles/dmzRabbitMQLib.php');

error_reporting(E_ALL);
set_error_handler("handleError");

$logServer = listenLog();

echo "Now Listening for Logs...".PHP_EOL;

$logServer->process_log('storeLogs');

echo "Stopped Listening for Logs.".PHP_EOL;

exit();

function storeLogs($request)
{
	$fp = fopen('log.txt', 'a');
	fwrite($fp, $request . "\n");
	fclose($fp);

//	echo $request;
}

?>


