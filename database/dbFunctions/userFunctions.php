<?php

function registerUser($conn, $newUsername, $newPassword, $newPrefsString){

	try{

		$query = "insert into `newsBoxUsers`
	                 	(`username`, `password`, `preferences`,)
	                  values
	                      	(:username, :password, :preferences)";
	        $statement = $conn->prepare($query);

	        $statement->bindValue(':username', $newUsername);
	       	$statement->bindValue(':password', $newPassword);
		$statement->bindValue(':preferences', $newPrefsString);

	        $statement->execute();
	        $statement->closeCursor();

		//create proper return for mainControl
		//This can be an array with one index of True
		$rtnArr = array();
		$rtnArr[0] = true;

	}catch(Exception $e){
		$rtnArr = array();

		$rtnArr[0] = false;
		$rtnArr[1] = $e->getMessage();

		return $rtnArr;
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

	$statement->closeCursor();

	//Shows output array
	//echo "inside validUserLogin, output data from query: \n";
	//print_r($account);
	//echo "\n";

	//create proper return for mainControl

        if(count($account) === 0){
        	$rtnArr = array();
		$rtnArr['userID'] = 'incorrect';

		return $rtnArr;

        }else{
                return $account;
        }

}

function isUsernameTaken($conn, $username){

	$query = 'select * from userInfo where
                        username = :username';

        $statement = $conn->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->execute();

        $account = $statement->fetchALL();

        $statement->closeCursor();

        if(count($account) == 0){
        	return false;
        }else{
                return true;
        }

}

function getPreferences($conn ,$username, $password){

}


?>
