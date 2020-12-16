#!/usr/bin/php
<?php
require_once('../rabbitFiles/path.inc');
require_once('../rabbitFiles/get_host_info.inc');
require_once('../rabbitFiles/databaseRabbitMQLib.php');
require_once('separateArticles.php');
require_once("dmzMainControl.php");

//require_once('../dbFunctions/articleFunctions.php');


//require_once('mainControl.php');

//Log Stuff
//require_once('logRabbitMQLib.inc');


function requestProcessor($request)
{
  	echo "received request".PHP_EOL;

  	//Shows input data

	//echo "inside function \n";
  	//var_dump($request);

	$formattedArticles = decodeToArray($request['articles']);

	print_r($formattedArticles);

	addArticlesToDB($request['preference'], $formattedArticles);

	echo "Articles Added";

	//return array("returnCode" => '0', 'message'=>"Server received request and processed");
	//return "Not a valid Case";
}

//Log Stuff
error_reporting(E_ALL);
set_error_handler("handleError");

$clientLog = new logSpeakerClient("databaseLogRabbitMQ.ini", "logServer");
$throwableError = "";


try {
	$server = new databaseServer("dbToDMZRabbitMQ.ini","dbServer");

	echo "testRabbitMQServer BEGIN".PHP_EOL;
	$server->process_request('requestProcessor');
	echo "testRabbitMQServer END".PHP_EOL;

}
catch (Throwable $e) {
       $throwableError = "Throwable Error Caught at " . date("h:i:sa") . " on "  . date("m-d-Y") . ": " . $e->getMessage() . " inside " . $e->getFile()  . " on line " . $e->getLine() . ".\n";

        $clientLog->send_log($throwableError);
        echo "Trace: " . $e->getTrace() . "\n";
}

exit();
?>
