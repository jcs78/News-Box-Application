<?php
function getArticles($conn, $preferenceStr){
	echo"inside articleFunctions getArticles";

	$query = "SELECT * FROM `articletable` where
			`prefname` = :preferenceStr";

	$statement = $conn->prepare($query);

	$statement->bindValue(':preferenceStr', $preferenceStr);
	$statement->execute();

	$articles = $statement->fetchALL();

	return $articles;

}

//Make a function for every new preference
//copy and paste the functions so that they
//are input into the correct database

function addArticle($conn, $prefName, $sourceName, $author, $title, $description, $url, $urlToImage, $publishedAt, $content){
	try{
	$query = "INSERT INTO `articleTable`
			(`prefName`, `sourceName`, `article`, `articleTitle`, `description`,  `url`, `urlToImage`, `publishedAt`, `content`)
		  VALUES
			(:prefName, :sourceName, :author, :title, :description, :url, :urlToImage, :publishedAt, :content)";

	$statement = $conn->prepare($query);

	$statement->bindValue(':prefName', $prefName);
	$statement->bindValue(':sourceName',$sourceName);
	$statement->bindValue(':author',$author);
	$statement->bindValue(':title',$title);
	$statement->bindValue(':description',$description);
	$statement->bindValue(':url',$url);
	$statement->bindValue(':urlToImage',$urlToImage);
	$statement->bindValue(':publishedAt',$publishedAt);
	$statement->bindValue(':content',$content);

	$statement->execute();
	$statement->closeCursor();
	}catch(Exception $e){
		echo $e->getMessage();
	}



}
?>
