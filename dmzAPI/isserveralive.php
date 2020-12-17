<?php



$host="10.192.225.99";


exec("ping -c 4 " . $host, $output, $result);

print_r($output);

if ($result == 0)

        echo "Web Server is alive!";

else

	
         exec(" sudo systemctl start apache2 " );
	echo("Apache2 turned on");	
?>





