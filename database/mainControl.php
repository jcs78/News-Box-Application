<?php
require_once("dbFunctions/userFunctions.php");


function databaseAction($inputArray)
{
	$dbUser = "testUser";

	$dbPassword = "12345";

	$conn = new PDO("mysql:host=localhost;dbname=testDB", $dbUser, $dbPassword);

	$action = $inputArray['type'];

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
			try{
				$loginUsername = $inputArray['username'];

				$loginPassword = $inputArray['password'];

				$validUser = validUserLogin($conn, $loginUsername, $loginPassword);

				return $validUser;

			}catch(Exception $e){
				return $e->getMessage();
			}
		}
	}
}


?>
