<?php



$host="1.2.3.4";


exec("ping -c 4 " . $host, $output, $result);

print_r($output);

if ($result == 0)
	{
	$myfile = fopen("amialive.txt", "w");
	$txt = "1\n";
	fwrite($myfile,$txt);
	fclose($myfile);
}

else
	{
	$myfile= fopen("amialive.txt", "w");
	$txt = "0\n";
	fwrite($myfile, $txt);
	fclose($myfile);
	
	
	exec(" sudo systemctl start apache2 " );
}

?>



