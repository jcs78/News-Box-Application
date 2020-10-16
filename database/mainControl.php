<?php
require_once("dbFunctions/userFunctions.php");


function databaseAction($array)
{
	$dbUser = "testUser";

	$dbPassword = "12345";

	$conn = new PDO("mysql:host=localhost;dbname=testDB", $dbUser, $dbPassword);

	$action = $array['type'];

	switch($action)
	{
		case'register':
		{
			$newUsername = $array['username'];

			$newPassword = $array['password'];

			$$newUser = registerUser($conn, $newUsername, $newPassword);

			return $newUser;
		}
		case 'login':
		{
			$loginUsername = $array['username'];

			$loginPassword = $array['password'];

			$validUser = validUserLogin($conn, $loginUsername, $loginPassword);

			return $validUser;
		}
	}
}


?>
