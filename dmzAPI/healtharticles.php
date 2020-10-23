
#! /usr/bin/php
<?php



require_once('path.inc');
require_once('get_host_info.inc');
require_once('logRabbitMQLib.inc');

error_reporting(E_ALL);
set_error_handler("handleError");

// Create a client using the information inside 'logRabbitMQ.ini.' [-jcs78]
$clientLog = new rabbitMQClient("logRabbitMQ.ini", "logServer");
$throwableError = "";




ob_start();

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://newsapi.org/v2/top-headlines?country=us&category=health&apiKey=118fb194014e44768263ba6d227f6d93",
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
file_put_contents('healtharticlesoutput.txt', $content);


// Log Stuff
try {


}
catch (Throwable $e) {
// Using the individual pieces of info caught about the error, a string is stored inside this created variable that helps whoever reads the logs easily identify where the error is occuring, among other things. [-jcs78]
        $throwableError = "Throwable Error Caught at " . date("h:i:sa") . " on "  . date("m-d-Y") . ": " . $e->getMessage() . " inside " . $e->getFile()  . " on line " . $e->getLine() . ".\n";

// Sends the content inside that string variable to be shot through the log exchange and queue toward the log listener(s). [-jcs78]
        $clientLog->send_log($throwableError);

// Used as a test to ensure the latest log(s) were sent to the log listener(s). [-jcs78]
echo $throwableError;


}



?>





