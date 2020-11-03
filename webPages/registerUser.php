#!/usr/bin/php
<?php
require_once('webServerRabbitMQLib.php');

error_reporting(E_ALL);
set_error_handler("handleError");


//		$newUsername = filter_input(INPUT_POST, 'username');
//              $newPassword = filter_input(INPUT_POST, 'password');
//              $newPrefsArr = filter_input(INPUT_POST, 'prefs', FILTER_SNITIZE_FULL_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);

//                $newPrefString = implode(" ", $newPrefsArr);

                $registerRequest = array();
                $registerRequest['type'] = "register";
                $registerRequest['username'] = 'testName2';
                $registerRequest['password'] = 'testPass2';
                $registerRequest['preferences'] = 'health sports';

                //$isRegistered = $_SESSION["wpClient"]->send_request($registerRequest);

		$isRegistered = speak($registerRequest);

		print_r($isRegistered);

/*
                if ($isRegistered)
                {
//			$_SESSION['userID'] = $userInfo['userID'];
//                     	$_SESSION['username'] = $userInfo['username'];
//                    	$_SESSION['password'] = $userInfo['password'];

//                      header('Location: .?action=showHome');

			print_r($isRegiestered);

                        break;
                }

		else
                {
//                      $_SESSION['registerProblem'] = true;
//                      header('Location: .?action=showRegister');

//                      break;
                }

*/
?>

