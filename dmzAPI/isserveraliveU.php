<?php





$host="10.192.0.0"; 


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
	
	
	//shell_exec('/home/nmaster/git_one/News-Box-Application/dmzAPI/getArticles/sudo./techarticles.php'  );

       //	exec("/home/nmaster/git_one/News-Box-Application/dmzAPI/getArticles/techarticles.php");



}


?>




