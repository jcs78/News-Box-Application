<?php

function databaseTest($array){

	$conn = new PDO("mysql:host=localhost;dbname=testDB", "testUser", "12345");
	

	$action = $array['type'];

	switch($action){
		case'Login':{
			$newUsername = $action['username']
			$newPassword = $action['password']

			$query = "insert into `testLogin`
					(`username`, `password`)
				  values
					(:username, :password);
			$statement = $conn->prepare($query);

			$statement->bindValue(':username', $newUsername);
			$statement->bindValue(':password', $newPassword);
			$statement->execute();
			$statement->closeCursor();
		}
	}
}


?>
