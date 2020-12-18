#!/usr/bin/php
<?php

require_once('../rabbitMQ_log/path.inc');
require_once('../rabbitMQ_log/get_host_info.inc');
require_once('../rabbitMQ_log/deployRabbitMQLib.php');

error_reporting(E_ALL);
set_error_handler("handleError");

$depServer = listenDepSys();

echo "Now Listening for Evaluations...".PHP_EOL;

$depServer->process_request('getEval');

echo "Stopped Listening for Evaluations.".PHP_EOL;

exit();

function getEval($answer)
{
	var_dump($answer);
	if (!isset($answer['vm']))
  	{
    		return "Error: VM Type is Not Set!";
  	}
  	switch ($answer['vm'])
  	{
    		case "WebServer":
		{	if ($answer['answer'] =! "Fail")
			{
				shell_exec('sh successWebPagesDirect.sh');
			}
			else
			{
				shell_exec('sh failWebPagesDirect.sh');
			}
			break;  }

		case "Database":
		{	if ($answer['answer'] =! "Fail")
                        {
                                shell_exec('sh successDatabaseDirect.sh');
                        }
                        else
                        {
                                shell_exec('sh failDatabaseDirect.sh');
                        }
			break;  }

		case "RabbitCommHub":
		{	if ($answer['answer'] =! "Fail")
                        {
                                shell_exec('sh successRabbitCommHubDirect.sh');
                        }
                        else
                        {
                                shell_exec('sh failRabbitCommHubDirect.sh');
			}
			break;  }

		case "DMZ":
		{	if ($answer['answer'] =! "Fail")
                        {
                                shell_exec('sh successDMZDirect.sh');
                        }
                        else
                        {
                                shell_exec('sh failDMZDirect.sh');
			}
			break;  }
	}
}

?>

