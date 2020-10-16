#! /usr/bin/php
<?php

// Requiring once the path to external libraries (not used right now)...
require_once('path.inc');

// ...the info of the user accessing Rabbit (along with other things inside 'logRabbit.ini')...
require_once('get_host_info.inc');

// ...and the classes and functions that allow for connection to RabbitMQ. [-jcs78]
require_once('rabbitMQLib.inc');

// Function that is desined to handle all types of errors reported.
function handleError($errNo, $errMsg, $error_file, $error_line) {
	global $client;
	$errorType = "";
	$e_Error = "";

// Switch statement simple identifies what type of error it is by using the error number produced when the error was... handled. [-jcs78]
	switch ($errNo)	{
		case 1:
			$errorType = "E_ERROR";
			break;
		case 2:
			$errorType = "E_WARNING";
			break;
		case 4:
			$errorType = "E_PARSE";
			break;
		case 8:
			$errorType = "E_NOTICE";
			break;
		case 16:
			$errorType = "E_CORE_ERROR";
			break;
		case 32:
			$errorType = "E_CORE_WARNING";
			break;
		case 64:
			$errorType = "E_CORE_ERROR";
			break;
		case 128:
			$errorType = "E_COMPLILE_WARNING";
			break;
		case 256:
			$errorType = "E_USER_ERROR";
			break;
		case 512:
			$errorType = "E_USER_WARNING";
			break;
		case 1024:
			$errorType = "E_USER_NOTICE";
			break;
		case 2048:
			$errorType = "E_STRICT";
			break;
		case 4096:
			$errorType = "E_RECOVERABLE_ERROR";
			break;
		case 8192:
			$errorType = "E_DEPRECATED";
			break;
		case 16384:
			$errorType = "E_USER_DEPRECATED";
			break;
		default:
			$errorType = "No Type Determined.";
	}

// Using the individual pieces of info caught about the error, a string is stored inside this created variable that helps whoever reads the logs easily identify where the error is occuring, among other things. [-jcs78]
	$e_Error = "Error [$errorType] detected at " . date("h:i:sa") . " on "  . date("m-d-Y") . ": $errMsg inside $error_file on line $error_line.\n";

// Sends the content inside that string variable to be shot through the log exchange and queue toward the log listener(s). [-jcs78]
	$client->send_log($e_Error);

// Used as a test to ensure that the latest log(s) were sent to the log listener(s). [-jcs78]
//	echo $e_Error;

	die();
}

// All types of errors should be reported, with the function 'handlerError' being run whenever any type of error occurs. [-jcs78]
error_reporting(E_ALL);
set_error_handler("handleError");

// Create a client using the information inside 'logRabbitMQ.ini.' [-jcs78]
$client = new rabbitMQClient("logRabbitMQ.ini", "logServer");
$throwableError = "";

try {	
// Causes a 'Throwable Error' (used as a test to see if throwable errors are caught and sent to be stored). [-jcs78]
	nonExistent();
}
catch (Throwable $e) {
// Using the individual pieces of info caught about the error, a string is stored inside this created variable that helps whoever reads the logs easily identify where the error is occuring, among other things. [-jcs78]
	$throwableError = "Throwable Error Caught at " . date("h:i:sa") . " on "  . date("m-d-Y") . ": " . $e->getMessage() . " inside " . $e->getFile()  . " on line " . $e->getLine() . ".\n";

// Sends the content inside that string variable to be shot through the log exchange and queue toward the log listener(s). [-jcs78]
	$client->send_log($throwableError);

// Used as a test to ensure the latest log(s) were sent to the log listener(s). [-jcs78]
//	echo $throwableError;

//	Causes an error that is caught by handler (used as a test to see if errors are handled and sent to be stored). [-jcs78]
	echo "Trace: " . $e->getTrace() . "\n";
}

?>
