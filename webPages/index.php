#!/usr/bin/php
<?php

//Main web page control//
session_start();

require('webServerRabbitMQLib.php');
//echo "Well, excuuuuuse me, Princess!";

$webServerAction = filter_input(INPUT_POST, 'action');

if ($webServerAction == NULL){
	$webServerAction = 'showLandingPage';
}

switch ($webServerAction){

	case 'showLogin':{
		include('login.php');
	}
	case 'showRegister':{
		include('register.php');
	}
	case 'showLandingPage':{
		include('newsbox.php');
	}

	case 'validateLogin':{
		$username = filter_input(INPUT_POST, 'username');
		$password = filter_input(INPUT_POST, 'password');

		//echo $username;
		//echo $password;

		$loginRequest = array();
		$loginRequest['type'] = "login";
		$loginRequest['username'] = $username;
		$loginRequest['password'] = $password;

		$userInfo = $_SESSION["wpClient"]->send_request("loginRequest");
		$_SESSION['username'] = $userInfo['username'];
		$_SESSION['password'] = $userInfo['password'];

		header('Location: .?action=showLandingPage');
	}

	case 'registerUser':{
		$newUsername = filter_input(INPUT_POST, 'username');
                $newPassword = filter_input(INPUT_POST, 'password');

		$registerRequest = array();
                $registerRequest['type'] = "register";
                $registerRequest['username'] = $newUsername;
                $registerRequest['password'] = $newPassword;

		$isRegistered = speak($registerRequest);

		//finish what happens here
	}

	default:{
		echo "Unknown Action";
	}
}

?>
