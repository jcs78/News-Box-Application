<?php
/*
$dbFile = fopen('../hotStandby/isDatabaseAlive.txt','r');
$is_db_primary_alive = fread($dbFile,1);
fclose($dbFile);

if($is_db_primary_alive){
	require('rabbitFiles/webServerRabbitMQLib.php');
}else{
	require('rabbitFiles2/webServerRabbitMQLib.php');
}

$dbFile = fopen('../hotStandby/amialive.txt','r');
$is_primary_alive = fread($dbFile,1);
fclose($dbFile);

if($is_primary_alive){
	require('rabbitFiles/webServerRabbitMQLib.php');
}else{
	require('rabbitFiles2/webServerRabbitMQLib.php');
}
*/
require('rabbitFiles/webServerRabbitMQLib.php');

error_reporting(E_ALL);
set_error_handler("handleError");

function testSpeaker(){
	$request = array();
	$request['type'] = "getArticles";
	$request['userID'] = 4;
	//$request['password'] = 'testPass';

	return speak($request);
}

//print_r(testSpeaker());

function getArticles($userID){
	$request = array();
        $request['type'] = "getArticles";
        $request['userID'] = $userID;

        $articles = speak($request);

	return $articles;
}

function validateLogin($un, $pw)
{
        $loginRequest = array();
        $loginRequest['type'] = "login";
        $loginRequest['username'] = $un;
        $loginRequest['password'] = $pw;

//      Create Rabbit Client, Send Array To Server, & Receive Response.
        //print_r($loginRequest);
        $userCreds = speak($loginRequest);

        //print_r($userCreds);

        return $userCreds;
}

function registerUser($newUN, $newPW, $newPref)
{
        $registerRequest = array();
        $registerRequest['type'] = "register";
        $registerRequest['username'] = $newUN;
        $registerRequest['password'] = $newPW;
        $registerRequest['preferences'] = $newPref;

//      Create Rabbit Client, Send Array To Server, & Receive Response.
        $isRegistered = speak($registerRequest);

        return $isRegistered;
}

function getNotifications($userID){
	$notificationRequest = array();

	$notificationRequest['type'] = "getNotifications";
	$notificationRequest['userID'] = $userID;

	$getNotifications = speak($notificationRequest);

	return $getNotifications;
}

function getForumPosts(){
	$forumPostRequest = array();
	$forumPostRequest['type'] = "getForumPosts";

	$forumPosts = speak($forumPostRequest);

	return $forumPosts;
}

?>
