#! /usr/bin/php
<?php

// Requiring once the path to external libraries (not used right now)...
require_once('path.inc');

// ...the info of the user accessing Rabbit (along with other things inside 'logRabbit.ini')...
require_once('get_host_info.inc');

// ...and the classes and functions that allow for connection to RabbitMQ. [-jcs78]
require_once('webServerRabbitMQLib.php');

// All types of errors should be reported, with the function 'handlerError' being run whenever any type of error occurs. [-jcs78]
error_reporting(E_ALL);
set_error_handler("handleError");

// Create a client using the information inside 'logRabbitMQ.ini.' [-jcs78]
$clientLog = speakLog();
$throwableError = "";

try {	
// Causes a 'Throwable Error' (used as a test to see if throwable errors are caught and sent to be stored). [-jcs78]
	nonExistent();
}
catch (Throwable $e) {
// Using the individual pieces of info caught about the error, a string is stored inside this created variable that helps whoever reads the logs easily identify where the error is occuring, among other things. [-jcs78]
	$throwableError = "Throwable Error Caught at " . date("h:i:sa") . " on "  . date("m-d-Y") . ": " . $e->getMessage() . " inside " . $e->getFile()  . " on line " . $e->getLine() . ".\n";

// Sends the content inside that string variable to be shot through the log exchange and queue toward the log listener(s). [-jcs78]
	$clientLog->send_log($throwableError);

// Used as a test to ensure the latest log(s) were sent to the log listener(s). [-jcs78]
//	echo $throwableError;

//	Causes an error that is caught by handler (used as a test to see if errors are handled and sent to be stored). [-jcs78]
	echo "Trace: " . $e->getTrace() . "\n";
}

?>
