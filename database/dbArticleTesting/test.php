#!/usr/bin/php
<?php

//this should be the array index send by rabbit
//the data type will also be a string so this
//mimics the data that we will be getting

$text = file_get_contents('file.txt');

echo "\n\n";
//print_r($text);

//output for one article
$articleInfo = array();

$onlyArticlesArr = explode(': [' ,$text);

$sepArr = explode('},', $onlyArticlesArr[1]);

//echo $sepArr[0];

//echo "\n\n";

//echo $sepArr[1];

$testArr = array();
$x = 0;

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

print_r($testArr);

//echo $testArr['"url"'];


//print_r($linesInArticle);


//print_r($sepArr);





//echo gettype($text);





echo "\n\n";

?>
