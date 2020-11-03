#!/usr/bin/php
<?php

require_once('path.inc');
require_once('get_host_info.inc');
require_once('databaseRabbitMQLib.php');
require_once('wsMainControl.php');

error_reporting(E_ALL);
set_error_handler("handleError");

function requestProcessor($request)
{
  	echo "received request".PHP_EOL;

  	//Shows input data

	//echo "inside function \n";
  	//var_dump($request);

  	if (!isset($request['type']))
  	{
   		return "ERROR: unsupported message type";
  	}
	switch ($request['type'])
  	{
		case "register":
	        	try{
				$isNewuser = databaseAction($request);
				if ($isNewUser[0]){
					return true;
				}else{
					return false;
				}
			}
			catch(Exception $e){
				return $e->getMessage();
			}
	    	case "login":
			try{
				//Shows input data

				//echo "inside login case current array: \n";
				//print_r($request);

				$account = databaseAction($request);

				return $account;
			}
			catch(Exception $e){
				return $e->getMessage();
			}
	    	case "validate_session":
	      		return doValidate($request['sessionId']);

		default:
			return "Not a valid Case";
	}
	//return array("returnCode" => '0', 'message'=>"Server received request and processed");
	//return "Not a valid Case";
}

//Try Catch Function For Testing Logs
try
{
	$server = new databaseServer("dbToWebRabbitMQ.ini","testServer");

	echo "testRabbitMQServer BEGIN".PHP_EOL;
	$server->process_requests('requestProcessor');
	echo "testRabbitMQServer END".PHP_EOL;
}
catch (Throwable $e)
{
        $throwableError = "Throwable Error Caught at " . date("h:i:sa") . " on "  . date("m-d-Y") . ": " . $e->getMessage() . " inside " . $e->getFile()  . " on line " . $e->getLine() . ".\n";

        $clientLog->send_log($throwableError);
        echo "Trace: " . $e->getTrace() . "\n";
}

exit();

?>

