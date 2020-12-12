<?php

if(!empty($GET['articles']))
{
	$news_url = 'https://newsapi.org/v2/top-headlines?q=' . urlencode    ($_GET['articles']) '&apiKey=118fb194014e44768263ba6d227f6d93';

	$news_json = file_get_contents($news_url);
	$news_array = json_decode($maps_json, true);





?>


#still need to work on
