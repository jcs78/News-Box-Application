<?php

function getForumPosts($conn){
	$query = "SELECT * FROM `forumPosts` LIMIT 20";

	$statement = $conn->prepare($query);

	$statement->execute();

	$forumPosts = $statement->fetchALL();
	$statement->closeCursor();

	return $forumPosts;
}

function addForumPost($conn, $postTitle, $postContent, $postAuthor, $postDate){
	try{
		echo "Inside addForumPost\n";

		$query = "INSERT INTO `forumPosts`
				(`postTitle`, `postContent`, `postAuthor`, `postDate`)
			  VALUES
				(:postTitle, :postContent, :postAuthor, :postDate)";

		$statement = $conn->prepare($query);

		$statement->bindValue(':postTitle', $postTitle);
		$statement->bindValue(':postContent', $postContent);
		$statement->bindValue(':postAuthor', $postAuthor);
		$statement->bindValue(':postDate', $postDate);

		$statement->execute();
		$statement->closeCursor();

		//Find out what needs to be returned
		return True;
	}
	catch(Exception $e){
		echo $e-getMessage();
		return False;
	}

}
?>
