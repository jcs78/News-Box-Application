<?php

require_once('../rabbitMQ_log/path.inc');
require_once('../rabbitMQ_log/get_host_info.inc');
require_once('../rabbitMQ_log/deployRabbitMQLib.php');

error_reporting(E_ALL);
set_error_handler("handleError");

$pushClient = speakWS();

$fileInfo = array();
$fileInfo['versionID'] = "";
$fileInfo['virtualMachine'] = "";
$fileInfo['filePath'] = "";
$fileInfo['versionNum'] = "";
$fileInfo['status'] = "";
$fileInfo['date'] = "";

$pushClient->send_request($fileInfo);

?>

