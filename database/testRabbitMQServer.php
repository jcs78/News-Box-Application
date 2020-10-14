#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require_once('mainControl.php');

function doLogin($username,$password)
{
    // lookup username in databas
    // check password
    return true;
    //return false if not valid
}

function requestProcessor($request)
{
  echo "received request".PHP_EOL;
  //var_dump($request);
  print_r($request);
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
		$account = databaseAction($request);

		//$rtnArray = array();
		//$rtnArray['account'] = $account;
		//$rtnArray['phpSession'] = 'phpSession';
		//return $rtnArray;

		return $account;
	}
	catch(Exception $e){
		return $e->getMessage();
	}
    case "validate_session":
      return doValidate($request['sessionId']);
  }
  //return array("returnCode" => '0', 'message'=>"Server received request and processed");
  return "Not a valid Case";
}

$server = new rabbitMQServer("testRabbitMQ.ini","testServer");

echo "testRabbitMQServer BEGIN".PHP_EOL;
$server->process_requests('requestProcessor');
echo "testRabbitMQServer END".PHP_EOL;
exit();
?>
