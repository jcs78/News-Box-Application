
<?php

function registerUser($conn, $username, $password, $preferences){
	//echo "inside registerUser \n";

	try{
		$query = "insert into `newsBoxUsers`
	                 	(`username`, `password`, `preferences`)
	                  values
	                      	(:username, :password, :preferences)";
	        $statement = $conn->prepare($query);

	        $statement->bindValue(':username', $username);
	       	$statement->bindValue(':password', $password);
		$statement->bindValue(':preferences', $preferences);

	        $statement->execute();
	        $statement->closeCursor();

		//echo "\nquery complete";

		$rtnArr = array();
		$rtnArr[0] = true;
		return $rtnArr;
	}
	catch(Exception $e){
		$rtnArr = array();
		$rtnArr[0] = false;

		return $rtnArr;
	}

}

function validUserLogin($conn, $username, $password){

	$query = 'select * from newsBoxUsers where
                 	username = :username and password = :password';
       	$statement = $conn->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':password', $password);
        $statement->execute();

        $account = $statement->fetchALL();

	$statement->closeCursor();

	//echo "inside of login Function \n \n";
	//print_r($account);


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

	$query = 'select * from newsBoxUsers where
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

function getPreferences($conn ,$userID){
	echo "inside getPreferences\n";

	$query = "SELECT prefName FROM `newsBoxUsers` WHERE
                        userID = :userID";

        $statement = $conn->prepare($query);
        $statement->bindValue(':userID', $userID);
        $statement->execute();

        $preferences = $statement->fetchALL();

	print_r($preferences);

        $statement->closeCursor();

	return $preferences;

}


?>
