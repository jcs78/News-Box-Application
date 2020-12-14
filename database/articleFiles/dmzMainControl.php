<?php

require_once("../dbFunctions/articleFunctions.php");

function addArticlesToDB($preference, $articles){
	$dbUser = "testUser";
        $dbPassword = "12345";
        $conn = new PDO("mysql:host=localhost;dbname=testDB", $dbUser, $dbPassword);

	switch($preference){

		case 'general':
		{
			foreach($articles as $article){

				$sourceName = $article['name'];
				$author = $article['author'];
				$title = $article['title'];
				$description = $article['description'];
				$url = $article['url'];
				$urlToImage = $article['urlToImage'];
				$publishedAt = $article['publishedAt'];
				$content = $article['content'];

				addArticle($conn, $preference, $sourceName, $author, $title, $description, $url, $urlToImage, $publishedAt, $content);
			}

			return True;
		}
	}
}
?>
