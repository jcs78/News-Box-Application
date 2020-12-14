#!/usr/bin/php
<?php

require_once('../rabbitFiles/path.inc');
require_once('../rabbitFiles/get_host_info.inc');
require_once('../rabbitFiles/databaseRabbitMQLib.php');
require_once('wsMainControl.php');

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
		{
	        	try{
				//echo "inside register case";
				//print_r($request);
				$isNewUser = databaseAction($request);

				//echo "\n isNewUser";
				//print_r($isNewUser);

				if ($isNewUser[0]){
					//echo "inside register if \n";
					//echo "\n\n";
					return true;

				}else{
					//echo "inside register else \n";
					//echo "\n\n";
					return false;
				}
			}
			catch(Exception $e){
				return $e->getMessage();
			}
	    	}
		case "login":
		{
			try{
				//Shows input data

				//echo "inside login case current array: \n";
				//print_r($request);

				$account = databaseAction($request);

				print_r($account);

				return $account;
			}
			catch(Exception $e){
				return $e->getMessage();
			}
		}
		case "getArticles":
		{
			echo "inside Listener getArticles";

			$articlesArr = databaseAction($request);
			return $articlesArr;
		}

		case "getForumPosts":{

			$forumPosts = databaseAction($request);

			return $forumPosts;
		}
		case "addForumPost":{

			$wasAdded = databaseAction($request);

			if($wasAdded){
				return "Added Forum Post";
			}else{
				return "Did not Add Forum post";
			}
		}
		case "getNotifications":{
			$userNotifications = databaseAction($request);

			return $userNotifications;
		}
	    	case "validate_session":{
	      		return doValidate($request['sessionId']);
		}
		default:
			return "Not a valid Case";
	}
	//return array("returnCode" => '0', 'message'=>"Server received request and processed");
	//return "Not a valid Case";
}

//Log Stuff
error_reporting(E_ALL);
set_error_handler("handleError");

$clientLog = new logSpeakerClient("logRabbitMQ.ini", "logServer");
$throwableError = "";


try
{
	$server = new databaseServer("dbToWebRabbitMQ.ini","dbServer");

	echo "testRabbitMQServer BEGIN".PHP_EOL;
	$server->process_request('requestProcessor');
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

