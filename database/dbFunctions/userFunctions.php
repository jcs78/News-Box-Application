<?php

function registerUser($conn, $newUsername, $newPassword, $newPrefsArr){

	try{
		$wantsBusiness = False;
		$wantsEntertainment = False;
		$wantsHealth = False;
		$wantsScience = False;
		$wantsSports = False;
		$wantsTech = False;

		if(in_array("business", $newsPrefsArr)){
			$wantsBusiness = True;
		}
		if(in_array("entertainment", $newsPrefsArr)){
                        $wantsEntertainment = True;
                }
		if(in_array("health", $newsPrefsArr)){
                        $wantsHealth = True;
                }
		if(in_array("science", $newsPrefsArr)){
                        $wantsScience = True;
                }
		if(in_array("sports", $newsPrefsArr)){
                        $wantsSports = True;
                }
		if(in_array("tech", $newsPrefsArr)){
                        $wantsTech = True;
                }





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
        	return false;
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


?>
