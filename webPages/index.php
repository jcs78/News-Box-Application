#!/usr/bin/php
<?php

session_start();

require('webServerRabbitMQLib.php');
require('validateLogin.php');
require('registerUser.php');

error_reporting(E_ALL);
set_error_handler("handleError");


$webServerAction = filter_input(INPUT_POST, "action");

if ($webServerAction == NULL)
{
	$webServerAction = filter_input(INPUT_GET, 'action');
	if ($webServerAction == NULL)
	{
		$webServerAction = 'showLandingPage';
	}
}

//This logic should check of an active session
//If it does not find an active sesion then it
//should send the user to the landing page
//if(isset($_SESSION['activeSession']) || $_SESSION['activeSession'] != False){
//
//}


echo ($webServerAction);
echo "<br><br>";

/*
if (isset($_SESSION['username']))
{
	print_r($_SESSION['username']);
	echo "<br><br>";
}
*/

switch ($webServerAction)
{
	case 'showLogin':
	{
		include('login.php');

		break;
	}
	case 'showRegister':
	{
		include('register.php');

		break;
	}
	case 'showLandingPage':
	{
		include('newsbox.php');

		break;
	}
	case 'showHome':
	{
		include('home.php');

		break;
	}
	case 'showForum':
	{
		include('forum.php');

		break;
	}

	case 'validateLogin':
	{
		$username = filter_input(INPUT_POST, 'username');
		$password = filter_input(INPUT_POST, 'password');

		$userInfo = validateLogin($username, $password);

		$userInfo= $userInfo[0];

		print_r($userInfo);

		if ($userInfo["userID"] == "incorrect")
		{
			header('Location: .?action=showLogin');
		}

		else
		{
			$_SESSION['userID'] = $userInfo['userID'];
			$_SESSION['username'] = $userInfo['username'];
			$_SESSION['activeSesson'] = True;

//			$_SESSION['password'] = $userInfo['password'];

			header('Location: .?action=showHome');
		}

		break;
	}

	case 'registerUser':
	{
		$newUsername = filter_input(INPUT_POST, 'username');
                $newPassword = filter_input(INPUT_POST, 'password');
		$newPrefsArr = filter_input(INPUT_POST, 'prefs', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);

		if ($newPrefsArr){
			$newPrefString = implode(" ", $newPrefsArr);
		}else{
		$newPrefString = '';
		}

		$registerCheck = registerUser($newUsername, $newPassword, $newPrefString);

		$registerCheck = $registerCheck[0];

		if ($registerCheck["userID"] == "existant")
		{
			header('Location: .?action=showRegister');
		}
		else
		{
			header('Location: .?action=showLogin');
		}

		break;
	}

	default:
	{
		echo "Unknown Action";

		break;
	}
}

?>

