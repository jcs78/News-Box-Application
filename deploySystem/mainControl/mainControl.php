<?php
//require_once("../dbFunctions/...");

function databaseAction($inputArray){

	//A user in your database
        $dbUser = "testUser";

	//Your User's password
        $dbPassword = "12345";

	//Makes a connection to your database
        $conn = new PDO("mysql:host=localhost;dbname=testDB", $dbUser, $dbPassword);
	//the parameters
		//1 the string
			//host which should be set to localhost
			//dbname is the anme of the database
		//2 user
		//3 the user's password

        $action = $inputArray['type'];

	switch($action){
		case '':{

		}
	}
}

?>

