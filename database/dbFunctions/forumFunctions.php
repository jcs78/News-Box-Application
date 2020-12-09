<?php

function getForumPosts($conn){
	$query = "SELECT * FROM `forumPosts` LIMIT 20;

	$statement = $conn->prepar($query);

	$statement->execute();

	$forumPosts = $statement->fetchALL();
	$statement->closeCursor();

	return $forumPosts;
}

function addForumPost($conn, $postTitle, $postContent, $postAuth, $postDate){
	$query = "INSERT INTO `forumPosts`
			(`postTitle`, `postContent`, `postAuth`, `postDate`)
		  VALUES
			(:postTitle, :postContent, :postAuth, :postDate)";

	$statement = $conn->prepare($query);

	$statement->bindValue(':postTitle', $postTitle);
	$statement->bindValue(':postContent', $postContent);
	$statement->bindValue(':postAuth', $postAuth);
	$statement->bindValue(':postDate', $postDate);

	$statement->execute();
	$statement->closeCursor();

}
?>
