#!/usr/bin/php
<?php

require_once('path.inc');
require_once('get_host_info.inc');
require_once('dmzRabbitMQLib.php');

error_reporting(E_ALL);
set_error_handler("handleError");


ob_start();

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://newsapi.org/v2/top-headlines?country=us&apiKey=118fb194014e44768263ba6d227f6d93",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "Authorization: Basic MTE4ZmIxOTQwMTRlNDQ3NjgyNjNiYTZkMjI3ZjZkOTM6SVQ0OTAtQ3liZXJTdXJ2aXZvcnM=",
    "Cookie: __cfduid=db0071484aab34612646d125413c443901601846480"
  ),
));

$response = curl_exec($curl);

curl_close($curl);

$json = json_decode($response);
echo json_encode($json, JSON_PRETTY_PRINT);

$content = ob_get_clean();
//file_put_contents('file.txt', $content);

$trending = array();
$trending['preference'] = 'general';
$trending['articles'] = $content;

$trending['type'] = 'article'; 

$rtnInfo = speak($trending);

print_r($rtnInfo);

// Try Catch Function For Testing Code
try
{

}
catch (Throwable $e)
{
        $throwableError = "Throwable Error Caught at " . date("h:i:sa") . " on "  . date("m-d-Y") . ": " . $e->getMessage() . " inside " . $e->getFile()  . " on line " . $e->getLine() . ".\n";
	
	$clientLog->send_log($throwableError);
	echo $throwableError;
}

?>

