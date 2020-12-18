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

echo "Is the current Web Server build successful? Type 'S' or 'F': ";
$handle = fopen("php://stdin", "r");
$line = fgets($handle);

if (trim($line) == 'S')
{
        $answer['vm'] = "WebServer";
	$answer['answer'] = "Success";
	$evalClient->send_request($answer);

	exit();
}

else if (trim($line) == 'F')
{
        $answer['vm'] = "WebServer";
	$answer['answer'] = "Fail";
	$evalClient->send_request($answer);
	shell_exec('sh pullSuccessWebPagesDirect.sh');

	exit();
}

else
{
	echo "Invalid answer. Please try again by running the program.";

	exit();
}

?>

