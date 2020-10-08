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

			return "Register Succesful: Dummy PHP Session Token";
		}
		case 'login':
		{
			$loginUser = $array['username'];

			$loginPass = $array['password'];

			$query = 'select * from userInfo where
					username = :username
					and password = :password';
			$statement = $conn->prepare($query);
			$statement->bindValue(':username', $loginUser);
			$statement->bindValue(':password', $loginPass);
			$statement->execute();

			$account = $statement->fetchALL();

			//print_r($account);

			if(count($account) == 0)
			{
				return false;
			}else
			{
				return $account;
			}

		}
	}
}


?>
