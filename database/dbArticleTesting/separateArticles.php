#!/usr/bin/php
<?php

//this should be the array index send by rabbit
//the data type will also be a string so this
//mimics the data that we will be getting

//$text = file_get_contents('file.txt');


//$out = json_decode($text);
//$out = $out->articles;

//print_r($out);


echo "\n\n";
//print_r($text);
function decode($inputArr){

	$inputTextToArr = json_decode($inputArr);
	$articles = $inputTextToArr->articles;

	$allArticles = array();
	$articleCount = 0;

	foreach ($articles as $article){
		$singleArticle = array();

		$name = $article->source->name;
		$author = $article->author;
		$title = $article->title;
		$description = $article->description;
		$url = $article->url;
		$urlToImage = $article->urlToImage;
		$publishedAt = $article->publishedAt;
		$content = $article->content;

		$singleArticle['name'] = $name;
		$singleArticle['author'] = $author;
		$singleArticle['title'] = $title;
		$singleArticle['description'] = $description;
		$singleArticle['url'] = $url;
		$singleArticle['urlToImage'] = $urlToImage;
		$singleArticle['publishedAt'] = $publishedAt;
		$singleArticle['content'] = $content;

		$allArticles[$articleCount] = $singleArticle;
		$articleCount++;
	}
	return $allArticles;
}

//print_r(decode($text));


function separateArticles($inputText){
	//Function takes in text from the curl call and
	//makes a 2 dimentional array

	//First array holds all the other arrays
	//other arrays inside contain all the info
	//for every article given from the curl call

	//separates unneeded text from beginning of curl call
	$onlyArticlesArr = explode(': [' ,$inputText);
	$articlesInArray = explode('},', $onlyArticlesArr[1]);

	//Empty array to keep all the articles to be returned
	$articleArrayCorrectFormat = array();

	//I made two counters, can possibly be made into one
	$articleCounter = 0;
	$numArticles = 0;

	//Goes through all 'source' parts of the articles in the original string
	for($i = 0; $i < sizeof($articlesInArray); $i+=2){
		//Separates the 'source name' line into its basic parts
		//and inputs the parts to be a key and value inside
		//of an associtated array

		$singleArticle = array();
		$singleArticle[0] = $articlesInArray[$i];
		$singleArticle[1] = $articlesInArray[$i+1];

		//input [name] = <name of source>
		$articleArrayCorrectFormat[$numArticles] = $singleArticle;
		$numArticles++;
	}

	//Goes through all the remaining part of the article string
	foreach($articleArrayCorrectFormat as $singleArticle){
		//$singleArticle is an array()

		//This will be an arry for a single article
		$articleInfo = array();

		//Getting Article Source Name
		$articleNameArr = explode("\n",$singleArticle[0]);
		$articleNameLineArr = explode(": ", $articleNameArr[4]);

		//Formatting the strings
		$articleInfo['name'] = trim($articleNameLineArr[1], " \"");


		//Getting Other Article Data
		$subCategoriesStr = $singleArticle[1];

		$subCategoriesArr = explode("\n", $subCategoriesStr);

		//Going through all the sub sections
		for ($i = 1; $i < 8; $i++){
			//Formatting the line
			$line = trim($subCategoriesArr[$i], " \",");

			//Separating the line
			$lineParts = explode("\":", $line);

			//Getting sub topic and equivalent parts
			$articleLineTopic = $lineParts[0];
			$articleLineDescription = ltrim($lineParts[1], " \"");

			//Inputting current part into the array
			$articleInfo[$articleLineTopic] = $articleLineDescription;

		}
		//finished Array for ONE article
		$articleArrCorrectFormat[$articleCounter] = $articleInfo;

		//Increment the articleCount
		$articleCounter++;
	}

	//returns the entire array with all the articles
	//which are int he same format and contains
	//all info for the Database
	return $articleArrCorrectFormat;

}

//testing
//$output = separateArticles($text);
//print_r($output);

?>
