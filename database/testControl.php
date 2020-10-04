<?php

function databaseTest($array)
{

	$conn = new PDO("mysql:host=localhost;dbname=testDB", "testUser", "12345");

	$action = $array['type'];

	switch($action)
	{
		case'register':
		{
			$newUsername = $array['username'];

			$newPassword = $array['password'];

			$query = "insert into `userInfo`
					(`username`, `password`)
				  values
					(:username, :password)";
			$statement = $conn->prepare($query);

			$statement->bindValue(':username', $newUsername);
			$statement->bindValue(':password', $newPassword);
			$statement->execute();
			$statement->closeCursor();
		}
	}
}


?>
