#!/usr/bin/php
<?php

require_once('path.inc');

// ...the info of the user accessing Rabbit (along with other things inside 'logRabbit.ini')...
require_once('get_host_info.inc');

// ...and the classes and functions that allow for connection to RabbitMQ. [-jcs78]
require_once('logRabbitMQLib.inc');

// All types of errors should be reported, with the function 'handlerError' being run whenever any type of error occurs. [-jcs78]
error_reporting(E_ALL);
set_error_handler("handleError");

//Main web page control//
session_start();

require('webServerRabbitMQLib.php');
//echo "Well, excuuuuuse me, Princess!";

// All types of errors should be reported, with the function 'handlerError' being run whenever any type of error occurs. [-jcs78]
error_reporting(E_ALL);
set_error_handler("handleError");

// Create a client using the information inside 'logRabbitMQ.ini.' [-jcs78]
$clientLog = new rabbitMQClient("logRabbitMQ.ini", "logServer");
$throwableError = "";


$webServerAction = filter_input(INPUT_POST, 'action');

if ($webServerAction == NULL){
        $webServerAction = 'showLandingPage';
}

try{
  if ($webServerAction == 'validateLogin')
  {
                $username = filter_input(INPUT_POST, 'username');
                $password = filter_input(INPUT_POST, 'password');

                //echo $username;
                //echo $password;

                $loginRequest = array();
                $loginRequest['type'] = "login";
                $loginRequest['username'] = $username;
                $loginRequest['password'] = $password;

                $userInfo = $_SESSION["wpClient"]->send_request("loginRequest");
                $_SESSION['username'] = $userInfo['username'];
                $_SESSION['password'] = $userInfo['password'];
		header('Location: .?action=showLandingPage');
  }
}

catch (Throwable $e) {
// Using the individual pieces of info caught about the error, a string is stored inside this created variable that helps whoever reads the logs easily identify where the error is occuring, among other things. [-jcs78]
        $throwableError = "Throwable Error Caught at " . date("h:i:sa") . " on "  . date("m-d-Y") . ": " . $e->getMessage() . " inside " . $e->getFile()  . " on line " . $e->getLine() . ".\n";

// Sends the content inside that string variable to be shot through the log exchange and queue toward the log listener(s). [-jcs78]
        $clientLog->send_log($throwableError);

// Used as a test to ensure the latest log(s) were sent to the log listener(s). [-jcs78]
//      echo $throwableError;

//      Causes an error that is caught by handler (used as a test to see if errors are handled and sent to be stored). [-jcs78]
        echo "Trace: " . $e->getTrace() . "\n";
}



?>


