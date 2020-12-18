<?php
require_once('../rabbitFiles/path.inc');
require_once('../rabbitFiles/get_host_info.inc');
require_once('../rabbitFiles/webServerRabbitMQLib.php');


$host="10.192.0.0";


exec("ping -c 4 " . $host, $output, $result);

print_r($output);

if ($result == 0)
	{
	$myfile = fopen("amialive.txt", "w");
	$txt = "1\n";
	fwrite($myfile,$txt);
	fclose($myfile);

	$clientLog = new logSpeakerClient("webServerLogRabbitMQ.ini", "logServer");
	$client->send_log('1');
}

else
	{
	$myfile= fopen("amialive.txt", "w");
	$txt = "0\n";
	fwrite($myfile, $txt);
	fclose($myfile);

	exec("sudo systemctl start apache2");

	$clientLog = new logSpeakerClient("webServerLogRabbitMQ.ini", "logServer");
	$client->send_log('0');

}

?>



