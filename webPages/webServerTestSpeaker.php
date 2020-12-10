#!/usr/bin/php
<?php

require_once('rabbitFiles/webServerRabbitFiles/webServerRabbitMQLib.php');
require_once('rabbitFiles/webServerRabbitFiles/path.inc');
require_once('rabbitFiles/webServerRabbitFiles/get_host_info.inc');
//require_once('webServerRabbitMQ.ini');

error_reporting(E_ALL);
set_error_handler("handleError");

$loginInput = array();
$loginInput['type'] = 'getForumPosts';
$loginInput['forumPostTitle'] = 'rabbitTestTitle';
$loginInput['forumPostContent'] = 'rabbitTestContent';
$loginInput['username'] = 'testName';
$loginInput['password'] = 'testPass';

$response = speak($loginInput);

print_r($response);

?>

