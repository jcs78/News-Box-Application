#!/usr/bin/php
<?php

session_start();

require('rabbitMainframe.php');

error_reporting(E_ALL);
set_error_handler("handleError");

$loginInput = array();
$loginInput['type'] = 'login';
$loginInput['username'] = 'Ben Jerry';
$loginInput['password'] = 'Ice Cream';

$response = $_SESSION["wbClient"]->send_request("loginInput");
//echo $response;
echo $loginInput;

?>

