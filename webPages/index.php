<?php

//this require statement causes the code to stall
//it does not like rabbitMQLib.inc
require('../../../home/nolan/webPages/webServerSpeaker.php');

//making the speak function inside of this file
//require('path.inc');
//require('get_host_info.inc');
//require_once('rabbitMQLib.inc');

/*
function speak($userInputArray){
        //Show input
        //echo "inside speak function array: \n";
        //print_r($userInputArray);
        //echo "\n";
        $client = new rabbitMQClient("testRabbitMQ.ini","testServer");

        $response = $client->send_request($userInputArray);
        return $response;
}
*/
//Main web page control//

session_start();

$webServerAction = filter_input(INPUT_POST, 'action');

if ($webServerAction == NULL){
	$webServerAction = 'showLandingPage';
}

//echo $webServerAction;

//print_r($_SESSION);

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
