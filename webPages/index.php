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
		
		print_r($userInfo);

		if ($userInfo["userID"] == "incorrect")
		{
			header('Location: .?action=showLogin');
		}

		else
		{
			$_SESSION['userID'] = $userInfo['userID'];
			$_SESSION['username'] = $userInfo['username'];
//			$_SESSION['password'] = $userInfo['password'];

			header('Location: .?action=showHome');
		}

		break;
	}

	case 'registerUser':
	{
		$newUsername = filter_input(INPUT_POST, 'username');
                $newPassword = filter_input(INPUT_POST, 'password');
		$newPrefsArr = filter_input(INPUT_POST, 'prefs', FILTER_SNITIZE_FULL_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
		$newPrefString = implode(" ", $newPrefsArr);

		$registerCheck = registerUser($newUsername, $newPassword, $newPrefString);

		if ($registerCheck["userID"] == "existant")
		{
			header('Location: .?action=showRegister');
		}

		else
		{
			$_SESSION['userID'] = $registerCheck['userID'];
			$_SESSION['username'] = $registerCheck['username'];
//	           	$_SESSION['password'] = $registerCheck['password'];

			header('Location: .?action=showHome');
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

