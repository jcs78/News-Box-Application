#!/usr/bin/php
<?php

//require_once('webServerRabbitMQLib.php');

error_reporting(E_ALL);
set_error_handler("handleError");


function registerUser($newUN, $newPW, $newPref)
{
	$registerRequest = array();
        $registerRequest['type'] = "register";
        $registerRequest['username'] = $newUN;
        $registerRequest['password'] = $newPW;
        $registerRequest['preferences'] = $newPref;

//	Create Rabbit Client, Send Array To Server, & Receive Response.
        $isRegistered = speak($registerRequest);

	return $isRegistered;

}

?>

