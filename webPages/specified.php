#!/usr/bin/php
<?php
//require_once('../../../webServerSpeakerFiles/webServerSpeaker.php');


//getting the directory with client info
//require('../../../home/hanhle/webServerSpeakerFiles/webServerSpeaker.php');

//Main web page control//
session_start();
$webServerAction = filter_input(INPUT_POST, 'action');

if ($webServerAction == NULL){
        $webServerAction = 'showLandingPage';
}

//echo $webServerAction;

//print_r($_SESSION);
switch ($webServerAction){

        case 'showLogin':{
                include('login.php');
        }
        case 'showRegister':{
                include('register.php');
        }
        case 'validateLogin':{
                $username = filter_input(INPUT_POST, 'username');
                $password = filter_input(INPUT_POST, 'password');

                //echo $username;
                //echo $password;

                $loginRequest = array();
                $loginRequest['type'] = "login";
               $loginRequest['username'] = $username;
                $loginRequest['password'] = $password;


                $userInfo = speak($loginRequest);
                $_SESSION['username'] = $userInfo['username'];
                $_SESSION['password'] = $userInfo['password'];



                header('Location: .?action=showLandingPage');
        }
                      case 'registerUser':{
                $newUsername = filter_input(INPUT_POST, 'username');
                $newPassword = filter_input(INPUT_POST, 'password');

                $registerRequest = array();
                $registerRequest['type'] = "register";
             $registerRequest['username'] = $newUsername;
                $registerRequest['password'] = $newPassword;

                $isRegistered = speak($registerRequest);

                //finish what happens here

        }


	        default:{
                echo "Unknown Action";
        }
}



?>

