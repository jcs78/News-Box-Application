<?php
error_reporting(E_ALL);
set_error_handler("handleError");

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
?>
