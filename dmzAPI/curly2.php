<?php

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
echo $response;

$content = ob_get_clean();
file_put_contents('file.txt', $content);
?>





