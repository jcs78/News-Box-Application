<?php
require_once("../dbFunctions/userFunctions.php");
require_once("../dbFunctions/articleFunctions.php");

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

			//echo "databaseAction: case=register\n";
			//print_r($inputArray);

			$isUsernameTaken = isUsernameTaken($conn, $newUsername);

			//echo $isUsernameTaken ? 'true' : 'false';

			if (!$isUsernameTaken){
				//echo "inside databaseAction if\n";

				//Data type of $newUser is an array
				$responseArr = registerUser($conn, $newUsername, $newPassword, $newPrefsString);

				//print_r($responseArr);
				return $responseArr;
			}else{
				//echo "inside databaseAction else\n";

				$responseArr = array();
				$responseArr[0] = false;

				return $responseArr;
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
		case "getArticles":
		{
			echo "\ninside control getArticles \n";
			$userID = $inputArray['userID'];

			$userPrefs = getPreferences($conn, $userID);

			$userPrefs = $userPrefs[0][0];

			//echo "userPerfs = ". $userPrefs;

			if ($userPrefs == ''){
				$userPrefs = 'general';
			}


			//print_r($userPrefs);

			$userPrefsArr = explode(" ", $userPrefs);

			$articlesArr = array();

			foreach ($userPrefsArr as $userPref){
				$articlesArr[$userPref] = getArticles($conn,$userPref);
			}

			echo"\n\n";

			print_r($articlesArr);
			return $articlesArr;

		}
	}
}


?>
