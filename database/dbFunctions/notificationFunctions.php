<?php
function getNotifications($conn, $userID){
	$query = "select * from `notificationsTable` WHERE
			userID = :userID";

	$statement = $conn->prepere($query);
	$statement->bindValue(':userID', $userID);
	$statement->execute();

	$notifications =  $statement->fetchALL();
	$statement->closeCursor();

	return $notifications;
}

?>
