<?php

function registerUser($conn, $username, $password){

	try{
		$query = "insert into `userInfo`
	                 	(`username`, `password`)
	                  values
	                      	(:username, :password)";
	        $statement = $conn->prepare($query);

	        $statement->bindValue(':username', $newUsername);
	       	$statement->bindValue(':password', $newPassword);
	        $statement->execute();
	        $statement->closeCursor();

		//create proper return for mainControl

		return True;

	}catch(Exception $e){

		$rtnArray = array();

		$rtnArray[0] = False;

		$rtnArray[1] = $e->getMessage();
	}
}

function validUserLogin($conn, $username, $password){

	$query = 'select * from userInfo where
                 	username = :username and password = :password';
       	$statement = $conn->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':password', $password);
        $statement->execute();

        $account = $statement->fetchALL();

	//print_r($account);

	//create proper return for mainControl

        if(count($account) === 0){
        	return false;
        }else{
                return $account;
        }

}

?>
