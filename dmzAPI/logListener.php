#!/usr/bin/php
<?php

// Requiring once the path to external libraries (not used right now)...
require_once('path.inc');

// ...the info of the user accessing Rabbit (along with the other things inside 'logRabbit.ini')...
require_once('get_host_info.inc');

// ...and the classes and functions that allow for connection to RabbitMQ. [-jcs78]
require_once('dmzRabbitMQLib.php');

error_reporting(E_ALL);
set_error_handler("handleError");

// Create a server using the information inside 'logRabbitMQ.ini.' [-jcs78]
$logServer = listenLog();

echo "Now Listening for Logs...".PHP_EOL;

// Grab anything send through the log queue and exchange and run it through the storeLogs function. [-jcs78]
$logServer->process_logs('storeLogs');

echo "Stopped Listening for Logs.".PHP_EOL;

exit();

function storeLogs($request)
{
// Open up the file that stores the logs receive (log.txt), append it inside, and close it up. [-jcs78]
	$fp = fopen('log.txt', 'a');
	fwrite($fp, $request . "\n");
	fclose($fp);

// Used as a test to ensure the latest log(s) sent were received by the "server"-side. [-jcs78]
//	echo $request;
}

?>

