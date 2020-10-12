#! /usr/bin/php
<?php

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

function handleError($errNo, $errMsg, $error_file, $error_line) {
	$errorType = "";
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
	echo "Error [$errorType] " . date("h:i:sa") . " at "  . date("m-d-Y") . ": $errMsg inside $error_file on line $error_line.";
	echo "\n\n";
	echo "Chicken Nuggies!\n\n";

	die();
}

error_reporting(E_ALL);
set_error_handler("handleError");

try {
//	Causes an Throwable Error.
//	nonExistent();
}
catch (Throwable $e) {
	echo "Throwable Error Caught on " . date("h:i:sa") . " at "  . date("m-d-Y") . ": " . $e->getMessage() . " inside " . $e->getFile()  . " on line " . $e->getLine() . ".\n\n";

//	Causes an error that is caught by handler.
//	echo "Trace: " . $e->getTrace() . "\n";
}

?>
