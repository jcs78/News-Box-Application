#!/usr/bin/php
<?php

//this should be the array index send by rabbit
//the data type will also be a string so this
//mimics the data that we will be getting

$text = file_get_contents('file.txt');

echo "\n\n";
//print_r($text);

//output for one article
$onlyArticlesArr = explode(': [' ,$text);

$articlesInArray = explode('},', $onlyArticlesArr[1]);

$articleArrayCorrectFormat = array();

$numArticles = 0;

for($i = 0; $i < sizeof($articlesInArray); $i+=2){
	$singleArticle = array();
	$singleArticle[0] = $articlesInArray[$i];
	$singleArticle[1] = $articlesInArray[$i+1];

	$articleArrayCorrectFormat[$numArticles] = $singleArticle;
	$numArticles++;
}


foreach($articleArrayCorrectFormat as $singleArticle){
	//$singleArticle is an array()

	$articleInfo = array();

	//Getting Article Source Name
	$articleNameArr = explode("\n",$singleArticle[0]);
	$articleNameLineArr = explode(": ", $articleNameArr[4]);

	//print_r($articleNameLineArr);

	$articleInfo['name'] = $articleNameLineArr[1];
	print_r($articleInfo);

}


/*
	//echo $sepArr[0];

	//echo "\n\n";

	//echo $sepArr[1];

	$testArr = array();

	//Get the Source
	$sourceInfo = explode("\n", $sepArr[0]);

	$sourceNameArr = explode(': ',$sourceInfo[4]);

	//print_r($sourceNameArr);

	$testArr['name'] = $sourceNameArr[1];

	//$articleInfo['name'] = $sourceNameArr[1];
	//Separates each article to its most basic parts

	$linesInArticle = explode('",',$sepArr[1]);

	$singleLine = $linesInArticle[0];

	$lineInfo = explode(': ', $singleLine);

	//echo ltrim($lineInfo[0],"\n");


	foreach ( $linesInArticle as $line){
		$lineSplit =  explode(': ', $line);

		//Fix Formatting for the keys inside of the array
		$articleInfoCate = ltrim($lineSplit[0]," \n\"");
		$articleInfoCate = chop($articleInfoCate,'"');

		$testArr[$articleInfoCate] = $lineSplit[1];

	}
*/

//print_r($articleArrayCorrectFormat);


//print_r($testArr);


//print_r($testArr);

//echo $testArr['"url"'];


//print_r($linesInArticle);


//print_r($sepArr);





//echo gettype($text);





echo "\n\n";

?>
