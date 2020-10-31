<?php
session_start();

require('webServerRabbitMQLib.php');
//echo "Well, excuuuuuse me, Princess!";

$webServerAction = filter_input(INPUT_POST, "action");

echo ($webServerAction);

if($webServerAction == NULL){
	$webServerAction = filter_input(INPUT_GET, 'action');
	if ($webServerAction == NULL){
		$webServerAction = 'showLandingPage';
	}
}

echo ($webServerAction);

switch ($webServerAction){

	case 'showLogin':{
		include('login.php');

		break;
	}
	case 'showRegister':{
		include('register.php');

		break;
	}
	case 'showLandingPage':{
		include('newsbox.php');

		break;
	}
	case 'showHome':{
		include('home.php');

		break;
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

		$userInfo = $_SESSION["wpClient"]->send_request($loginRequest);
		$_SESSION['userID'] = $userInfo['userID'];
		$_SESSION['username'] = $userInfo['username'];
		$_SESSION['password'] = $userInfo['password'];


		header('Location: .?action=showLandingPage');

		break;
	}

	case 'registerUser':{
		$newUsername = filter_input(INPUT_POST, 'username');
                $newPassword = filter_input(INPUT_POST, 'password');

		$registerRequest = array();
                $registerRequest['type'] = "register";
                $registerRequest['username'] = $newUsername;
                $registerRequest['password'] = $newPassword;

		$isRegistered = $_SESSION["wpClient"]->send_request($registerRequest);

		if($isRegistered){
			$_SESSION['userID'] = $userInfo['userID'];
	                $_SESSION['username'] = $userInfo['username'];
	                $_SESSION['password'] = $userInfo['password'];

			header('Location: .?action=showHome');

			break;
		}else{
			$_SESSION['registerProblem'] = true;
			header('Location: .?action=showRegister');

			break;
		}

	}

	default:{
		echo "Unknown Action";

		break;
	}
}

?>
