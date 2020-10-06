<?php


if (!isset($_POST))
{
	$msg = "NO POST MESSAGE SENT";
	echo json_encode($msg);
	exit(0);
}
$request = $_POST;
$response = "UNSUPPORTED REQUEST TYPE";
switch ($request["type"])
{
	case "login":
		$response = "ACCESS GRANTED";
	break;
}
echo json_encode($response);
exit(0);

?>
