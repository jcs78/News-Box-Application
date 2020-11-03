#!/usr/bin/php
<?php

session_start();

require('validateLogin.php');
require_once('webServerRabbitMQLib.php');

error_reporting(E_ALL);
set_error_handler("handleError");

// echo "Well, excuuuuuse me, Princess!";

$webServerAction = filter_input(INPUT_POST, "action");

if ($webServerAction == NULL)
{
	$webServerAction = filter_input(INPUT_GET, 'action');
	if ($webServerAction == NULL)
	{
		$webServerAction = 'showLandingPage';
	}
}

echo ($webServerAction);
echo "<br><br>";

if (isset($_SESSION['username']))
{
	print_r($_SESSION['username']);
	echo "<br><br>";
}

switch ($webServerAction)
{
	case 'showLogin':
	{
		include('login.php');

//		ob_start();
//		header("Location: login.php");
//		ob_end_flush();

		break;
	}
	case 'showRegister':
	{
//		include('register.php');

		ob_start();
                header("Location: register.php");
                ob_end_flush();

		break;
	}
	case 'showLandingPage':
	{
//		include('newsbox.php');

		ob_start();
                header("Location: newsbox.php");
                ob_end_flush();

		break;
	}
	case 'showHome':
	{
//		include('home.php');

		ob_start();
                header("Location: home.php");
                ob_end_flush();

		break;
	}
	case 'showForum':
	{
//		include('forum.php');
		
		ob_start();
		header("Location: forum.php");
		ob_end_flush();

		break;
	}

	case 'validateLogin':
	{
//		$username = filter_input(INPUT_POST, 'username');
//		$password = filter_input(INPUT_POST, 'password');

		//echo $username;
		//echo $password;

//		$loginRequest = array();
//		$loginRequest['type'] = "login";
//		$loginRequest['username'] = $username;
//		$loginRequest['password'] = $password;

//		print_r($loginRequest);

//		Changed the rabbit call to be a function
//		$userInfo = speak($loginRequest);

<<<<<<< HEAD
//		$_SESSION['userID'] = $userInfo['userID'];
//		$_SESSION['username'] = $userInfo['username'];
//		$_SESSION['password'] = $userInfo['password'];

		validateLogin();
=======
		$_SESSION['userID'] = $userInfo['userID'];
		$_SESSION['username'] = $userInfo['username'];
		$_SESSION['password'] = $userInfo['password'];
		
>>>>>>> 369d4c015ba2c17247ce706b3a63709d5dd45205

		header('Location: .?action=showHome');

		break;
	}

	case 'registerUser':
	{
		$newUsername = filter_input(INPUT_POST, 'username');
                $newPassword = filter_input(INPUT_POST, 'password');
		$newPrefsArr = filter_input(INPUT_POST, 'prefs',
						FILTER_SNITIZE_FULL_SPECIAL_CHARS,
						FILTER_REQUIRE_ARRAY);

		$newPrefString = implode(" ", $newPrefsArr);

		$registerRequest = array();
                $registerRequest['type'] = "register";
                $registerRequest['username'] = $newUsername;
                $registerRequest['password'] = $newPassword;
		$registerRequest['preferences'] = $newPrefsString;

		$isRegistered = $_SESSION["wpClient"]->send_request($registerRequest);

		if ($isRegistered)
		{
			$_SESSION['userID'] = $userInfo['userID'];
	                $_SESSION['username'] = $userInfo['username'];
	                $_SESSION['password'] = $userInfo['password'];

			header('Location: .?action=showHome');

			break;
		}
		else
		{
			$_SESSION['registerProblem'] = true;
			header('Location: .?action=showRegister');

			break;
		}
	}

	default:
	{
		echo "Unknown Action";

		break;
	}
}

?>

