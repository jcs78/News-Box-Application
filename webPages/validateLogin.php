#!/usr/bin/php
<?php

require_once('webServerRabbitMQLib.php');

error_reporting(E_ALL);
set_error_handler("handleError");

$username = filter_input(INPUT_POST, 'username');
$password = filter_input(INPUT_POST, 'password');

$loginRequest = array();
$loginRequest['type'] = "login";
$loginRequest['username'] = $username;
$loginRequest['password'] = $password;

// print_r($loginRequest);

// Changed the rabbit call to be a function.
$userInfo = speak($loginRequest);

print_r($loginRequest);

//	print_r("Plz.");
//	$_SESSION['userID'] = $userInfo['userID'];
//	$_SESSION['username'] = $userInfo['username'];
//	$_SESSION['password'] = $userInfo['password'];

?>

