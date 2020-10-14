<?php

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

			registerUser($newUsername, $newPassword);
		}
		case 'login':
		{
			$loginUsername = $array['username'];

			$loginPassword = $array['password'];

			loginUser($loginUsername, $loginPassword);

		}
	}
}


?>
