#!/usr/bin/php
<?php

require_once('webServerRabbitMQLib.php');

error_reporting(E_ALL);
set_error_handler("handleError");


function validateLogin($un, $pw)
{
	$loginRequest = array();
	$loginRequest['type'] = "login";
	$loginRequest['username'] = $un;
	$loginRequest['password'] = $pw;

//	Create Rabbit Client, Send Array To Server, & Receive Response.
	$userCreds = speak($loginRequest);

	return $userCreds;
}

?>

