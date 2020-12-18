#! /usr/bin/php
<?php

require_once('deploySystem/rabbitMQ_log/path.inc');
require_once('deploySystem/rabbitMQ_log/get_host_info.inc');
require_once('deploySystem/rabbitMQ_log/deployRabbitMQLib.php');

error_reporting(E_ALL);
set_error_handler("handleError");

$evalClient = speakWS();
$throwableError = "";
$answer = array();

echo "What VM are you? Type 'WebServer' or 'Database' or 'RabbitCommHub' or 'DMZ': ";
$handle = fopen("php://stdin", "r");
$line = fgets($handle);
$vm = trim($line);
fclose($handle);

echo "Is the current Web Server build successful? Type 'S' or 'F': ";
$handleTwo = fopen("php://stdin", "r");
$lineTwo = fgets($handleTwo);

if (trim($lineTwo) == 'S' && ($vm == 'WebServer' || $vm == 'Database' || $vm == 'RabbitCommHub' || $vm == 'DMZ' ))
{
        $answer['vm'] = $vm;
	$answer['answer'] = "Success";
	$evalClient->send_request($answer);

	exit();
}

else if (trim($lineTwo) == 'F' && ($vm == 'WebServer' || $vm == 'Database' || $vm == 'RabbitCommHub' || $vm == 'DMZ' ))
{
        $answer['vm'] = $vm;
	$answer['answer'] = "Fail";
	$evalClient->send_request($answer);

	switch ($vm)
	{	case "WebServer":
		{	shell_exec('sh pullSuccessWebPagesDirect.sh');
			break;  }
		case "Database":
		{	shell_exec('sh pullSuccessDatabaseDirect.sh');
	      		break;	}
		case "RabbitCommHub":
		{	shell_exec('sh pullSuccessRabbitCommHubDirect.sh');
	      		break;	}
		case "DMZ":
		{	shell_exec('sh pullSuccessDMZDirect.sh');
	      		break;	}
	}

	exit();
}

else
{
	echo "Invalid answer. Please try again by running the program.\n\n";

	exit();
}

?>

