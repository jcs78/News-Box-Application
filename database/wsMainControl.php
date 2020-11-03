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
			$newUsername = $inputArray['username'];
			$newPassword = $inputArray['password'];
			$newPrefsString = $inputArray['preferences'];

			$isUsernameTaken = isUsernameTaken($conn, $newUserName);

			if (!$isUsedUsername){

				//Data type of $newUser is an array
				$responceArr = registerUser($conn, $newUsername, $newPassword, $newPrefsString);

				return $responceArr;
			}else{
				$responceArr = array();
				$responceArr[0] = false;

				return $responceArr;
			}
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
