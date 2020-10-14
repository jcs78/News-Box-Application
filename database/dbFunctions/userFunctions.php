<?php

function registerUser($username, $password){
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

function loginUser($username, $password){
	$query = 'select * from userInfo where
                 	username = :username and password = :password';
       	$statement = $conn->prepare($query);
        $statement->bindValue(':username', $loginUser);
        $statement->bindValue(':password', $loginPass);
        $statement->execute();

        $account = $statement->fetchALL();

	//print_r($account);

        if(count($account) === 0){
        	return false;
        }else{
                return $account;
        }

}

?>
