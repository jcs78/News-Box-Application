#!/usr/bin/php
<?php
//require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

$client = new rabbitMQClient("testRabbitMQ.ini", "testServer");

if (isset($argv[1]))
{
	$msg = $argv[1];
}
else
{
	$msg = "Life has never been sweeter than this!";
}

$request = array();
$request['type'] = "Login";
$request['useridentity'] = $_GET["userid"];
$request['userpasswd'] = $_GET["userpw"];
$response = $client->send_request($request);
// $response = $client->publish($request);

echo "The digital deities have heard your request!".PHP_EOL;
print_r($response);
echo"\n\n";

echo $argv[0]." END".PHP_EOL;


//private $logindb;

//public function __construct()
//{
//	$this->logindb = new mysqli("127.0.0.1","root","12345","login");

//	if ($this->logindb->connect_errno != 0)
//	{
//		echo "Error connecting to database: ".$this->logindb->connect_error.PHP_EOL;
//		exit(1);
//	}
//	echo "Successfully connected to database.".PHP_EOL;
//}

//public function validateLogin($username,$password)
//{
//	$un = this->logindb->real_escape_string($username);
//	$pw = this->logindb->real_escape_string($password);
//	$statement = "select * from users where screenname = '$un'";
//	$response = $this->logindb->query($statement);

//	while ($row = $response->fetch_assoc())
//	{
//		echo "Checking password for $username".PHP_EOL;
//		if ($row["password"] == $pw)
//		{
//			echo "Passwords match for $username".PHP_EOL;
//			return 1; // [Password matches.]
//		}
//		echo "Passwords did not match for $username".PHP_EOL;
//	}
//	return 0; // [No users matched username.]
//}
?>
