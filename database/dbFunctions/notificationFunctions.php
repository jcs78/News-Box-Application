<?php
function getUserNotifications($conn, $userID){
	//echo " inside get function";
	$query = "select * from `notificationsTable` WHERE
			userID = :userID";

	$statement = $conn->prepare($query);
	$statement->bindValue(':userID', $userID);
	$statement->execute();

	$notifications =  $statement->fetchALL();
	$statement->closeCursor();

	//print_r($notifications);

	return $notifications;
}

function updateUserNotifications(){

}

function adduserNotification(){

}

?>
