#!/usr/bin/php
<?php

//  For a detailed explaination of the log listener, please see logListener.php inside the logTestingGrounds directory.

require_once('path.inc');
require_once('get_host_info.inc');
require_once('webServerRabbitMQLib.php');

error_reporting(E_ALL);
set_error_handler("handleError");

$logServer = listenLog();

echo "Now Listening for Logs...".PHP_EOL;

$logServer->process_log('storeLogs');

echo "Stopped Listening for Logs.".PHP_EOL;

exit();

function storeLogs($request)
{
	if ($request == '0'){

		$dbStatusFile = fopen('../hotStandby/isDatabaseAlive.txt','w');

		fwrite($dbStatusFile, '0');
		fclose($dbStatusFile);

	}else if($request == '1'){
		$dbStatusFile = fopen('../hotStandby/isDatabaseAlive.txt','w');

		fwrite($dbStatusFile, '1');
		fclose($dbStatusFile);

	}else{
		$fp = fopen('log.txt', 'a');
		fwrite($fp, $request . "\n");
		fclose($fp);
	}

//	echo $request;
}

?>

