<?php
require_once("../dbFunctions/userFunctions.php");
require_once("../dbFunctions/articleFunctions.php");
require_once("../dbFunctions/forumFunctions.php");
require_once("../dbFunctions/notificationFunctions.php");

function databaseAction($inputArray)
{
	$dbUser = "testUser";
	$dbPassword = "12345";
	$conn = new PDO("mysql:host=localhost;dbname=testDB", $dbUser, $dbPassword);


	try{
		$remoteDbUser = "testUser";
		$remoteDbPassword = "12345";
		$remoteConn = new PDO("mysql:host=10.192.228.15;port=3306;dbname=testDB", $dbUser, $dbPassword);
		$remoteExists = true;
	}catch (Exception $e){
		$remoteExists = false;

	$dbPassword = "12345";

	$conn = new PDO("mysql:host=localhost;dbname=testDB", $dbUser, $dbPassword);

	$action = $inputArray['type'];

	switch($action)
	{
		case'register':
		{
			$newUsername = $inputArray['username'];

			//password hashing

			$newPassword = hash('sha512',$inputArray['password']);
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

				$loginPassword = hash('sha512', $inputArray['password']);

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

			echo "userPerfs = ". $userPrefs . "\n";

			if ($userPrefs == ''){
				$userPrefs = 'general';
			}


			//print_r($userPrefs);

			$userPrefsArr = explode(" ", $userPrefs);

			$articlesArr = array();

			foreach ($userPrefsArr as $userPref){
				$currentPrefArr = getArticles($conn,$userPref);

				foreach($currentPrefArr as $singleArticle){
					array_push($articlesArr, $singleArticle);
				}
			}

			//echo"article array made\n";

			print_r($articlesArr);
			return $articlesArr;

		}
		case "getForumPosts":{
			//echo "inside control";
			$forumPosts = getForumPosts($conn);
			return $forumPosts;
		}
		case "addForumPost":{

			echo "inside addForumPost\n";

			$postTitle = $inputArray['forumPostTitle'];
			$postContent = $inputArray['forumPostContent'];
			$postAuthor = $inputArray['username'];
			$postDate = date("Y-m-d h:i:sa");

			echo $postDate . "\n";

			$wasForumPostAdded = addForumPost($conn, $postTitle, $postContent, $postAuthor, $postDate);

			echo "return from function " . $wasForumPostAdded. "\n";

			if($wasForumPostAdded){
				return True;
			}else{
				return False;
			}
		}
		case "getNotifications":{
			echo "mainControl case\n";
			$userID = $inputArray['userID'];

			$userNotifications = getUserNotifications($conn, $userID);

			//print_r($userNotifications);

			return $userNotifications;
		}
		default:{
			return None;
		}
	}
}


?>
