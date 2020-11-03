#!/usr/bin/php
<?php
		$newUsername = filter_input(INPUT_POST, 'username');
                $newPassword = filter_input(INPUT_POST, 'password');
                $newPrefsArr = filter_input(INPUT_POST, 'prefs', FILTER_SNITIZE_FULL_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);

                $newPrefString = implode(" ", $newPrefsArr);

                $registerRequest = array();
                $registerRequest['type'] = "register";
                $registerRequest['username'] = $newUsername;
                $registerRequest['password'] = $newPassword;
                $registerRequest['preferences'] = $newPrefsString;

                $isRegistered = $_SESSION["wpClient"]->send_request($registerRequest);

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
?>

