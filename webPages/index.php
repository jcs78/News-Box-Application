<?php

//session_start();


//this require statement causes the code to stall
//for some reason it does not like the called file
//to have php tags
require("webServerSpeaker.php");

session_start();

$webServerAction = filter_input(INPUT_POST, 'action');

if ($webServerAction == NULL){
	$webServerAction = 'showLandingPage';
}

//echo $webServerAction;

print_r($_SESSION);

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

		$userInfo = speak($loginRequest);

		$_SESSION['username'] = $userInfo['username'];
		$_SESSION['password'] = $userInfo['password'];

		header('Location: .?action=showLandingPage');
	}

	default:{
		echo "Unknown Action";
	}
}


?>
