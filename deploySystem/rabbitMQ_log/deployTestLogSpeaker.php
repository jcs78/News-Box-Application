#! /usr/bin/php
<?php

require_once('path.inc');
require_once('get_host_info.inc');
require_once('deployRabbitMQLib.php');

error_reporting(E_ALL);
set_error_handler("handleError");

$clientLog = speakLog();
$throwableError = "";

try
{
//	Test Error #1:	
	nonExistent();
}
catch (Throwable $e)
{
	$throwableError = "Throwable Error Caught at " . date("h:i:sa") . " on "  . date("m-d-Y") . ": " . $e->getMessage() . " inside " . $e->getFile()  . " on line " . $e->getLine() . ".\n";
	$clientLog->send_log($throwableError);

//	echo $throwableError;

//	Test Error #2:
	echo "Trace: " . $e->getTrace() . "\n";
}

?>

