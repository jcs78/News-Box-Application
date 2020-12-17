<?php

//include_once('pull.php');
//include_once('push.php');
require_once('../rabbitMQ_log/path.inc');
require_once('../rabbitMQ_log/get_host_info.inc');
require_once('../rabbitMQ_log/deployRabbitMQLib.php');

error_reporting(E_ALL);
set_error_handler("handleError");


$deployServer = listenDepSys();

echo "Now Listening for Zipped Files...".PHP_EOL;

$deployServer->process_request('aFunction');

switch($action)
{
	case 'pull':
	{
//		Call pull function.
	}

	case 'push':
	{
//		Call push function.
	}
}

echo "Stopped Listening for Zipped Files.".PHP_EOL;

exit();

function aFunction($request)
{
	echo "A function, I am.";
}

?>

