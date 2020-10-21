#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require_once('mainControl.php');

//Log Stuff
//require_once('logRabbitMQLib.inc');


function requestProcessor($request)
{
  	echo "received request".PHP_EOL;

  	//Shows input data

	//echo "inside function \n";
  	//var_dump($request);

  	if(!isset($request['type']))
  	{
   		return "ERROR: unsupported message type";
  	}
  	switch ($request['type'])
  	{
		case "register":
	        	//return doLogin($request['username'],$request['password']);
			try{
				databaseAction($request);
				return "added new user";
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
/*
//Log Stuff
error_reporting(E_ALL);
set_error_handler("handleError");

$clientLog = new rabbitMQClient("logRabbitMQ.ini", "logServer");
$throwableError = "";

try {   
// Causes a 'Throwable Error' (used as a test to see if throwable errors are caught and s$

	//DELETE THIS
	nonExistent();

	//place any code that needs to be error checked and logged

}
catch (Throwable $e) {
// Using the individual pieces of info caught about the error, a string is stored inside $
        $throwableError = "Throwable Error Caught at " . date("h:i:sa") . " on "  . date($

// Sends the content inside that string variable to be shot through the log exchange and $
        $clientLog->send_log($throwableError);

	//This can be used as a test

// Used as a test to ensure the latest log(s) were sent to the log listener(s). [-jcs78]
//      echo $throwableError;

//DELETE THIS
//      Causes an error that is caught by handler (used as a test to see if errors are ha$
        echo "Trace: " . $e->getTrace() . "\n";
}
*/

//


//Main Function - this can be moved into the try/catch block
$server = new rabbitMQServer("testRabbitMQ.ini","testServer");

echo "testRabbitMQServer BEGIN".PHP_EOL;
$server->process_requests('requestProcessor');
echo "testRabbitMQServer END".PHP_EOL;
exit();
?>
