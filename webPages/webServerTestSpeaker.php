#!/usr/bin/php
<?php

require_once('webServerRabbitMQLib.php');
require_once('webServerRabbitMQ.ini')

error_reporting(E_ALL);
set_error_handler("handleError");

$loginInput = array();
$loginInput['type'] = 'login';
$loginInput['username'] = 'Ben Jerry';
$loginInput['password'] = 'Ice Cream';

$response = speak($loginInput);

echo $response;

?>

